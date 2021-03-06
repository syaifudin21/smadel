<?php

namespace App\Http\Controllers\pengajar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PengajarLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:pengajar')->except(['logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('pengajar.pengajar-login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:5',
            'password' => 'required|min:6'
        ]);

        $credential = [
            'username' => $request->username,
            'password' => $request->password
        ];

        // Attempt to log the user in
        if (Auth::guard('pengajar')->attempt($credential, false)){
            // If login succesful, then redirect to their intended location
            return redirect()->intended(route('pengajar'));
        }

        // If Unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('username', 'remember'));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('pengajar')->logout();
        return redirect('/pengajar');
    }
}
