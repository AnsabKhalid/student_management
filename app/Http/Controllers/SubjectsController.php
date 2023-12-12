<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectsController extends Controller
{
    public function index()
    {
        $allSubjects = Subject::all();

        return view('modules/subjects', compact('allSubjects'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'subjectName' => 'required|string|max:255|unique:subjects',
        ]);
        $subject = new Subject();
        $subject->subjectName = $request->subjectName;
        $subject->save();

        return Redirect()->back();
    }
    public function Destroy($id)
    {
        $subject = Subject::find($id);
        $subject->delete();
        return Redirect()->back();
    }

    public function classLevelsIndex()
    {
        $allClassLevels = DB::table('classlevels')->get();
        return view('modules/classLevels', compact('allClassLevels'));
    }
    public function addClassLevel(Request $request)
    {
        $request->validate([
            'classLevel' => 'required|string|max:255|unique:classLevels',
        ]);
        DB::table('classlevels')->insert([
            'classLevel' => $request->classLevel,
        ]);
        return Redirect()->back();
    }
    public function DestroyClassLevel($id)
    {
        DB::table('classlevels')
            ->where('id', '=', $id)
            ->delete();
        return Redirect()->back();
    }

    public function citiesIndex()
    {
        $allCities = DB::table('cities')->get();
        return view('modules/cities', compact('allCities'));
    }

    public function addCity(Request $request)
    {
        $request->validate([
            'cityName' => 'required|string|max:255|unique:cities',
        ]);
        DB::table('cities')->insert([
            'cityName' => $request->cityName,
        ]);
        return Redirect()->back();
    }

    public function DestroyCity($id)
    {
        DB::table('cities')
            ->where('id', $id)
            ->delete();
        return Redirect()->back();
    }
    public function todoIndex()
    {
        $allTodo = DB::table('todo')->get();
        $allStaff = User::where('role_id', 2)->get();
        $allUser = User::all();
        //dd($allStaff);
        return view('modules/todo', compact('allTodo','allStaff','allUser'));
    }

    public function addTask(Request $request)
    {
        //dd(Carbon::now());
        $request->validate([
            'task' => 'required',
            'staff' => 'required',
        ]);
        DB::table('todo')->insert([
            'todo' => $request->task,
            'assignedTo' => $request->staff,
            'assignedBy' => $request->assignedBy,
            'status' => "pending",
        ]);
        return Redirect()->back();
    }

    public function deleteTodo($id)
    {
        DB::table('todo')
            ->where('id', $id)
            ->delete();
        return Redirect()->back();
    }

    public function updateTodo($id)
    {
        DB::table('todo')
            ->where('id', $id)
            ->update(['status' => 'done']);

        return Redirect()->back();
    }

    public function updateRemark(Request $request)
    {
        DB::table('todo')
            ->where('id', $request->id)
            ->update(['remark' => $request->remark]);

        return Redirect()->back();
    }
}