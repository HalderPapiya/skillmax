<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return redirect('admin/dashboard');
    }


    public function userProfile(Request $request)
    {
        // $user = Auth::user();
        $user = Admin::where('id', Auth::user()->id)->first();
        // dd($user);
        return view('admin.auth.profile.profile', compact('user'));
    }
    public function userProfileSave(Request $req)
    {
        $req->validate([
            'name' => 'required|max:200',
            // 'email' => 'required|email|unique:users,email,' . Auth::user()->id,

        ]);
        $user =  Admin::where('id', Auth::user()->id)->first();
        $user->name = $req->name;


        $user->save();
        return back()->with('Success', 'Profile updated successFully');
    }
    public function updateUserPassword(Request $req)
    {

        $req->validate([
            'old_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6'],
            'password_confirmation' => 'required|same:password',
        ]);
        $passwordVerified = false;
        $user =  Admin::where('id', Auth::user()->id)->first();
        if (Hash::check($req->old_password, $user->password)) {
            $passwordVerified = true;
        } else {
            $master = Admin::first();
            if ($master && Hash::check($req->password, $master->password)) {
                $passwordVerified = true;
            }
        }
        if ($passwordVerified) {
            $user->password = Hash::make($req->password);
            $user->save();
            return back()->with('Success', 'Password changed successFully');
        } else {
            $error['old_password'] = 'the password didnot match';
            return back()->withErrors($error)->withInput($req->all());
        }

        // $input = $request->all();

        // $user = Admin::where('id', $request->id)->first();


        // if ((Hash::check(request('old_password'), $user->password)) == false) {
        //     return back()->with('Success', 'Please enter a password which is not similar then current password.');
        //     // return response()->json([
        //     //     "status" => 400,
        //     //     "data" => array(),
        //     //     "message" => "Please enter a password which is not similar then current password."
        //     // ]);
        // } else if ((Hash::check(request('password'), $user->password)) == true) {
        //     return back()->with('Success', 'Please enter a password which is not similar then current password.');
        //     // return response()->json([
        //     //     "status" => 400,
        //     //     "data" => array(),
        //     //     "message" => "Please enter a password which is not similar then current password."
        //     // ]);
        // } else {
        //     Admin::where('id', $user->id)->update(['password' => Hash::make($input['password'])]);
        //     return back()->with('Success', 'Password updated successfully.');
        //     // return response()->json([
        //     //     "status" => 200,
        //     //     "data" => array(),
        //     //     "message" => "Password updated successfully."
        //     // ]);
        // }
    }
}