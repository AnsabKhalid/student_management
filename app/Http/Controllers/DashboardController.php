<?php

namespace App\Http\Controllers;

use App\Mail\pendingEmail;
use App\Mail\sendSchedule;
use App\Mail\sendteacherSchedule;
use App\Mail\studentReminderEmail;
use App\Mail\teacherEmail;
use App\Mail\teacherReminderEmail;
use App\Models\Student;
use App\Models\StudentBilling;
use App\Models\Subject;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    public function showClasses(Request $request)
    {

        if ($request->isMethod('GET')){
            dd($request);
        }
        $request->validate([
           'classDate' => 'required',
        ]);
        $date = $request->classDate;
        $newDate = null;
        if (!empty($date)) {
            return $this->index($date, $newDate);
        }else{
            $date = 0;
            return $this->index($date, $newDate);
        }
    }
    public function showClasses2(Request $request)
    {
        if ($request->isMethod('GET')){
            dd($request);
        }
        $request->validate([
            'classDate' => 'required',
        ]);
        $newDate = $request->classDate;
        $date = null;
        if (!empty($newDate)) {
            return $this->index($date, $newDate);

        }else{
            $newDate = 0;
            return $this->index($date, $newDate);
        }
    }
    public function index($date1 = null, $newDate1 = null)
    {
        $date = $date1;
        $newDate = $newDate1;
        $allStudents = Student::all();
        $allTeachers = Teacher::all();
        $allStudentIds = Student::pluck('studentId');
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $pendingCount = DB::table('todo')
            ->where('status', 'pending')
            ->where('assignedTo', Auth::user()->id)
            ->count();
        $todo = DB::table('todo')
            ->where('status', 'pending')
            ->count();
       $studentIds = StudentBilling::where('classDate', '>=', $today)
            ->whereIn('studentId', $allStudentIds)
            ->pluck('studentId')
            ->toArray();
        if ($date != 0){
            $billingRecords = StudentBilling::whereDate('classDate', $date)
                ->whereIn('studentId', $allStudentIds)
                ->where('classStatus', 'active')
                ->get();
        }elseif($date == null){
            $billingRecords = StudentBilling::whereDate('classDate', $today)
                ->whereIn('studentId', $allStudentIds)
                ->where('classStatus', 'active')
                ->get();
        }
        //dd($studentIds);
        if ($newDate != 0){
            $lastPaid = StudentBilling::whereIn('studentId', $studentIds)
                ->where('status', 'paid')
                ->where('classDate', $newDate)
                ->latest('classTime')
                ->get()
                ->unique('studentId');
        }elseif($newDate == null){
            $lastPaid = StudentBilling::whereIn('studentId', $studentIds)
                ->where('status', 'paid')
                ->latest('classDate')
                ->latest('classTime')
                ->get()
                ->unique('studentId');
        }
    
        $futureStudentIds = StudentBilling::whereIn('studentId', $studentIds)
            ->where('ClassStatus', 'active')
            ->latest('classDate')
            ->latest('classTime')
            ->get()
            ->unique('studentId')
            ->toArray();
        $pendingPayments = DB::table('student_billings')
            ->whereIn('studentId', $allStudentIds)
            ->selectRaw('studentId, studentName, SUM(payment) as total_payment')
            ->where('status', 'pending')
            ->where('classStatus', 'active')
            ->groupBy('studentId', 'studentName')
            ->get();
        $creditPayments = DB::table('student_billings')
            ->whereIn('studentId', $allStudentIds)
            ->where('status', 'paid')
            ->where('classStatus', 'cancel')
            ->selectRaw('studentId, studentName, SUM(payment) as total_payment')
            ->groupBy('studentId', 'studentName')
            ->get();
        $studentBillings = StudentBilling::all();
        $studentIds = Student::pluck('studentId')->all();

        $groupedMonthly = Student::whereIn('studentId', $studentIds)
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('month')
            ->get();

        $teacherIds = Teacher::pluck('teacherId')->all();

        $teacherGroupedMonthly = Teacher::whereIn('teacherId', $teacherIds)
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('month')
            ->get();

        $groupedData = [];

        foreach ($studentBillings as $studentBilling) {
            $monthYear = Carbon::parse($studentBilling->classDate)->format('F Y');

            if (!isset($groupedData[$monthYear])) {
                $groupedData[$monthYear] = [
                    'amount' => 0,
                    'paid' => 0,
                    'pending' => 0,
                    'teacherPayment' => 0,
                    'count' => 0,
                    'totalFee' => 0,
                    'teacherCount' => 0,
                    'inqCount' => 0,
                    'regCount' => 0,
                    'credit' => 0,
                ];
            }
            //dd($studentBilling->classStatus);
            if ($studentBilling->classStatus == 'active') {
                $groupedData[$monthYear]['amount'] += $studentBilling->payment;
            }

            if ($studentBilling->status == 'paid' && $studentBilling->classStatus == 'active') {
                $groupedData[$monthYear]['paid'] += $studentBilling->payment;
            } elseif($studentBilling->classStatus == 'active') {
                $groupedData[$monthYear]['pending'] += $studentBilling->payment;
            }

            if ($studentBilling->status == 'paid' && $studentBilling->classStatus == 'cancel'){
                $groupedData[$monthYear]['credit'] += $studentBilling->payment;
            }

            $groupedData[$monthYear]['teacherPayment'] += $studentBilling->teacherPayment;
        }

        foreach ($allStudents as $student) {
            $monthYear = Carbon::parse($student->created_at)->format('F Y');

            if (!isset($groupedData[$monthYear])) {
                $groupedData[$monthYear] = [
                    'count' => 0,
                    'inqCount' => 0,
                    'regCount' => 0,
                ];
            }
            $groupedData[$monthYear]['count'] += 1;

            if ($student->status == 'pending'){
                $groupedData[$monthYear]['inqCount'] += 1;
            }elseif ($student->status == 'registered'){
                $groupedData[$monthYear]['regCount'] += 1;
            }
        }

        foreach ($allTeachers as $teachers) {
            $monthYear = Carbon::parse($teachers->created_at)->format('F Y');

            if (!isset($groupedData[$monthYear])) {
                $groupedData[$monthYear] = [
                    'teacherCount' => 0,
                ];
            }

            if (!isset($groupedData[$monthYear]['teacherCount'])) {
                $groupedData[$monthYear]['teacherCount'] = 0;
            }

            $groupedData[$monthYear]['teacherCount'] += 1;
        }

        foreach ($groupedData as $monthYear => &$data) {
            if (!isset($data['amount'])) {
                $data['amount'] = 0;
            }

            if (!isset($data['paid'])) {
                $data['paid'] = 0;
            }

            if (!isset($data['pending'])) {
                $data['pending'] = 0;
            }

            if (!isset($data['teacherPayment'])) {
                $data['teacherPayment'] = 0;
            }

            if (!isset($data['count'])) {
                $data['count'] = 0;
            }

            if (!isset($data['totalFee'])) {
                $data['totalFee'] = 0;
            }

            if (!isset($data['teacherCount'])) {
                $data['teacherCount'] = 0;
            }
            if (!isset($data['inqCount'])) {
                $data['inqCount'] = 0;
            }
            if (!isset($data['regCount'])) {
                $data['regCount'] = 0;
            }
            if (!isset($data['credit'])) {
                $data['credit'] = 0;
            }
        }
        $allReviews = DB::table('reviews')->get();
        return view( 'index', compact('allStudents','allTeachers','billingRecords','groupedData','groupedMonthly','teacherGroupedMonthly','futureStudentIds','pendingPayments','creditPayments','lastPaid','pendingCount','todo','allReviews'));
    }

    public function search($id)
    {
        $student = Student::find($id);
        $allTeachers = Teacher::all();
        $separatedData = explode(',', $student->subjects);

        return view('find', compact('student','allTeachers','separatedData','id'));
    }

    public function findTeacher(Request $request)
    {
        $request->validate([
           'subjects' => 'required',
        ]);
        $allTeachers = Teacher::all();
        $selectedSubjects = $request->subjects;

        $matchingTeachers = [];

        // loop through each teacher profile
        foreach ($allTeachers as $teacherProfile) {
            // compare the selected subjects with the teacher's subjects
            $subjectsMatch = array_intersect(array_map('strtolower', $selectedSubjects), array_map('strtolower', explode(',',$teacherProfile['subjects'])));

            // if all selected subjects match the teacher's subjects, add the teacher's ID to the array
            if ( !empty($subjectsMatch) ) {
                $matchingTeachers[] = $teacherProfile;
            }
        }

        session(['matchingTeachers' => $matchingTeachers]);
        $data = session()->get('matchingTeachers');
        $uniqueURL = Str::random(40);
        DB::table('share_results')->insert([
            'data' => serialize($data),
            'url' => $uniqueURL
        ]);
        session(['uniqueURL' => $uniqueURL]);
        session(['selectedSubjects' => $selectedSubjects]);
        return redirect()->back();
    }

    public function tableResult($url)
    {
        $sharedTable = DB::table('share_results')->where('url', $url)->first();
        if ($sharedTable) {
            $classLevels = [];
            $subjects = [];
            $data = unserialize($sharedTable->data);
            foreach ($data as $item) {
                $classLevels[] = explode(',',$item['teachingLevel']);
                $subjects[] = $item['subjects'];
            }
            return view('shareResult', compact('data','classLevels','subjects'));
        } else {
            abort(404);
        }
    }

    public function tableSingleResult($id)
    {
        $data = Teacher::find($id);
        $uniqueURL = Str::random(40);
        DB::table('share_results')->insert([
            'data' => serialize($data),
            'url' => $uniqueURL
        ]);

        $sharedTable = DB::table('share_results')->where('url', $uniqueURL)->first();
        if ($sharedTable) {
            $data = unserialize($sharedTable->data);
            $classLevels = explode(',', $data['teachingLevel']);
            $subjects = explode(',', $data['subjects']);
            return view('modules/shareSingleProfile', compact('data','classLevels','subjects'));
        } else {
            abort(404);
        }
    }

    public function teacherPublicProfile($id)
    {

        $teacher = Teacher::where('teacherId',$id)->first();
        $separatedData = explode(',', $teacher->subjects);
        $separatedCities = explode(',', $teacher->cities);
        return view('modules/teacherPublicProfile', compact('teacher','separatedData','separatedCities'));
    }

    public function alertForm($id,$classTime,$teacherId)
    {

        $student = Student::where('studentId', $id)->first();

        return view('modules/alertEmailForm', compact('student','classTime','teacherId'));
    }
    public function alertEmail(Request $request)
    {

        $name = $request->studentName;
        $studentEmail = $request->email;
        $message = $request->message;
        $classTime = $request->classTime;
        $teacher = Teacher::where('teacherId',$request->teacherId)->first();
        $teacherName = $teacher->teacherName;
        $teacherEmail = $teacher->Email;

        $emailController = new EmailController();
        $emailController->classAlertEmail($studentEmail,$name,$message,$classTime);
        $emailController->classAlertEmail($teacherEmail,$teacherName,$message,$classTime);

        return redirect('/')->with('success', 'Emails have been sent successfully!');
    }

    public function sendSchedule($Id)
    {

        $todayDate = Carbon::today();

        if (Route::currentRouteName() == 'studentSchedule')
        {

            $email = Student::where('studentId', $Id)->get('email');
            $studentBillings = StudentBilling::where('studentId', $Id)
                ->whereDate('classDate', '>=', $todayDate)
                ->get();
            if ($studentBillings->isEmpty()) {
//                abort(404, 'No records found for this student');
                return back()->withInput()->with('error', 'No New Schedule');
            }
            //dd($studentBillings);
            $emailController = new EmailController();
            $emailController->sendSchedule($email,$studentBillings);
            return redirect()->back()->with('success', 'Schedule  have been sent successfully!');

        }elseif(Route::currentRouteName() == 'teacherSchedule')
        {
            $email = Teacher::where('teacherId', $Id)->get('email');
            $teacherBillings = StudentBilling::where('teacherId', $Id)
                ->whereDate('classDate', '>=', $todayDate)
                ->get();
            if ($teacherBillings->isEmpty()) {
//                abort(404, 'No records found for this student');
                return back()->withInput()->with('error', 'No New Schedule');
            }
            $emailController = new EmailController();
            $emailController->teacherSchedule($email, $teacherBillings);
            return redirect()->back()->with('success', 'Schedule  have been sent successfully!');

        }else{
            abort( 404 );
        }
    }

    public function teacherEmailForm()
    {
        $allTeachers = Teacher::all();

        return view('modules/teacherEmail',compact('allTeachers'));
    }

    public function studentEmailForm()
    {
        $allStudents = Student::all();

        return view('modules/studentEmail',compact('allStudents'));
    }

    public function sendTeacherEmail(Request $request)
    {

        $teacher = explode('|', request('teacher'));
        $teacherId = $teacher[0];
        $getTeacher = Teacher::where('teacherId', $teacherId)->first();
        $email = $getTeacher->Email;
        $message = $request->message;

        $data = [
            'teacherData' => $getTeacher,
            'message' => $message,
        ];

        $emailController = new EmailController();
        $emailController->teacherEmail($email,$data);

        return redirect('/')->with('success', 'Email have been sent successfully!');
    }
    
    public function reminderEmailForm($id)
    {
        $student = Student::where('studentId', $id)->get();
        //dd($student);
        return view('modules/student/ReminderEmailForm', compact('student'));
    }

    public function sendStudentEmail(Request $request)
    {

        $student = explode('|', request('student'));
        $studentId = $student[0];
        $getstudent = Student::where('studentId', $studentId)->first();
        $email = $getstudent->Email;
        $message = $request->message;

        $data = [
            'studentData' => $getstudent,
            'message' => $message,
        ];

        $emailController = new EmailController();
        $emailController->studentEmail($email,$data);

        return redirect('/')->with('success', 'Email have been sent successfully!');
    }
    
    public function reviewForm($id)
    {
        $data = StudentBilling::where('billId', $id)->first();
        return view('modules/reviewForm', compact('data'));
    }

    public function storeReview(Request $request)
    {
        $checkId = DB::table('reviews')
            ->where('billId', $request->id)
            ->where('reviewBy', $request->reviewBy)
            ->exists();
        //dd($checkId);
        if ($checkId){
            abort(404);
        }else {
            $request->validate([
                'rating' => 'required',
                'review' => 'required',
                'topic' => 'required',
                'assessment' => 'required',
                'homework' => 'required',
            ]);
            $data = StudentBilling::where('billId', $request->id)->first();
            DB::table('reviews')->insert([
                'billId' => $request->id,
                'reviewBy' => $request->reviewBy,
                'role' => $request->role,
                'reviewFor' => $request->reviewFor,
                'rating' => $request->rating,
                'review' => $request->review,
                'topic' => $request->topic,
                'assessment' => $request->assessment,
                'homework' => $request->homework,
            ]);
//        dd($request);
            return view('modules/thankyou');
        }
    }

    public function reviews()
    {
        $classData = StudentBilling::all();
        $studentReviews = DB::table('reviews')->where('role', 'student')->get();
        $teacherReviews = DB::table('reviews')->where('role', 'teacher')->get();
        return view('modules/reviews',compact('classData','studentReviews','teacherReviews'));
    }
    
    public function sendClassReminder($id)
    {
        $studentBilling = StudentBilling::where('billId', $id)->first();
        $studentEmail = Student::where('studentId', $studentBilling->studentId)->value('Email');
        $teacherEmail = Teacher::where('teacherId', $studentBilling->teacherId)->value('Email');
        $parentEmail = Student::where('studentId', $studentBilling->studentId)->first('parentEmail');
        if ($studentBilling->attendance = 'pending'){
            $studentBilling->attendance = 'done';
            $studentBilling->save();
        }
        $status = Student::where('studentId', $studentBilling->studentId)->first('sendEmail');

        $data = [
            'studentName' => $studentBilling->studentName,
            'teacherName' => $studentBilling->teacherName,
            'message' => $studentBilling->message,
            'status' => 0,
            'classDetails' => $studentBilling,
        ];
        try {
            Mail::to($studentEmail)->send(new studentReminderEmail($data));
            Mail::to($teacherEmail)->send(new teacherReminderEmail($data));
            if ($status->sendEmail === 1){
                $data = [
                    'studentName' => $studentBilling->studentName,
                    'message' => $studentBilling->message,
                    'status' => 1
                ];
                Mail::to($parentEmail->parentEmail)->send(new studentReminderEmail($data));
            }
        } catch (\Exception $e) {
            // Handle error
            Log::error("Error sending reminder email: " . $e->getMessage());
        }
        return redirect('/')->with('success', 'Email have been sent successfully!');
    }

}
