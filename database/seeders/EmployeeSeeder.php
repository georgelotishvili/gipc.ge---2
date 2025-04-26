<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Enums\WorkTimeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'user_id' => 1,
            'name' => 'გიორგი მამალაძე',
            'position' => 'არქიტექტორი',
            'city' => 'თბილისი',
            'worktime' => WorkTimeType::FULL_TIME->value,
            'salary' => 4500,
            'description' => '10 წლიანი გამოცდილება არქიტექტურულ დაგეგმარებაში...',
            'skills' => 'BIM, Revit, ArchiCAD, მრავალსართულიანი',
            'email' => 'architect@example.com',
            'phone' => '+995555123456',
            'website' => 'https://example.com/portfolio1',
            'social' => 'https://linkedin.com/in/architect1,https://facebook.com/architect1',
        ]);

        Employee::create([
            'user_id' => 1,
            'name' => 'ნინო კვარაცხელია',
            'position' => 'დიზაინერი',
            'city' => 'თბილისი',
            'worktime' => WorkTimeType::FREELANCE->value,
            'salary' => 3000,
            'description' => '5 წლიანი გამოცდილება ინტერიერის დიზაინში...',
            'skills' => 'Corona Renderer, 3ds Max, კომერციული დიზაინი',
            'email' => 'designer@example.com',
            'phone' => '+995555234567',
            'website' => 'https://example.com/portfolio2',
            'social' => 'https://instagram.com/designer1,https://behance.net/designer1',
        ]);

        Employee::create([
            'user_id' => 1,
            'name' => 'ლევან ბერიძე',
            'position' => 'ინჟინერი',
            'city' => 'ბათუმი',
            'worktime' => WorkTimeType::FULL_TIME->value,
            'salary' => 4000,
            'description' => '8 წლიანი გამოცდილება კონსტრუქციულ გაანგარიშებებში...',
            'skills' => 'SAFE, ETABS, Robot Structural, სეისმური ანალიზი',
            'email' => 'engineer@example.com',
            'phone' => '+995555345678',
            'website' => 'https://example.com/portfolio3',
            'social' => 'https://linkedin.com/in/engineer1',
        ]);

        Employee::create([
            'user_id' => 1,
            'name' => 'თამარ გოგიჩაიშვილი',
            'position' => 'მოდელერი',
            'city' => 'დისტანციური',
            'worktime' => WorkTimeType::FREELANCE->value,
            'salary' => 3500,
            'description' => 'პროფესიონალი 3D მოდელირების სპეციალისტი ეძებს სამსახურს...',
            'skills' => 'Blender, Maya, ZBrush, რენდერინგი',
            'email' => 'modeler@example.com',
            'phone' => '+995555456789',
            'website' => 'https://example.com/portfolio4',
            'social' => 'https://artstation.com/modeler1,https://instagram.com/modeler1',
        ]);

        Employee::create([
            'user_id' => 1,
            'name' => 'დავით ჯავახიშვილი',
            'position' => 'მენეჯერი',
            'city' => 'თბილისი',
            'worktime' => WorkTimeType::FULL_TIME->value,
            'salary' => 5000,
            'description' => '12 წლიანი გამოცდილება პროექტების მართვაში...',
            'skills' => 'Agile, Scrum, Jira, რისკების მართვა',
            'email' => 'manager@example.com',
            'phone' => '+995555567890',
            'website' => 'https://example.com/portfolio5',
            'social' => 'https://linkedin.com/in/manager1,https://twitter.com/manager1',
        ]);
    }
}
