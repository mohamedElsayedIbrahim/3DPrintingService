<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            ['Name'=>'Mohamed Ali','Email'=>'mohamed@example.com','Password'=>Hash::make('password123'),'Role'=>'Customer'],
            ['Name'=>'Sara Ahmed','Email'=>'sara@example.com','Password'=>Hash::make('password456'),'Role'=>'Customer'],
            ['Name'=>'Admin User','Email'=>'admin@example.com','Password'=>Hash::make('adminpass'),'Role'=>'Admin'],
        ]);
    }
}
