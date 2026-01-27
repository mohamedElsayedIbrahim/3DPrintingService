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
            'file'        => 'required|file|mimes:stl,obj,3mf|max:20480',
        ]);

        // رفع الملف
        $filePath = $request->file('file')->store('orders', 'public');

        // إنشاء الطلب
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
            'cost'        => 0, // يتحسب لاحقاً
        ]);

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
