<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DumpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dumpPath = database_path('dump');
        $files = glob($dumpPath . '/*.sql');
        
        foreach ($files as $file) {
            $sql = file_get_contents($file);
            DB::unprepared($sql);
            $this->command->info('Seeded: ' . basename($file));
        }
    }
}
