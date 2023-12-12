<?php

namespace App\Http\Controllers;

use App\Mail\review;
use App\Models\Register;
use App\Models\StudentBilling;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class BillingController extends Controller
{
    public function studentIndex()
    {
        $allStudents = Student::all();
        $allStudentIds = Student::pluck('studentId');
        $allBillingStudents = DB::table('students_billing_name')->whereIn('studentId', $allStudentIds)->get();
        
        return view('modules/billing/studentBilling', compact('allStudents','allBillingStudents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student' => 'required',
        ]);

        $selected = explode('|', request('student'));
        $stId = $selected[0];
        $stName = $selected[1];

        DB::table('students_billing_name')->insert([
            'studentId' => $stId,
            'studentName' => $stName
        ]);
        return redirect()->back();
    }

    public function studentBilling($studentId)
    {
        $billingRecords = StudentBilling::where('studentId', $studentId)
            ->orderByRaw("STR_TO_DATE(classDate, '%d %M') ASC")
            ->get();



        $total = 0;
        $unpaid = 0;
        $paid = 0;
        $credit = 0;

        foreach ($billingRecords as $record) {
            if ($record->classStatus == 'cancel') {
                if ($record->status == 'paid') {
                    $credit += $record->payment;
                }
            } else {
                $total += $record->payment;
                if ($record->status == 'pending') {
                    $unpaid += $record->payment;
                }
            }
        }

        $paid = $total - $unpaid;

        $allTeachers = Teacher::all();
        $allSubjects = Subject::all();
        $billingStudent = DB::table('students_billing_name')->where('studentId', $studentId)->first();
        $allReviews = DB::table('reviews')->get();

        return view('modules/billing/billingFull', compact('billingStudent','allTeachers','billingRecords','total','unpaid','paid','credit','allSubjects','allReviews'));
    }

    public function studentScheduleDownload($studentId)
    {
        $billingRecords = StudentBilling::where('studentId', $studentId)->get();

        $allTeachers = Teacher::all();
        $allSubjects = Subject::all();
        $billingStudent = DB::table('students_billing_name')->where('studentId', $studentId)->first();;

        return view('modules/billing/studentScheduleDownload', compact('billingStudent','allTeachers','billingRecords','allSubjects'));
    }

    public function createSchedule(Request $request)
    {
        //dd($request);

        foreach ($request->status as $index => $status)
        {
            $selected = explode('|', $request->teacherName[$index]);
            $teacherId = $selected[0];
            $teacherName = $selected[1];
            //dd($selected);

            $studentId = $request->studentId;
            $uuid = (string) Str::uuid();
            $billId = $studentId . $uuid;


            $billing = new StudentBilling();
            $billing->studentId = $request->studentId;
            $billing->billId = $billId;
            $billing->classDate = $request->classDate[$index];
            $billing->classTime = $request->classTime[$index];
            $billing->studentName = $request->studentName;
            $billing->payment = $request->payment[$index];
            $billing->teacherId = $teacherId;
            $billing->teacherName = $teacherName;
            $billing->modeOfClass = $request->modeOfClass[$index];
            $billing->classDuration = $request->classDuration[$index];
            $billing->subject = $request->subject[$index];
            $billing->teacherPayment = $request->teacherPayment[$index];
            $billing->status = $request->status[$index];
            $billing->message = $request->message[$index];
            $billing->classRemarks = 'regular';
            $billing->package_id = $request->packageId;
            $billing->save();

        }

        return redirect()->back()->with('success', 'Record has been added successfully!');
    }
    
    public function recurringClasses(Request $request)
    {
        $request->validate([
            'classDateFrom' => 'required',
            'classDateTill' => 'required',
        ]);
        $classDateFrom = $request->classDateFrom;
        $classDateTill = $request->classDateTill;
        $period = CarbonPeriod::create($classDateFrom, $classDateTill);

        if ($request->recurrence == 'Daily')
        {
            $newDates = [];

            foreach ($period as $date) {
                $newDates[] = $date->format('Y-m-d');
            }
        }
        if ($request->recurrence == 'Weekly')
        {
            $request->validate([
                'days' => 'required|array|min:1',
                'days.*' => 'required|string',
            ]);
            $days = request()->input('days', []);

            foreach ($days as $day)
            {
                foreach ($period as $date) {
                    if ($date->format('l') == $day) {
                        $newDates[] = $date->format('Y-m-d');
                    }
                }
                $dates = $period->toArray();
            }
        }
        foreach ($newDates as $newDate) {

            $billing = new StudentBilling();
            $selected = explode('|', $request->teacherName);
            $teacherId = $selected[0];
            $teacherName = $selected[1];
            //dd($selected);

            $studentId = $request->studentId;
            $uuid = (string) Str::uuid();
            $billId = $studentId . $uuid;


            $billing->studentId = $request->studentId;
            $billing->billId = $billId;
            $billing->classDate = $newDate;
            $billing->classTime = $request->classTime;
            $billing->studentName = $request->studentName;
            $billing->payment = $request->payment;
            $billing->teacherId = $teacherId;
            $billing->teacherName = $teacherName;
            $billing->modeOfClass = $request->modeOfClass;
            $billing->classDuration = $request->classDuration;
            $billing->subject = $request->subject;
            $billing->teacherPayment = $request->teacherPayment;
            $billing->status = $request->status;
            $billing->message = $request->message;
            $billing->classRemarks = 'regular';
            $billing->package_id = $request->packageId;
            $billing->save();
        }
        return redirect()->back()->with('success', 'Record has been added successfully!');
    }

    public function updateStatus(Request $request)
    {
        $billId = $request->billId;
        $billing = StudentBilling::where('billId', $billId)->first();
        $billing->status = "paid";
        $billing->save();
        return redirect()->back()->with('success', 'Payment status updated successfully!');
    }

    public function teacherIndex()
    {
        $allTeachers = Teacher::all();
        $allBillingTeachers = StudentBilling::all();

        return view('modules/billing/teacherBilling', compact('allTeachers','allBillingTeachers'));
    }

    public function teacherBilling($teacherId)
    {
        $teacherName = StudentBilling::where('teacherId', $teacherId)->first()->teacherName;
        $billingTeacher = StudentBilling::where('teacherId', $teacherId)->get();
//        dd($billingTeacher);

        $total = 0;
        $unpaid = 0;

        foreach ($billingTeacher as $record) {
            $total += $record->teacherPayment;
            if ($record->status == 'pending') {
                $unpaid += $record->teacherPayment;
            }
        }
        $paid = $total - $unpaid;

        $allTeachers = Teacher::all();
        $allSubjects = Subject::all();

        return view('modules/billing/teacherBillingFull', compact('teacherName','billingTeacher','allTeachers','total','unpaid','paid','allSubjects'));
    }
    public function teacherScheduleDownload($teacherId)
    {
        $teacherName = StudentBilling::where('teacherId', $teacherId)->first()->teacherName;
        $billingTeacher = StudentBilling::where('teacherId', $teacherId)->get();
//        dd($billingTeacher);

        $allTeachers = Teacher::all();
        $allSubjects = Subject::all();

        return view('modules/billing/teacherScheduleDownload', compact('teacherName','billingTeacher','allTeachers','allSubjects'));
    }

    public function editBill($id)
    {
        $billingRecord = StudentBilling::find($id);
        $allTeachers = Teacher::all();
        $allSubjects = Subject::all();

        return view('modules/billing/editBill', compact('billingRecord','allSubjects','allTeachers'));

    }

    public function updateClass(Request $request)
    {

        //dd( $request );
        $selected = explode('|', $request->teacherName);
        $teacherId = $selected[0];
        $teacherName = $selected[1];

        $billing = StudentBilling::find($request->id);

        //dd( $billing);
        if ($request->classStatus == 'cancel')
        {
            $billing->teacherPayment = 0;
            $billing->attendance = 'pending';
        }elseif ($request->classStatus == 'active')
        {
            $billing->teacherPayment = $request->teacherPayment;
        }
        $billing->studentId = $request->studentId;
        $billing->classDate = $request->classDate;
        $billing->classTime = $request->classTime;
        $billing->studentName = $request->studentName;
        $billing->payment = $request->payment;
        $billing->teacherId = $teacherId;
        $billing->teacherName = $teacherName;
        $billing->modeOfClass = $request->modeOfClass;
        $billing->classDuration = $request->classDuration;
        $billing->subject = $request->subject;
        $billing->status = $request->status;
        $billing->message = $request->message;
        $billing->classStatus = $request->classStatus;
        $billing->classRemarks = $request->classRemarks;
        $billing->updatedBy = $request->updatedBy;
        $billing->update();
        if ($billing->package_id === 0){
            return redirect('/Billing/'.$request->studentId)->with('success', 'Record updated successfully.');
        }else if ($billing->package_id != 0){
            return redirect('/packageDetails/'.$billing->package_id.'/'.$request->studentId)->with('success', 'Record updated successfully.');
        }

        return redirect('/Billing/'.$request->studentId)->with('success', 'Record updated successfully.');
    }
    public function destroyBill($id)
    {
        $billingRecord = StudentBilling::find($id);

        if (!$billingRecord) {
            return redirect()->back()->with('error', 'Billing record not found.');
        }
        $billingRecord->delete();
        return redirect()->back()->with('success', 'Billing record deleted successfully.');
    }

    public function clearCredit($id)
    {
        $allRecords = StudentBilling::where('studentId', $id)
            ->where('classStatus', 'cancel')
            ->update(['status' => 'pending']);
       //dd($allRecords);
        return redirect()->back();
    }

    public function registerIndex()
    {
        $allStudents = Student::all();
        $registrations = Register::all()->groupBy(function ($registration) {
            return Carbon::parse($registration->paymentDate)->format('F Y');
        });
        return view('modules/student/registerIndex',compact('allStudents','registrations'));
    }

    public function storeRegister(Request $request)
    {
       $request->validate([
            'student' => 'required',
            'paymentPaid' => 'required',
            'regFee' => 'required',
            'sessions' => 'required',
            'paymentDate' => 'required',
            'paymentTime' => 'required',
            'paymentType' => 'required',
            'handledBy' => 'required',
        ]);

        $student = explode('|', request('student'));
        $studentId = $student[0];
        $studentName = $student[1];

        $register = new Register();

        $register->studentId = $studentId;
        $register->studentName = $studentName;
        $register->paymentPaid = $request->paymentPaid;
        $register->regFee = $request->regFee;
        $register->totalSessions = $request->sessions;
        $register->paymentDate = $request->paymentDate;
        $register->paymentTime = $request->paymentTime;
        $register->paymentType = $request->paymentType;
        $register->handledBy = $request->handledBy;

        $register->save();

        return redirect()->back()->with('success', 'Data added successfully.');
    }

    public function deleteRecord($id)
    {
        $record = Register::find($id);
        $record->delete();
        return Redirect()->back();

    }
    
    public function sendReview($id, $role){

        $studentBillings = StudentBilling::where('billId', $id)->first();

        if ($role == 'student') {
            $studentEmail = Student::where('studentId', $studentBillings->studentId)->first('Email');
            $studentUrl = url('/reviewFormStudent/' . $studentBillings->billId);
            $data = [
                'link' => $studentUrl,
                'status' => 0
            ];
            Mail::to($studentEmail->Email)->send(new review($data));
            return redirect()->back()->with('success', 'Email sent successfully.');
        }elseif ($role == 'teacher'){
            $teacherEmail = Teacher::where('teacherId', $studentBillings->teacherId)->first('Email');
            $teacherUrl = url('/reviewFormTeacher/' . $studentBillings->billId);
            $data = [
                'link' => $teacherUrl,
                'status' => 1
            ];
            Mail::to($teacherEmail->Email)->send(new review($data));
            return redirect()->back()->with('success', 'Email sent successfully.');
        }elseif ($role == 'both'){
            $studentEmail = Student::where('studentId', $studentBillings->studentId)->first('Email');
            $teacherEmail = Teacher::where('teacherId', $studentBillings->teacherId)->first('Email');
            $studentUrl = url('/reviewFormStudent/' . $studentBillings->billId);
            $teacherUrl = url('/reviewFormTeacher/' . $studentBillings->billId);
            $data = [
                'link' => $studentUrl,
                'status' => 0
            ];
            Mail::to($studentEmail->Email)->send(new review($data));
            $data = [
                'link' => $teacherUrl,
                'status' => 1
            ];
            Mail::to($teacherEmail->Email)->send(new review($data));
            return redirect()->back()->with('success', 'Email sent successfully.');
        }
    }

}
