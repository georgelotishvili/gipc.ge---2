<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class StaticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artisan::call('db:wipe', [
            '--database' => 'mysql2',
        ]);
        $path = database_path('/abecert_static.sql');

        $contextOptions = [
            'http' => [
                'header' => 'Content-Type: text/plain; charset=utf-8'
            ]
        ];
        
        $sql = file_get_contents($path, false, stream_context_create($contextOptions));

        DB::connection('mysql2')->unprepared($sql);
    }
}
