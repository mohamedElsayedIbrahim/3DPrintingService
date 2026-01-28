<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddleware;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $orders = \App\Models\Order::latest()->get();

        return view('admin.dashboard',compact('orders')); // ملف view resources/views/admin/dashboard.blade.php
    }

    public function users()
    {
        $admins = User::where('role', 'admin')->latest()->get();
        return view('admin.users', compact('admins'));
    }

    // عرض نموذج إنشاء Admin جديد
public function createUser()
{
    return view('admin.create_user');
}

// حفظ مستخدم Admin جديد
    // حفظ مستخدم Admin جديد
    public function storeUser(Request $request)
    {
        try {
            // تحقق من صحة البيانات
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ]);

            // إنشاء المستخدم
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'admin',
            ]);

            return redirect()->route('admin.users')->with('success', 'تم إضافة المشرف الجديد بنجاح.');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // إعادة التوجيه مع الأخطاء للـ form
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // خطأ عام
            return back()->with('error', 'حدث خطأ أثناء إضافة المستخدم: ' . $e->getMessage())->withInput();
        }
    }

}
