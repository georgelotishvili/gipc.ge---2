<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('groups')->insert([
            'name' => '255',
        ]);
        DB::table('groups')->insert([
            'name' => '256',
        ]);
        DB::table('groups')->insert([
            'name' => '261',
        ]);
        DB::table('groups')->insert([
            'name' => 'გარემო მიკროკლიმატი მდგრადობა',
        ]);
        DB::table('groups')->insert([
            'name' => 'კანონი არქიტექტურული საქმიანობის შესახებ',
        ]);
        DB::table('groups')->insert([
            'name' => 'კოდექსი',
        ]);
        DB::table('groups')->insert([
            'name' => 'კონსტრუქციები',
        ]);
        DB::table('groups')->insert([
            'name' => 'სერტიფიცირების წესი',
        ]);
    }
}
