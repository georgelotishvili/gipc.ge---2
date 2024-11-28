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
            'title' => '255',
        ]);
        DB::table('groups')->insert([
            'name' => '256',
            'title' => '256',
        ]);
        DB::table('groups')->insert([
            'name' => '261',
            'title' => '261',
        ]);
        DB::table('groups')->insert([
            'name' => 'garemo',
            'title' => 'გარემო მიკროკლიმატი მდგრადობა',
        ]);
        DB::table('groups')->insert([
            'name' => 'kanoni',
            'title' => 'კანონი არქიტექტურული საქმიანობის შესახებ',
        ]);
        DB::table('groups')->insert([
            'name' => 'kodexi',
            'title' => 'კოდექსი',
        ]);
        DB::table('groups')->insert([
            'name' => 'konstruqciebi',
            'title' => 'კონსტრუქციები',
        ]);
        DB::table('groups')->insert([
            'name' => 'sert',
            'title' => 'სერტიფიცირების წესი',
        ]);
        DB::table('groups')->insert([
            'name' => '41',
            'title' => '41 - ე დადგენილება',
        ]);
        DB::table('groups')->insert([
            'name' => '10',
            'title' => '10 - ე დადგენილება',
        ]);
    }
}
