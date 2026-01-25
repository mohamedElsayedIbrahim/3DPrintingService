<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // عرض صفحة تسجيل الدخول
    public function showLogin()
    {
        return view('auth.login');
    }

    // معالجة تسجيل الدخول
    public function login(Request $request)
    {
        $credentials = $request->only('Email','Password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(Auth::user()->Role == 'Admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('orders.index');
        }

        return back()->withErrors(['Email'=>'Invalid credentials']);
    }

    // عرض صفحة التسجيل
    public function showRegister()
    {
        return view('auth.register');
    }

    // معالجة التسجيل
    public function register(Request $request)
    {
        $request->validate([
            'Name'=>'required|string|max:255',
            'Email'=>'required|email|unique:users,Email',
            'Password'=>'required|min:6|confirmed',
        ]);

        User::create([
            'Name'=>$request->Name,
            'Email'=>$request->Email,
            'Password'=>Hash::make($request->Password),
            'Role'=>'Customer'
        ]);

        return redirect()->route('login')->with('success','Account created successfully');
    }

    // تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }
}
