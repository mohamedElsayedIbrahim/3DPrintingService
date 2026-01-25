<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','order_status','total_price','order_date'];

    // علاقة الطلب بالمستخدم (Many-to-One)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // علاقة الطلب بالملفات (One-to-Many)
    public function files()
    {
        return $this->hasMany(File3D::class, 'order_id');
    }

    // علاقة الطلب بإعدادات الطباعة (One-to-One)
    public function printSetting()
    {
        return $this->hasOne(PrintSetting::class, 'order_id');
    }
}
