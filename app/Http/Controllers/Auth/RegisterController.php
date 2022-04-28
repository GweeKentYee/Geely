<?php

// This controller was generated when we use the authentication generation command that came in the Laravel/UI package
// Package: composer require laravel/ui
// Command: php artisan ui vue --auth

// There were changes made to this controller's function to fulfill our system requirements
// We have removed the original functions and replaced it with our own (registerUser, registerAdminApi)

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // This trait contains the function to view the Register page
    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    // This function registers customer account
    protected function registerUser(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => "Customer",
            'password' => Hash::make($data['password']),

        ]);

        $this->guard()->login($user);

        return redirect('/');
    }

    // This function registers admin account through API
    protected function registerAdminApi(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => "Admin",
            'password' => Hash::make($data['password']),

        ]);

        return response($user, 200);
    }

}
