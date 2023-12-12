<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentBilling;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        $allStudents = Student::all();
        return view('modules/student/index', compact('allStudents'));
    }

    public function profile($id)
    {
        $students = Student::find($id);
        $separatedData = explode(',', $students->subjects);
        $separatedLevels = explode(',', $students->classLevel);
        return view('modules/student/studentProfile', compact('students','separatedData','separatedLevels'));
    }

    public function add()
    {
        $allSubjects = Subject::all();
        $allClassLevels = DB::table('classlevels')->get();
        //dd($allClassLevels);

        return view('modules/student/addStudent', compact('allSubjects','allClassLevels'));
    }

    public function store(Request $request)
    {


        $studentCount = Student::all();

        if ($studentCount->count() > 0) {
            $lastStudent = Student::orderBy('created_at', 'desc')->first();
            $studentId = 'St' . ((int)substr($lastStudent->studentId, 2) + 1);
            $studentCounts = StudentBilling::where('studentId', $studentId)->count();
            while ($studentCounts > 0) {
                $numericId = (int) substr($studentId, 2);
                $studentId = 'St' . ($numericId + 1);
                $studentCounts = StudentBilling::where('studentId', $studentId)->count();
            }
        } else {
            $studentId = 'St' . 101;
            $studentCounts = StudentBilling::where('studentId', $studentId)->count();
            while ($studentCounts > 0) {
                $numericId = (int) substr($studentId, 2);
                $studentId = 'St' . ($numericId + 1);
                $studentCounts = StudentBilling::where('studentId', $studentId)->count();
            }
        }
        $request->validate([
            'studentPic' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'studentName' => 'required|string|max:255',
            'fatherName' => 'required|string|max:255',
            'dob' => 'required',
            'phoneNumber' => 'required|unique:students',
            'email' => 'required|email|max:255|unique:students',
            'homeAddress' => 'required|string|max:255',
            'classLevel' => 'required',
            'classDuration' => 'required|string|max:255',
            'classMode' => 'required|string|max:255',
            'subjects' => 'required|max:255',
            'startDate' => 'required|string|max:255',
        ]);

        $this->subject($request->subjects);
        $this->classLevel($request->classLevel);

        $student = new Student();

        if ($request->hasFile('studentPic')) {
            $image = $request->file('studentPic');
            $imgName = Str::slug($request->studentName).'_'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/uploads/studentImages');
            $image->move($destinationPath, $imgName);
        }

        $student->image = $imgName;
        $student->studentId = $studentId;
        $student->studentName = $request->studentName;
        $student->fatherName = $request->fatherName;
        $student->DoB = $request->dob;
        $student->phoneNumber = $request->phoneNumber;
        $student->Email = $request->email;
        $student->parentEmail = $request->parentEmail;
        $student->sendEmail = '0';
        $student->homeAddress = $request->homeAddress;
        $student->classLevel = implode(',', $request->classLevel);
        $student->classDuration = $request->classDuration;
        $student->modeOfClass = $request->classMode;
        $student->subjects = implode(',', $request->subjects);
        $student->startDate = $request->startDate;
        $student->handledBy = $request->handledBy;
        $student->status = $request->status;
        $student->save();

        return Redirect()->back()->with('success', 'Student added successfully.');
    }

    public function edit($id)
    {
        $allSubjects = Subject::pluck('subjectName')->map(function ($value) {
            return strtolower($value);
        });
        $allClassLevels = DB::table('classlevels')->pluck('classLevel');
        $students = Student::find($id);
        $separatedLevels = explode(',', $students->classLevel);
        $students->subjects = strtolower($students->subjects);
        $separatedData = explode(',', $students->subjects);
        $uniqueSubjects = array_unique(array_merge($allSubjects->toArray(), $separatedData));
        $uniqueLevels = array_unique(array_merge($allClassLevels->toArray(), $separatedLevels));

        return view('modules/student/editStudent', compact('students',
            'allSubjects',
            'separatedData',
            'uniqueSubjects',
            'separatedLevels',
            'uniqueLevels'));
    }

    public function update(Request $request)
    {
        if (!empty($request->subjects)) {
            $this->subject($request->subjects);
        }
        if (!empty($request->classLevel)) {
            $this->classLevel($request->classLevel);
        }

        $user = Student::find($request->id);

        $request->validate([
//            'studentPic' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'studentName' => 'required|string|max:255',
            'fatherName' => 'required|string|max:255',
            'dob' => 'required',
            'phoneNumber' => 'required|unique:students,phoneNumber,' . $user->id,
            'email' => 'required|email|unique:students,email,' . $user->id,
            'homeAddress' => 'required|string|max:255',
            'classLevel' => 'required',
            'classDuration' => 'required|string|max:255',
            'classMode' => 'required|string|max:255',
            'subjects' => 'required|max:255',
            'startDate' => 'required|string|max:255',
        ]);

        $student = Student::find($request->id);

        if (!$student) {
            return redirect('/allStudents')->with('error', 'Student not found.');
        }

        if ($request->hasFile('studentPic')) {
            $image = $request->file('studentPic');
            $imgName = Str::slug($request->studentName).'_'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/uploads/studentImages');
            $image->move($destinationPath, $imgName);
            $student->image = $imgName;
        }


        $student->studentId = $request->studentId;
        $student->studentName = $request->studentName;
        $student->fatherName = $request->fatherName;
        $student->DoB = $request->dob;
        $student->phoneNumber = $request->phoneNumber;
        $student->Email = $request->email;
        $student->parentEmail = $request->parentEmail;
        $student->homeAddress = $request->homeAddress;
        $student->classLevel = implode(',', $request->classLevel);
        $student->classDuration = $request->classDuration;
        $student->modeOfClass = $request->classMode;
        $student->subjects = implode(',', $request->subjects);
        $student->startDate = $request->startDate;
        $student->handledBy = $request->handledBy;
        $student->status = $request->status;
        $student->update();

        return redirect('/allStudents')->with('success', 'Student Updated successfully.');
    }

    public function Destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return Redirect()->back();
    }

    public function register()
    {
        $allSubjects = Subject::all();
        $allClassLevels = DB::table('classlevels')->get();

        return view('modules/student/register', compact('allSubjects','allClassLevels'));
    }

    private function subject($subjects)
    {
        foreach ($subjects as $subject) {
            $existingSubject = Subject::where('subjectName', $subject)->first();
            if (!$existingSubject) {
                Subject::create(['subjectName' => $subject]);
            }
        }
    }
    private function classLevel($classLevels)
    {
        foreach ($classLevels as $classLevel) {
            $existingLevel = $allClassLevels = DB::table('classlevels')->where('classLevel', $classLevel)->first();
            if (!$existingLevel) {
                DB::table('classlevels')->insert([
                    'classLevel' => $classLevel,
                ]);
            }
        }
    }

    public function report($id)
    {
        $studentId = $id; // replace with actual studentId
        $student = Student::where('studentId', $studentId)->first();
        $studentBillings = StudentBilling::where('studentId', $studentId)->get();
        $groupedData = [];

        foreach ($studentBillings as $studentBilling) {
            $monthYear = Carbon::parse($studentBilling->classDate)->format('F Y');
            $attendance = $studentBilling->attendance;

            if (!isset($groupedData[$monthYear])) {
                $teacherPaymentSum = StudentBilling::where('studentId', $studentId)
                    ->where('classStatus', 'active')
                    ->where('status', 'paid')
                    ->whereYear('classDate', Carbon::parse($studentBilling->classDate)->year)
                    ->whereMonth('classDate', Carbon::parse($studentBilling->classDate)->month)
                    ->sum('payment');
                $classCount = ($attendance == 'done') ? 1 : 0; // check if attendance is done
                $groupedData[$monthYear] = [
                    'student' => $student,
                    'classCount' => $classCount,
                    'paymentSum' => $teacherPaymentSum,
                    'studentBillings' => [$studentBilling], // add the first billing record for this student
                ];
            } else {
                $classCount = $groupedData[$monthYear]['classCount'];
                if ($attendance == 'done') {
                    $classCount += 1;
                }
                $groupedData[$monthYear]['classCount'] = $classCount;
                $groupedData[$monthYear]['studentBillings'][] = $studentBilling; // add this billing record for this student
            }
        }


        //dd($groupedData);
        return view('modules/student/report', compact('groupedData'));
    }

    public function studentsMonthlyReport()
    {
        $allStudents = Student::all();
        $studentBillings = StudentBilling::all();
        $groupedData = [];

        foreach ($studentBillings as $studentBilling) {
            $monthYear = Carbon::parse($studentBilling->classDate)->format('F Y');
            $studentId = $studentBilling->studentId;
            $attendance = $studentBilling->attendance;

            if (!isset($groupedData[$monthYear][$studentId])) {
                $student = StudentBilling::where('studentId', $studentId)->first('studentName');
                $studentPaymentSum = StudentBilling::where('studentId', $studentId)
                    ->where('ClassStatus', 'active')
                    ->whereYear('classDate', Carbon::parse($studentBilling->classDate)->year)
                    ->whereMonth('classDate', Carbon::parse($studentBilling->classDate)->month)
                    ->sum('payment');
                $studentPendingPayment = StudentBilling::where('studentId', $studentId)
                    ->where('ClassStatus', 'active')
                    ->where('status', 'pending')
                    ->whereYear('classDate', Carbon::parse($studentBilling->classDate)->year)
                    ->whereMonth('classDate', Carbon::parse($studentBilling->classDate)->month)
                    ->sum('payment');
                $lastClassDate = StudentBilling::where('studentId', $studentId)
                    ->where('ClassStatus', 'active')
                    ->orderBy('classDate', 'desc')
                    ->orderBy('classTime', 'desc')
                    ->first();

                $classCount = ($attendance == 'done') ? 1 : 0; // check if attendance is done
                $groupedData[$monthYear][$studentId] = [
                    'student' => $student,
                    'classCount' => $classCount,
                    'paymentSum' => $studentPaymentSum,
                    'studentPendingPayment' => $studentPendingPayment,
                    'lastClassDate' => $lastClassDate,
                    'studentBilling' => $studentBilling,
                ];
            } else {
                $classCount = $groupedData[$monthYear][$studentId]['classCount'];
                if ($attendance == 'done') {
                    $classCount += 1;
                }
                $groupedData[$monthYear][$studentId]['classCount'] = $classCount;
            }
        }

        return view('modules/student/monthlyReport', compact('groupedData'));
    }

    public function reminderEmailForm($name)
    {
        return view('modules/student/ReminderEmailForm', compact('name'));
    }

    public function sendPaymentReminder(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'message' => 'required',
        ]);
        $data = [
            'name' => $request->studentName,
            'message' => $request->message,
        ];
        $email = $request->email;

        $emailController = new EmailController();
        $emailController->paymentReminder($email,$data);


        return redirect('studentsMonthlyReport')->with('success', 'Email sent successfully.');
    }
    
    public function changePermission($id, $status)
    {
        $studentStatus = Student::where('studentId', $id)->first('sendEmail');
        //dd($studentStatus);
        $student = Student::where('studentId', $id)->first();
        if ($studentStatus->sendEmail === 0){
            $student->sendEmail = '1';
        }elseif($studentStatus->sendEmail === 1){
            $student->sendEmail = '0';
        }
        $student->update();

        return redirect()->back();
    }
}
