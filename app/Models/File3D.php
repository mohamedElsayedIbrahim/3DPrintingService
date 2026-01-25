<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File3D extends Model
{
    protected $table = 'three_d_files';
    protected $fillable = ['order_id','file_name','file_path','file_size'];

    // علاقة الملف بالطلب (Many-to-One)
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
