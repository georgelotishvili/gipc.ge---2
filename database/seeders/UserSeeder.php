<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Giorgi Bekurashvili',
            'email' => 'giorgibekurashvili@gmail.com',
            'password' => Hash::make('fixfix123'),
            'is_admin' => 1,
        ]);
        DB::table('users')->insert([
            'name' => 'Giorgi Lotishvili',
            'email' => 'naormala@gmail.com@gmail.com',
            'password' => Hash::make('fixfix123'),
            'is_admin' => 1,
        ]);
    }
}
