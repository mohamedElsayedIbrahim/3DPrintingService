<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * عرض الصفحة الرئيسية
     */
    public function index()
    {
        $orders = Order::latest()->get();

        return view('home', compact('orders'));
    }

    /**
     * حفظ الطلب الجديد
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'full_name'   => 'required|string|max:255',
        'email'       => 'required|email',
        'phone'       => 'required|string|max:20',
        'city'        => 'nullable|string|max:100',
        'description' => 'required|string',
        'material'    => 'required|string',
        'quantity'    => 'required|integer|min:1',
        'delivery_at' => 'nullable|date',
        'notes'       => 'nullable|string',
        'file'        => 'required|file|max:80480', // 20MB
    ]);

    $file = $request->file('file');

    $allowedExtensions = ['stl', 'obj'];

    if (! in_array(strtolower($file->getClientOriginalExtension()), $allowedExtensions)) {
        return response()->json([
            'message' => 'نوع الملف غير مدعوم، الصيغ المسموحة STL و OBJ فقط',
        ], 422);
    }

    // رفع الملف
    $filePath = $request->file('file')->store('orders', 'public');

    Order::create([
        'full_name'   => $validated['full_name'],
        'email'       => $validated['email'],
        'phone'       => $validated['phone'],
        'city'        => $validated['city'] ?? null,
        'description' => $validated['description'],
        'material'    => $validated['material'],
        'quantity'    => $validated['quantity'],
        'delivery_at' => $validated['delivery_at'],
        'notes'       => $validated['notes'],
        'file_path'   => $filePath,
        'status'      => 'pending',
        'cost'        => 0,
    ]);

    // ✅ لو الطلب AJAX
    if ($request->expectsJson()) {
        return response()->json([
            'message' => 'تم إرسال الطلب بنجاح',
        ], 201);
    }

    // ✅ لو submit عادي
    return redirect()
        ->back()
        ->with('success', 'تم إرسال الطلب بنجاح');
}


    /**
     * حذف طلب
     */
    public function destroy(Order $order)
    {
        if ($order->file_path) {
            Storage::disk('public')->delete($order->file_path);
        }

        $order->delete();

        return back()->with('success', 'تم حذف الطلب');
    }
}
