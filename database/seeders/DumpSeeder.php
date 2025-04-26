<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DumpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            $dumpPath = database_path('dump');
            $file = database_path('/dump/groups.sql');
            
        $sql = file_get_contents($file);
        DB::unprepared($sql);
        $this->command->info('Seeded: ' . basename($file));

        $file = database_path('/dump/questions.sql');
        
        $sql = file_get_contents($file);
        DB::unprepared($sql);
        $this->command->info('Seeded: ' . basename($file));

        $file = database_path('/dump/answers.sql');
        
        $sql = file_get_contents($file);
        DB::unprepared($sql);
        $this->command->info('Seeded: ' . basename($file));

        $file = database_path('/dump/group_question.sql');
            
            $sql = file_get_contents($file);
            DB::unprepared($sql);
            $this->command->info('Seeded: ' . basename($file));
        } catch (\Exception $e) {
            Log::error('Error seeding: ' . basename($file));
            Log::error($e->getMessage());
        }
    }
}
