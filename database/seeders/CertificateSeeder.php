<?php

namespace Database\Seeders;

use App\Enums\CertificateStatus;
use App\Models\Certificate;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $certificate1 = Certificate::create([
            'speciality_id' => 1,
            'user_id' => 1,
            'certificate_number' => 'ARCH-2024-001',
            'release_date' => now()->subYears(2),
            'lifetime_years' => 5,
            'status' => CertificateStatus::ACTIVE->value,
            'location' => 'თბილისი',
            'education' => 'Master\'s Degree',
            'experience' => '10+ years in residential and commercial architecture',
            'social' => 'linkedin.com/in/sarah-architect,instagram.com/sarah.designs',
            'score' => 92.5,
            'rate' => 4.5,
            'jury_count' => 8,
            'phone_number' => '+1 (555) 234-5678',
            'email' => 'sarah@archstudio.com',
            'stars' => 4,
        ]);

        $certificate1->comments()->create([
            'user_id' => 1,
            'content' => 'სარა არის შესანიშნავი პროფესიონალი. მისი ნამუშევრები ყოველთვის მაღალი ხარისხისაა და მისი გუნდი ყოველთვის დროულად ასრულებს პროექტებს.'
        ]);

        $certificate3 = Certificate::create([
            'speciality_id' => 1,
            'user_id' => 2,
            'certificate_number' => 'CIVIL-2024-001',
            'release_date' => now()->subMonths(8),
            'lifetime_years' => 5,
            'status' => CertificateStatus::ACTIVE->value,
            'location' => 'ქუთაისი',
            'education' => 'PhD',
            'experience' => '15 years in civil engineering and infrastructure projects',
            'social' => 'linkedin.com/in/civil-engineer,facebook.com/civil.engineer',
            'score' => 90.0,
            'rate' => 4.7,
            'jury_count' => 5,
            'phone_number' => '+1 (555) 987-6543',
            'email' => 'engineer@example.com',
            'stars' => 5,
        ]);

        $certificate3->comments()->create([
            'user_id' => 1,
            'content' => 'სამოქალაქო ინჟინერიის სფეროში ერთ-ერთი საუკეთესო სპეციალისტი.'
        ]);

        $certificate4 = Certificate::create([
            'speciality_id' => 1,
            'user_id' => 3,
            'certificate_number' => 'GEO-2024-001',
            'release_date' => now()->subMonths(3),
            'lifetime_years' => 3,
            'status' => CertificateStatus::SUSPENDED->value,
            'location' => 'რუსთავი',
            'education' => 'Bachelor\'s Degree',
            'experience' => '5 years in geotechnical engineering and soil analysis',
            'social' => 'linkedin.com/in/geo-engineer',
            'score' => 85.5,
            'rate' => 4.0,
            'jury_count' => 4,
            'phone_number' => '+1 (555) 123-4567',
            'email' => 'geo@example.com',
            'stars' => 4,
        ]);

        $certificate4->comments()->create([
            'user_id' => 1,
            'content' => 'გეოტექნიკური ინჟინერიის სფეროში კარგი სპეციალისტი.'
        ]);

        $certificate5 = Certificate::create([
            'speciality_id' => 1,
            'user_id' => 4,
            'certificate_number' => 'WATER-2024-001',
            'release_date' => now()->subYears(3),
            'lifetime_years' => 5,
            'status' => CertificateStatus::EXPIRED->value,
            'location' => 'ზუგდიდი',
            'education' => 'Master\'s Degree',
            'experience' => '12 years specializing in water resource management and hydraulic systems',
            'social' => 'linkedin.com/in/water-engineer,twitter.com/water_expert,instagram.com/water.solutions',
            'score' => 94.0,
            'rate' => 4.8,
            'jury_count' => 7,
            'phone_number' => '+1 (555) 765-4321',
            'email' => 'water@example.com',
            'stars' => 5,
        ]);

        $certificate5->comments()->create([
            'user_id' => 1,
            'content' => 'წყლის რესურსების ინჟინერიის სფეროში გამორჩეული სპეციალისტი.'
        ]);
    }
}
