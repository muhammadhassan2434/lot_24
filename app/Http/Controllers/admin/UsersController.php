<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('admin.user.userlist', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.createuser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateuser = validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'role' => 'required',
                'password' => 'required',
            ]
        );
        if ($validateuser->fails()) {
            return redirect()->back()->withErrors($validateuser->errors());
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password,
        ]);

        return redirect()->route('user.index')->with('sucess', "User Created SuccessFully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('admin.user.edituser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = User::find($id);
        $validateuser = validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'role' => 'required',
            ]
        );
        if ($validateuser->fails()) {
            return redirect()->back()->withErrors($validateuser->errors());
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }// Hash the password

        $user->save();

        return redirect()->route('user.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete($id);
        return redirect()->route('user.index')->with('success', 'User deleted successfully!');
    }

    //admin auth

    public function adminlogin(Request $request)
    {
        $validator = validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $user = User::where('email', $request->email)->first();

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->back()->with('error', 'Wrong password. Please try again.');
        } elseif (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            Auth::login($user);
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admindashboard.index');
            } else {
                return redirect()->back()->with('Error', 'You are not eligible');
            }
        } else {
            return redirect()->back()->with('Error', 'You are not eligible');
        }
    }

    public function adminlogout()
    {
        Auth::logout(); // Log out the user
        return redirect()->route('admin')->with('success', 'You have been logged out.');
    }
}
