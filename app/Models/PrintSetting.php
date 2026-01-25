<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrintSetting extends Model
{
    protected $fillable = ['order_id','material_id','color','quality','quantity'];

    // علاقة إعداد الطباعة بالطلب (Many-to-One)
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // علاقة إعداد الطباعة بالمادة (Many-to-One)
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}
