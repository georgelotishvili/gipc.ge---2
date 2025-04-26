<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specialities')->insert([
            'name' => 'არქიტექტორი',
        ]);
        DB::table('specialities')->insert([
            'name' => 'არქიტექტორი ექსპერტი',
        ]);
    }
}
