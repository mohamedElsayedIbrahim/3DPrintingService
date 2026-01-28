<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Constructor
     * Apply middleware to ensure only authenticated admins can access
     */
    public function __construct()
    {
        $this->middleware(AdminMiddleware::class); // 'admin' middleware to check type
    }

    /**
     * Show the admin dashboard
     */
    public function index()
    {
        // هنا ممكن تجيب بيانات خاصة بالادمن، مثل الطلبات أو المستخدمين
        // على سبيل المثال:
        $orders = \App\Models\Order::latest()->get();

        return view('admin.dashboard',compact('orders')); // ملف view resources/views/admin/dashboard.blade.php
    }
}
