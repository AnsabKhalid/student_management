<?php

namespace App\Console;

use App\Mail\pendingEmail;
use App\Mail\review;
use App\Mail\sendSchedule;
use App\Mail\sendteacherSchedule;
use App\Mail\studentReminderEmail;
use App\Mail\teacherReminderEmail;
use App\Models\Student;
use App\Models\StudentBilling;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{


    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        
        $schedule->call(function () {
            $allStudentIds = Student::pluck('studentId');
            $tom = Carbon::tomorrow();
            $studentBillings = StudentBilling::whereIn('studentId', $allStudentIds)
            ->where('classStatus', 'active')
            ->where('attendance', 'pending')
            ->whereDate('classDate', '<=', $tom)
            ->get();

            foreach ($studentBillings as $studentBilling) {
                $classDate = $studentBilling->classDate;
                $classTime = $studentBilling->classTime;
                $dateTime = Carbon::parse($classDate.' '.$classTime);
                $now = Carbon::now();
                $classDetails = $studentBilling;
                // echo $now->diffInHours($classDate)."===";
                if ($now->diffInHours($dateTime) <= 24) {
                    $studentBilling->attendance = 'done';
                    $studentBilling->save();

                    $studentEmail = Student::where('studentId', $studentBilling->studentId)->value('Email');
                    $teacherEmail = Teacher::where('teacherId', $studentBilling->teacherId)->value('Email');
                    $parentEmail = Student::where('studentId', $studentBilling->studentId)->first('parentEmail');
                    $status = Student::where('studentId', $studentBilling->studentId)->first('sendEmail');
                // echo $parentEmail->parentEmail;
                // echo $status->sendEmail;

                    $message = $studentBilling->message;

                    $data = [
                        'studentName' => $studentBilling->studentName,
                        'teacherName' => $studentBilling->teacherName,
                        'message' => $message,
                        'status' => 0,
                        'classDetails' => $classDetails,
                    ];

                // Send emails to teacher and student
                    try {
                    // echo 'hello';
                        Mail::to($studentEmail)->send(new studentReminderEmail($data));
                        Mail::to($teacherEmail)->send(new teacherReminderEmail($data));
                        if ($status->sendEmail === 1){
                            $data = [
                                'studentName' => $studentBilling->studentName,
                                'message' => $message,
                                'status' => 1
                            ];
                            Mail::to($parentEmail->parentEmail)->send(new studentReminderEmail($data));
                        }
                    } catch (\Exception $e) {
                    // Handle error
                        Log::error("Error sending reminder email: " . $e->getMessage());
                    }
                }
            }
        })->everyTwoHours();

    }


    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
