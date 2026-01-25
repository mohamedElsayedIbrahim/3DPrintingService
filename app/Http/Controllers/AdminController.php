<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminController extends Controller
{
    // لوحة التحكم
    public function dashboard()
    {
        $orders = Order::all();
        return view('admin.dashboard', compact('orders'));
    }

    // تحديث حالة الطلب
    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate(['Order_Status'=>'required|string']);
        $order->Order_Status = $request->Order_Status;
        $order->save();

        return back()->with('success','Order status updated');
    }
}
