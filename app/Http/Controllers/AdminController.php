<?php

// This controller was created for handling Admin actions
// No special package used

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // This function is for viewing the Admin Register page
    protected function adminRegisterPage(){

        return view('auth/registerAdmin');

    }

    // This function is for registering admin accounts
    protected function registerAdmin(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => "Admin",
            'password' => Hash::make($data['password']),

        ]);

        return redirect('/admin/inspection');
    }
}
