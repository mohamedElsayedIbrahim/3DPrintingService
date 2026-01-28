<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // عرض نموذج التسجيل
    public function showRegistrationForm()
    {
        return view('auth.register'); // resources/views/auth/register.blade.php
    }

    // معالجة التسجيل
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'=>'user',
        ]);

        Auth::login($user); // تسجيل الدخول تلقائياً بعد التسجيل

        return redirect('/'); // العودة للصفحة الرئيسية بعد التسجيل
    }
}
