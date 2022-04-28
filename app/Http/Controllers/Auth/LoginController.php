<?php

// This controller was generated when we use the authentication generation command that came in the Laravel/UI package
// Package: composer require laravel/ui
// Command: php artisan ui vue --auth

// There were changes made to this controller's function to fulfill our system requirements, namely redirectTo()

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

    // This trait contains the function to view the Login page
    use AuthenticatesUsers;

    //  * Where to redirect users after login.
    // The location after user logins are determined based on their roles

    protected function redirectTo(){

        if(auth()->user()->status == "Admin"){

            return '/admin/inspection';

        } else {

            return '/';

        }

    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
