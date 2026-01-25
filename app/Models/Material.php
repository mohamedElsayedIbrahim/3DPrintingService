<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['name','price_per_gram'];

    // علاقة المادة بإعدادات الطباعة (One-to-Many)
    public function printSettings()
    {
        return $this->hasMany(PrintSetting::class, 'material_id');
    }
}
