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
            UserSeeder::class,
            SpecialitySeeder::class,
            GroupSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
            PricingSeeder::class,
            // DumpSeeder::class,
            RegulationSeeder::class,
            EmployerSeeder::class,
            EmployeeSeeder::class,
            CertificateSeeder::class,
            SeederCleaner::class,

        ]);
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
