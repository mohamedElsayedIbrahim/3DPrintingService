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
        'project_description',
        'material',
        'quantity',
        'delivery_date',
        'notes',
        'status',
        'total_cost'
    ];

    public function files()
{
    return $this->hasMany(DesignFile::class);
}
}

