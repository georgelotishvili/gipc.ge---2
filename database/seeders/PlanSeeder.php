<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'plan_type_id' => 1,
                'plan_description' => 'უფასო გეგმა',
                'plan_recommended' => false,
                'plan_order' => 1,
                'is_active' => true,
                'options' => [
                    [
                        'option_description' =>'1 სატესტო პროექტის ხარჯთაღრიცხვა',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'ულიმიტო მასალების გადმოწერა',
                        'is_included' => false,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'ულიმიტო პროექტების ხარჯთაღრიცხვა',
                        'is_included' => false,
                        'is_active' =>true,
                    ]
                ]
            ],
            [
                'plan_type_id' => 2,
                'plan_description' => 'სტანდარტი გეგმა',
                'plan_recommended' => false,
                'plan_order' => 1,
                'is_active' => true,
                'options' => [
                    [
                        'option_description' =>'ულიმიტო პროექტების ხარჯთაღრიცხვა',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'500 მასალის გადმოწერა',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'Revit ინტეგრაცია',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'ულიმიტო მასალების გადმოწერა',
                        'is_included' => false,
                        'is_active' =>true,
                    ],
                ]
            ],
            [
                'plan_type_id' => 3,
                'plan_description' => 'პრემიუმი გეგმა',
                'plan_recommended' => true,
                'plan_order' => 1,
                'is_active' => true,
                'options' => [
                    [
                        'option_description' =>'ულიმიტო პროექტების ხარჯთაღრიცხვა',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'ულიმიტო მასალის გადმოწერა',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'Revit ინტეგრაცია',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                ]
            ],
        ];
        foreach ($plans as $item) {
            $plan = new Plan;
            $plan->plan_type_id = $item['plan_type_id'];
            $plan->plan_description = $item['plan_description'];
            $plan->plan_recommended = $item['plan_recommended'];
            $plan->plan_order = $item['plan_order'];
            $plan->is_active = $item['is_active'];
            $plan->save();
            $plan->planOptions()->createMany(
                $item['options']
            );
        }
    }
}
