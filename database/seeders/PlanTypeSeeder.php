<?php

namespace Database\Seeders;

use App\Models\PlanType;
use Illuminate\Database\Seeder;

class PlanTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plan_types = [
            [
                'id' => 1,
                'type_name' => '1 კვირა',
                'type_duration' => 7,
                'payment_days' => 3,
                'is_free' => false,
            ],
            [
                'id' => 2,
                'type_name' => '1 თვე',
                'type_duration' => 30,
                'payment_days' => 3,
                'is_free' => false,

            ],
            [
                'id' => 3,
                'type_name' => '1 წელი',
                'type_duration' => 365,
                'payment_days' => 3,
                'is_free' => false,
            ],
        ];

        foreach ($plan_types as $plan_type) {
            PlanType::create($plan_type);
        }
    }
}
