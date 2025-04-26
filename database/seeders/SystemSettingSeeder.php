<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('system_settings')->insert([
            'key' => 'exam_duration',
            'value' => '7200',
            'description' => 'გამოცდის მიმდინარეობის დრო წამებში იწერება, და თუ ამ პარამეტრს შეცვლით, ჩაწერეთ წამები.',
        ]);
    }
}
