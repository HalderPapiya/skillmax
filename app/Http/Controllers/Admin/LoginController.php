<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest:admin')->except('logout');
    // }

    public function showLoginForm()
    {
        return view('auth.login');
    }
    // 
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required | string | email | exists:admins',
            'password' => 'required | string '
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('admin/dashboard');
        }
        return back()->withInput($request->only('email', 'remember'))->withErrors([
            'password' => 'Wrong password.',
        ]);
    }

    public function logout(Request $request)
    {
        // dd($request->all());
        $this->guard('admin')->logout();

        $request->session()->invalidate();

        return redirect()->route('admin.admin.login');
    }
}