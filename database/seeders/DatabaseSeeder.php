<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CommercialSeeder::class,
            SystemSettingSeeder::class,
            // StaticSeeder::class,
            SpecialitySeeder::class,
            // GroupSeeder::class,
            // QuestionSeeder::class,
            // AnswerSeeder::class,
            UserSeeder::class,
            DumpSeeder::class,
            RegulationSeeder::class,
            EmployeeSeeder::class,
            EmployerSeeder::class,
            CertificateSeeder::class,
            SeederCleaner::class,
            PlanTypeSeeder::class,
            PlanSeeder::class,

        ]);
    }
}
