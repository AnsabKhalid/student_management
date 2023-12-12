<?php

namespace App\Http\Controllers;

use App\Mail\paymentReminder;
use App\Mail\sendteacherSchedule;
use App\Mail\studentEmail;
use App\Models\Student;
use App\Models\StudentBilling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use App\Mail\alertEmail;
use App\Mail\pendingEmail;
use App\Mail\sendSchedule;
use App\Mail\teacherEmail;

class EmailController extends Controller
{

    public function send($teacherName, $teacherEmail,$studentName,$subjectsString)
    {

        $data = [
            'teacherName' => $teacherName,
            'studentName' => $studentName,
            'subjectsString' => $subjectsString,
        ];

//        dd($teacherEmail);
        Mail::to($teacherEmail)->send(new Email($data));

        return true;
    }
    public function classAlertEmail($Email,$name,$message,$classTime): bool
    {
        $data = [
            'name' => $name,
            'message' => $message,
            'classTime' => $classTime,
        ];
        Mail::to($Email)->send(new alertEmail($data));

        return true;
    }

    public function sendReminder()
    {
        $studentBillings = StudentBilling::where('status', 'pending')->get();
        $studentIds = $studentBillings->pluck('studentId')->unique();

        foreach ($studentIds as $studentId)
        {
            $studentBillingsForStudent = $studentBillings->where('studentId', $studentId);
            $pendingAmount = $studentBillingsForStudent->sum('payment');
            $student = $studentBillingsForStudent->first();

            $studentEmail = Student::where('studentId', $studentId)->first();
            $email = $studentEmail->Email;


            $data = [
                'studentName' => $student->studentName,
                'payment' => $pendingAmount,
            ];


            Mail::to($email)->send(new pendingEmail($data));
        }

        return true;
    }

    public function sendSchedule($email,$Billings)
    {
        $data = [
            'classData' => $Billings,
        ];
        //dd($Billings);
        Mail::to($email)->send(new sendSchedule($data));
    }
    public function teacherSchedule($email,$Billings)
    {
        $data = [
            'classData' => $Billings,
        ];
        Mail::to($email)->send(new sendteacherSchedule($data));
    }
    public function teacherEmail($email,$data)
    {
        Mail::to($email)->send(new teacherEmail($data));
    }

    public function studentEmail($email,$data)
    {
        Mail::to($email)->send(new studentEmail($data));
    }

    public function paymentReminder($email,$data)
    {
        Mail::to($email)->send(new paymentReminder($data));
    }

}
