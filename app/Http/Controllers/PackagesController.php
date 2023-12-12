<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Student;
use App\Models\StudentBilling;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackagesController extends Controller
{
    public function allPackages($studentId)
    {
        $allPackages = Package::where('studentId', $studentId)
            ->orderBy('pkgId')
            ->get()
            ->groupBy('pkgId');
        $student = Student::where('studentId', $studentId)
            ->first();
        $separatedSubjects = explode(',', $student->subjects);
//        dd($separatedSubjects);

        $billingRecords = StudentBilling::where('studentId', $studentId)
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
        
        $billingStudent = DB::table('students_billing_name')->where('studentId', $studentId)->first();

        return view('modules/billing/allPackages', compact('allPackages', 'student', 'separatedSubjects','total','unpaid','paid','credit','billingRecords','billingStudent'));
    }

   public function createPackage(Request $request)
    {

       $lastPackage = Package::latest()->first();
        if ($lastPackage == null) {
            $lastId = 1;
        } else {
            $lastId = (int) $lastPackage->pkgId + 1;
        }
        //dd($lastId);
        foreach ($request->input('subject') as  $index => $subject) {
            $package = new Package();
            $package->studentId = $request->input('studentId');
            $package->name = $request->input('name');
            $package->subject = $subject;
            $package->noOfClasses = $request->input('noOfClasses')[$index];
            $package->classDuration = $request->input('classDuration')[$index];
            $package->payment = $request->input('payment')[$index];
            $package->pkgId = $lastId;
            $package->save();
        }

        return redirect('/packages/'.$package->studentId);
    }

     public function Destroy($studentId,$id)
    {

        StudentBilling::where('package_id', $id)->delete();
        Package::where('pkgId', $id)->delete();


        return redirect('/packages/'.$studentId);
    }
    
    public function editPackage($id)
    {
        $package = Package::where('pkgId', $id)->get();
        //dd($package);
        $student = Student::where('studentId', $package[0]->studentId)
            ->first();
        $separatedSubjects = explode(',', $student->subjects);
        return view('modules/billing/editPkg', compact('package', 'student', 'separatedSubjects'));
    }
    
     public function updatePackage(Request $request)
    {
        //dd($request->all());
//        dd($request->id);
        foreach ($request->input('id') as  $index => $id) {
            $package = Package::find($request->input('id')[$index]);
            $package->name = $request->name;
            $package->studentId = $request->studentId;
            $package->pkgId = $request->pkgId;
            $package->subject = $request->input('subject')[$index];
            $package->noOfClasses = $request->input('noOfClasses')[$index];
            $package->classDuration = $request->input('classDuration')[$index];
            $package->payment = $request->input('payment')[$index];
            $package->update();
        }

        //return redirect()->back()->with('message', 'Package Updated Successfully');
        return redirect('/packageDetails/'.$request->pkgId.'/'.$request->studentId);
    }

    public function packageFull($id, $studentId)
    {
        $package = Package::where('pkgId', $id)
            ->get()
            ->groupBy('pkgId');
        //dd($package->first()->first()->pkgId);
        //dd($package[1][1]->name);
        $billingRecords = StudentBilling::where('studentId', $studentId)
            ->where('package_id', $id)
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
        $student = Student::where('studentId', $studentId)
            ->first();
        $separatedSubjects = explode(',', $student->subjects);
        $billingStudent = DB::table('students_billing_name')->where('studentId', $studentId)->first();
        $allReviews = DB::table('reviews')->get();
        //dd($separatedSubjects);

        return view('modules/billing/packageFull', compact('billingStudent','allTeachers','billingRecords','total','unpaid','paid','credit','separatedSubjects','allReviews','package'));
    }

}
