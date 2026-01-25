<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('materials')->insert([
            ['Name'=>'PLA','Price_Per_Gram'=>0.5],
            ['Name'=>'ABS','Price_Per_Gram'=>0.7],
            ['Name'=>'Resin','Price_Per_Gram'=>1.2],
        ]);
    }
}
