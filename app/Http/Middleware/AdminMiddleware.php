<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // لو المستخدم مسجل دخول و type = admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // لو مش admin، رجعه للصفحة الرئيسية
        return redirect('/');
    }
}
