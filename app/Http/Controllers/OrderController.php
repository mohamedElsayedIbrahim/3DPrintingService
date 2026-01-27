<?php


namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\DesignFile;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // الصفحة الرئيسية + الفورم
    public function index()
    {
        return view('home');
    }

    // عرض الطلبات
    public function orders()
    {
        $orders = Order::latest()->get();
        return view('orders.index', compact('orders'));
    }

    // حفظ طلب جديد
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'project_description' => 'required',
            'material' => 'required',
            'quantity' => 'required|integer|min:1',
            'design_file' => 'required|file|mimes:stl,obj,3mf'
        ]);

        $order = Order::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'project_description' => $request->project_description,
            'material' => $request->material,
            'quantity' => $request->quantity,
            'delivery_date' => $request->delivery_date,
            'notes' => $request->notes,
            'status' => 'قيد المراجعة',
            'total_cost' => $request->total_cost ?? 0
        ]);

        // رفع الملف
        if ($request->hasFile('design_file')) {
            $path = $request->file('design_file')->store('design_files', 'public');

            DesignFile::create([
                'order_id' => $order->id,
                'file_path' => $path,
                'file_type' => $request->file('design_file')->getClientOriginalExtension()
            ]);
        }

        return redirect()->back()->with('success', 'تم إرسال الطلب بنجاح');
    }

    // حذف طلب
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('success', 'تم حذف الطلب');
    }
}
