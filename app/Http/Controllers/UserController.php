<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $allUsers = User::all();

        return view('modules/staff/allStaff', compact('allUsers'));
    }

    public function add()
    {
        return view('modules/staff/addStaff');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'email' => 'required|email|unique:users',
            'phoneNumber' => 'required|unique:users',
            'password' => 'required|min:8',
            'role' => 'required'
        ]);

        $user = new User();

        $role = Role::where('name', $request->role)->first();

        if ($role) {
            $user->role()->associate($role);
        } else {
            return back()->withInput()->with('error', 'Role not found');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imgName = Str::slug($request->name).'_'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/uploads/staffImages');
            $image->move($destinationPath, $imgName);
        }

        $user->name = $request->name;
        $user->image = $imgName;
        $user->email = $request->email;
        $user->phoneNumber = $request->phoneNumber;
        $user->password = Hash::make($request->password);
        $user->save();

        $allUsers = User::all();

        return view('/modules/staff/allStaff', [
            'success' => 'User added successfully.',
            'allUsers' => $allUsers
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('modules/staff/editStaff', compact('user'));
    }

    public function update(Request $request)
    {

        $user = User::find($request->id);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phoneNumber' => 'required|unique:users,phoneNumber,' . $user->id,
            'role' => 'required'
        ]);

        $role = Role::where('name', $request->role)->first();

        if ($role) {
            $user->role()->associate($role);
        } else {
            return back()->withInput()->with('error', 'Role not found');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imgName = Str::slug($request->name).'_'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/uploads/staffImages');
            $image->move($destinationPath, $imgName);
            $user->image = $imgName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phoneNumber = $request->phoneNumber;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->update();

        $allUsers = User::all();

        return view('/modules/staff/allStaff', [
            'success' => 'User added successfully.',
            'allUsers' => $allUsers
        ]);
    }

    public function Destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return Redirect()->back();
    }
}
