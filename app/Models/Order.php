<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'city',
        'description',
        'material',
        'quantity',
        'delivery_at',
        'notes',
        'file_path',
        'status',
        'cost',
    ];
}
