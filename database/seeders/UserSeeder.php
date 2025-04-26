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
            'password' => Hash::make('archfix123'),
            'is_admin' => 1,
            'position' => 'Architect',
            'company' => 'Arch Studio',
        ]);
        DB::table('users')->insert([
            'name' => 'Giorgi Lotishvili',
            'email' => 'naormala@gmail.com@gmail.com',
            'password' => Hash::make('fixfix123'),
            'is_admin' => 1,
            'position' => 'Architect',
            'company' => 'Arch Studio',
        ]);
        DB::table('users')->insert([
            'name' => 'Sarah Johnson',
            'email' => 'sarah@archstudio.com',
            'password' => Hash::make('password123'),
            'is_admin' => 0,
            'position' => 'Architect',
            'company' => 'Arch Studio',
        ]);
        DB::table('users')->insert([
            'name' => 'David Chen',
            'email' => 'david.chen@example.com',
            'password' => Hash::make('secure456'),
            'is_admin' => 0,
            'position' => 'Civil Engineer',
            'company' => 'Civil Engineering Firm',
        ]);
    }
}
