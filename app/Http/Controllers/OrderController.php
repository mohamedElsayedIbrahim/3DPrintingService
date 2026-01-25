<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\File3D;
use App\Models\PrintSetting;

class OrderController extends Controller
{
    // عرض كل الطلبات للمستخدم
    public function index()
    {
        $orders = auth('web')->user()->orders;
        return view('orders.index', compact('orders'));
    }

    // عرض صفحة إنشاء طلب جديد
    public function create()
    {
        return view('orders.create');
    }

    // معالجة إنشاء الطلب
    public function store(Request $request)
    {
        $request->validate([
            'files.*'=>'required|file',
            'Material_ID'=>'required|exists:materials,Material_ID',
            'Color'=>'required|string',
            'Quality'=>'required|string',
            'Quantity'=>'required|integer|min:1'
        ]);

        $order = Order::create([
            'User_ID'=>auth('web')->id(),
            'Order_Status'=>'Pending',
            'Total_Price'=>100, // يمكن تعديلها لاحقاً لحساب السعر ديناميكي
            'Order_Date'=>now()
        ]);

        // حفظ الملفات
        foreach($request->file('files') as $file){
    $fileModel = new File3D();
    $fileModel->Order_ID = $order->Order_ID;
    $fileModel->File_Name = $file->getClientOriginalName();

    // حفظ الملف في storage/app/uploads
    $fileModel->File_Path = $file->store('uploads');

    // حجم الملف بالميجابايت
    $fileModel->File_Size = round($file->getSize() / 1024 / 1024, 2);
    $fileModel->save();
}


        // حفظ إعدادات الطباعة
        PrintSetting::create([
            'Order_ID'=>$order->Order_ID,
            'Material_ID'=>$request->Material_ID,
            'Color'=>$request->Color,
            'Quality'=>$request->Quality,
            'Quantity'=>$request->Quantity
        ]);

        return redirect()->route('orders.index')->with('success','Order created successfully');
    }
}
