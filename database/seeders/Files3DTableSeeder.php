<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Files3DTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('three_d_files')->insert([
            ['Order_ID'=>1,'File_Name'=>'Car_Model.stl','File_Path'=>'/uploads/Car_Model.stl','File_Size'=>5.6],
            ['Order_ID'=>2,'File_Name'=>'Vase_Model.obj','File_Path'=>'/uploads/Vase_Model.obj','File_Size'=>3.2],
        ]);
    }
}
