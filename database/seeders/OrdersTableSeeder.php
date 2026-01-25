<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('orders')->insert([
            ['User_ID'=>1,'Order_Status'=>'Pending','Total_Price'=>150.50,'Order_Date'=>'2026-01-25'],
            ['User_ID'=>2,'Order_Status'=>'In Progress','Total_Price'=>200.00,'Order_Date'=>'2026-01-24'],
        ]);
    }
}
