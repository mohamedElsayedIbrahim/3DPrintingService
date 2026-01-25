<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrintSettingsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('print_settings')->insert([
            ['Order_ID'=>1,'Material_ID'=>1,'Color'=>'Red','Quality'=>'High','Quantity'=>1],
            ['Order_ID'=>2,'Material_ID'=>3,'Color'=>'Blue','Quality'=>'Medium','Quantity'=>2],
        ]);
    }
}
