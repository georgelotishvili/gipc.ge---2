<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Enums\WorkTimeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employer::create([
            'user_id' => 1,
            'name' => 'სამშენებლო კომპანია "ქართული კონსტრუქცია"',
            'position' => 'პროექტის მენეჯერი',
            'city' => 'თბილისი',
            'worktime' => WorkTimeType::FULL_TIME->value,
            'salary' => 5000,
            'description' => 'სამშენებლო კომპანია ეძებს გამოცდილ პროექტის მენეჯერს...',
            'skills' => 'PMP, BIM, მრავალსართულიანი, კომერციული',
            'email' => 'hr@georgianconstruction.ge',
            'phone' => '+995555123456',
            'website' => 'https://georgianconstruction.ge',
            'social' => 'https://linkedin.com/company/georgianconstruction,https://facebook.com/georgianconstruction',
        ]);

        Employer::create([
            'user_id' => 1,
            'name' => 'არქიტექტურული ბიურო "მოდერნი"',
            'position' => 'არქიტექტორი',
            'city' => 'თბილისი',
            'worktime' => WorkTimeType::PART_TIME->value,
            'salary' => 4000,
            'description' => 'არქიტექტურული ბიურო ეძებს კრეატიულ არქიტექტორს...',
            'skills' => 'Revit, ArchiCAD, BIM, რეზიდენციალური',
            'email' => 'careers@modernarch.ge',
            'phone' => '+995555234567',
            'website' => 'https://modernarch.ge',
            'social' => 'https://instagram.com/modernarch,https://behance.net/modernarch',
        ]);

        Employer::create([
            'user_id' => 1,
            'name' => 'ინჟინერინგული კომპანია "სტრუქტურა"',
            'position' => 'სტრუქტურის ინჟინერი',
            'city' => 'ბათუმი',
            'worktime' => WorkTimeType::FULL_TIME->value,
            'salary' => 4500,
            'description' => 'ინჟინერინგული კომპანია ეძებს გამოცდილ სტრუქტურის ინჟინერს...',
            'skills' => 'ETABS, SAFE, Robot Structural, სეისმური',
            'email' => 'jobs@struktura.ge',
            'phone' => '+995555345678',
            'website' => 'https://struktura.ge',
            'social' => 'https://linkedin.com/company/struktura',
        ]);

        Employer::create([
            'user_id' => 1,
            'name' => 'დიზაინ სტუდია "კრეატივი"',
            'position' => '3D მოდელერი',
            'city' => 'დისტანციური',
            'worktime' => WorkTimeType::FREELANCE->value,
            'salary' => 3500,
            'description' => 'დიზაინ სტუდია ეძებს პროფესიონალ 3D მოდელერს...',
            'skills' => '3ds Max, V-Ray, Corona, რენდერინგი',
            'email' => 'hr@creative.ge',
            'phone' => '+995555456789',
            'website' => 'https://creative.ge',
            'social' => 'https://instagram.com/creativestudio,https://behance.net/creativestudio',
        ]);

        Employer::create([
            'user_id' => 1,
            'name' => 'კონსალტინგის კომპანია "პროექტი"',
            'position' => 'პროექტის მენეჯერი',
            'city' => 'თბილისი',
            'worktime' => WorkTimeType::FULL_TIME->value,
            'salary' => 5500,
            'description' => 'კონსალტინგის კომპანია ეძებს გამოცდილ პროექტის მენეჯერს...',
            'skills' => 'PMP, Agile, Scrum, Jira',
            'email' => 'careers@proekti.ge',
            'phone' => '+995555567890',
            'website' => 'https://proekti.ge',
            'social' => 'https://linkedin.com/company/proekti,https://facebook.com/proekti',
        ]);
    }
}
