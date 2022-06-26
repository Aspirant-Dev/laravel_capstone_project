<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\ValidationException;
use App\Admin;
use App\Category;


class LoginController extends Controller
{
    // use ThrottlesLogins;

    public function __construct()
    {
        // $this->middleware('guest:admin');
        $this->middleware('guest:admin',['except' => ['logout']]);
    }
    public function formlogin()
    {
        return view('authadmin.login');

    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required', 'password' => 'required','status' => 'Active',
        ]);

        $credentials = $request->only('username', 'password');

        // This section is the only change
        if (Auth::guard('admin')->validate($credentials)) {
            $user = Auth::guard('admin')->getLastAttempted();
            if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password,'status'=> 'Active']))
            {
                return redirect()->intended('/admin');
            }
            else
            {
                return redirect()->back()
                        ->with(['alert' => 'This account is not active.'])
                        ->withInput($request->only('username'));
                }
        }
        return redirect()->back()->with('alert', 'These credentials do not match our records.')->withInput($request->only('username'));
    }
    public function logout(Request $request)
    {
        if(Auth::guard('admin')->check()) // this means that the admin was logged in.
        {
            Auth::guard('admin')->logout();
            $request->session()->flush();
            $request->session()->regenerate();

            return redirect()->route('authadmin.login');
        }
        // Auth::guard('admin')->logout();
        // $request->session()->flush();
        // $request->session()->regenerate();
        // $request->session()->invalidate();
        // return redirect('/admin/login');
    }
}
