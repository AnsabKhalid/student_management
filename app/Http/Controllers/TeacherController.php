<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EmailControllers\send;
use App\Models\Student;
use App\Models\StudentBilling;
use App\Models\Subject;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function index()
    {
        $allTeachers = Teacher::all();

        return view('modules/teacher/index', compact('allTeachers'));
    }

    public function profile($id)
    {
        $teacher = Teacher::find($id);
        $separatedData = explode(',', $teacher->subjects);
        $separatedCities = explode(',', $teacher->cities);
        return view('modules/teacher/teacherProfile', compact('teacher','separatedData','separatedCities'));
    }

    public function showCV($cv) {
        $file = public_path("/assets/uploads/teacherCVs/".$cv);

        return response()->file($file);
    }

    public function add()
    {
        $allSubjects = Subject::all();
        $allClassLevels = DB::table('classlevels')->get();
        $allCities = DB::table('cities')->get();
        return view('modules/teacher/addTeacher', compact('allSubjects','allClassLevels','allCities'));
    }

    public function store(Request $request)
    {

        $teacherCount = Teacher::all();

        if ($teacherCount->count() > 0) {
            $lastTeacher = Teacher::orderBy('created_at', 'desc')->first();
            $teacherId = 'T' . ((int)substr($lastTeacher->teacherId, 1) + 1);
            $teacherCounts = StudentBilling::where('studentId', $teacherId)->count();
            while ($teacherCounts > 0) {
                $numericId = (int) substr($teacherId, 2);
                $teacherId = 'St' . ($numericId + 1);
                $teacherCounts = StudentBilling::where('studentId', $teacherId)->count();
            }
        } else {
            $teacherId = 'T' . 101;
            $teacherCounts = StudentBilling::where('studentId', $teacherId)->count();
            while ($teacherCounts > 0) {
                $numericId = (int) substr($teacherId, 2);
                $teacherId = 'St' . ($numericId + 1);
                $teacherCounts = StudentBilling::where('studentId', $teacherId)->count();
            }
        }
        $request->validate([
            'teacherPic' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'teacherName' => 'required|string|max:255',
            'nicNumber' => 'required|unique:teachers',
            'dob' => 'required',
            'phoneNumber' => 'required|unique:teachers',
            'email' => 'required|email|max:255|unique:teachers',
            'homeAddress' => 'required|string|max:255',
            'techerCV' => 'required|file|mimes:pdf,doc,docx,txt',
            'educQualification' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'teachingLevel' => 'required|max:255',
            'availability' => 'required',
            'cities' => 'required',
            'bio' => 'required',
            'paymentInfo' => 'required',
            'subjects' => 'required|max:255',
        ]);

        $this->subject($request->subjects);
        $this->classLevel($request->teachingLevel);
        if ($request->cities != 'N/A'){
            $this->cities($request->cities);
        }

        $teacher = new Teacher();

        if ($request->hasFile('teacherPic')) {
            $image = $request->file('teacherPic');
            $imgName = Str::slug($request->teacherName).'_'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/uploads/teacherImages');
            $image->move($destinationPath, $imgName);
        }
        if ($request->hasFile('techerCV')) {
            $techerCV = $request->file('techerCV');
            $cvName = Str::slug($request->teacherName).'_'.time().'.'.$techerCV->getClientOriginalExtension();
            $destinationPath = public_path('/assets/uploads/teacherCVs');
            $techerCV->move($destinationPath, $cvName);
        }

        $teacher->teacherId  = $teacherId;
        $teacher->image = $imgName;
        $teacher->teacherName = $request->teacherName;
        $teacher->nicNumber = $request->nicNumber;
        $teacher->DoB = $request->dob;
        $teacher->phoneNumber = $request->phoneNumber;
        $teacher->Email = $request->email;
        $teacher->homeAddress = $request->homeAddress;
        $teacher->cv = $cvName;
        $teacher->educationQualification = $request->educQualification;
        $teacher->experience = $request->experience;
        $teacher->subjects = implode(',', $request->subjects);
        $teacher->teachingLevel = implode(',',$request->teachingLevel);
        $teacher->availability = implode(',',$request->availability);
        $teacher->cities = implode(',',$request->cities);
        $teacher->bio = $request->bio;
        $teacher->paymentInfo = $request->paymentInfo;
        $teacher->handledBy = $request->handledBy;
        $teacher->rating = $request->rating;
        $teacher->save();

        return Redirect()->back()->with('success', 'Teacher added successfully.');
    }

    public function edit($id)
    {
        $allSubjects = Subject::pluck('subjectName')->map(function ($value) {
            return strtolower($value);
        });
        $teacher = Teacher::find($id);
        $teacher->subjects = strtolower($teacher->subjects);
        $separatedSubjects = explode(',', $teacher->subjects);
        $separatedLevels = explode(',', $teacher->teachingLevel);
        $separatedCities = explode(',', $teacher->cities);
        $separatedAvailability = explode(',', $teacher->availability);
        $uniqueSubjects = array_unique(array_merge($allSubjects->toArray(), $separatedSubjects));
        $allClassLevels = DB::table('classlevels')->pluck('classLevel');
        $uniqueLevels = array_unique(array_merge($allClassLevels->toArray(), $separatedLevels));
        $allCities = DB::table('cities')->pluck('cityName');
        $uniqueCities = array_unique(array_merge($allCities->toArray(), $separatedCities));

        return view('modules/teacher/editTeacher', compact('teacher',
            'allSubjects',
            'separatedSubjects',
            'uniqueSubjects',
            'separatedLevels',
            'separatedAvailability',
            'uniqueLevels',
            'uniqueCities',
            'separatedCities'));
    }

    public function update(Request $request)
    {
        //dd($request);
        if (!empty($request->subjects)) {
            $this->subject($request->subjects);
        }
        if (!empty($request->teachingLevel)) {
        $this->classLevel($request->teachingLevel);
        }
        if (!in_array('N/A',$request->cities )){
            if (!empty($request->cities)){
                $this->cities($request->cities);
            }
        }
        $request->validate([
//            'teacherPic' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'teacherName' => 'required|string|max:255',
            'nicNumber' => 'required',
            'dob' => 'required',
            'phoneNumber' => 'required',
            'email' => 'required|email|max:255',
            'homeAddress' => 'required|string|max:255',
//            'techerCV' => 'required|file|mimes:pdf,doc,docx',
            'educQualification' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'teachingLevel' => 'required|max:255',
            'availability' => 'required',
            'cities' => 'required',
            'bio' => 'required',
            'paymentInfo' => 'required',
            'subjects' => 'required|max:255',
        ]);

        $teacher = Teacher::find($request->id);

        if (!$teacher) {
            return redirect('/allTeachers')->with('error', 'Teacher not found.');
        }

        if ($request->hasFile('teacherPic')) {
            $image = $request->file('teacherPic');
            $imgName = Str::slug($request->teacherName).'_'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/uploads/teacherImages');
            $image->move($destinationPath, $imgName);
            $teacher->image = $imgName;
        }
        if ($request->hasFile('techerCV')) {
            $techerCV = $request->file('techerCV');
            $cvName = Str::slug($request->teacherName).'_'.time().'.'.$techerCV->getClientOriginalExtension();
            $destinationPath = public_path('/assets/uploads/teacherCVs');
            $techerCV->move($destinationPath, $cvName);
            $teacher->cv = $cvName;
        }
        if ($request->cites == 'N/A'){
            $teacher->cities = 'N/A';
        }else{
            $teacher->cities = implode(',',$request->cities);
        }

        $teacher->teacherId  = $request->teacherId;
        $teacher->teacherName = $request->teacherName;
        $teacher->nicNumber = $request->nicNumber;
        $teacher->DoB = $request->dob;
        $teacher->phoneNumber = $request->phoneNumber;
        $teacher->Email = $request->email;
        $teacher->homeAddress = $request->homeAddress;
        $teacher->educationQualification = $request->educQualification;
        $teacher->experience = $request->experience;
        $teacher->subjects = implode(',', $request->subjects);
        $teacher->teachingLevel = implode(',',$request->teachingLevel);
        $teacher->availability = implode(',',$request->availability);
        $teacher->bio = $request->bio;
        $teacher->paymentInfo = $request->paymentInfo;
        $teacher->handledBy = $request->handledBy;
        $teacher->rating = $request->rating;
        $teacher->update();

        return redirect('/allTeachers')->with('success', 'Teacher Updated successfully.');
    }

    public function Destroy($id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();
        return Redirect()->back();
    }

    public function register()
    {
        $allSubjects = Subject::all();
        $allClassLevels = DB::table('classlevels')->get();
        $allCities = DB::table('cities')->get();
        return view('modules/teacher/register', compact('allSubjects','allClassLevels','allCities'));
    }

    public function sendEmail(Request $request)
    {

        $request->validate([
            'selectedTeachers' => 'required',
        ]);

        $studentName = $request->studentName;
        $subjects = $request->subjects;
        $teachers = $request->selectedTeachers;
        $subjectsString = implode(',', $subjects);
        //$teachers = Teacher::whereIn('id', $teacherIds)->get();

        foreach ($teachers as $teacher)
        {
            $singleTeacher = explode('|', $teacher);

            $emailController = new EmailController();
            $emailController->send($singleTeacher[0], $singleTeacher[1],$studentName,$subjectsString);
        }

        return redirect()->back()->with('success', 'Emails have been sent successfully!');
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
    private function cities($cities)
    {
        foreach ($cities as $city) {
            $existingCities = $allCities = DB::table('cities')->where('cityName', $city)->first();
            if (!$existingCities) {
                DB::table('cities')->insert([
                    'cityName' => $city,
                ]);
            }
        }
    }

    public function teachersReport()
    {
        $allTeachers = Teacher::all();
        $studentBillings = StudentBilling::all();
        $groupedData = [];

        foreach ($studentBillings as $studentBilling) {
            $monthYear = Carbon::parse($studentBilling->classDate)->format('F Y');
            $teacherId = $studentBilling->teacherId;
            $attendance = $studentBilling->attendance;


            if (!isset($groupedData[$monthYear][$teacherId])) {
                $teacherInfo = Teacher::where('teacherId', $teacherId)->first('paymentInfo');
                $teacher = StudentBilling::where('teacherId', $teacherId)->first('teacherName');
                $teacherPaymentSum = StudentBilling::where('teacherId', $teacherId)
                    ->where('attendance', 'done')
                    ->whereYear('classDate', Carbon::parse($studentBilling->classDate)->year)
                    ->whereMonth('classDate', Carbon::parse($studentBilling->classDate)->month)
                    ->sum('teacherPayment');
                $classCount = ($attendance == 'done') ? 1 : 0; // check if attendance is done
                $groupedData[$monthYear][$teacherId] = [
                    'teacher' => $teacher,
                    'classCount' => $classCount,
                    'paymentSum' => $teacherPaymentSum,
                    'teacherInfo' => $teacherInfo
                ];
            } else {
                $classCount = $groupedData[$monthYear][$teacherId]['classCount'];
                if ($attendance == 'done') {
                    $classCount += 1;
                }
                $groupedData[$monthYear][$teacherId]['classCount'] = $classCount;
            }
        }
        //dd($groupedData);

        return view('modules/teacher/report', compact('groupedData'));


    }
}
