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
                'type_name' => 'უფასო',
                'type_price' => 0,
                'type_discount' => 0,
                'type_duration' => 30,
                'payment_days' => 3,
                'is_free' => true,
            ],
            [
                'id' => 2,
                'type_name' => 'სტანდარტი',
                'type_price' => 10,
                'type_discount' => 0,
                'type_duration' => 30,
                'payment_days' => 3,
                'is_free' => false,

            ],
            [
                'id' => 3,
                'type_name' => 'პრემიუმი',
                'type_price' => 99,
                'type_discount' => 0,
                'type_duration' => 30,
                'payment_days' => 3,
                'is_free' => false,
            ],
        ];

        foreach ($plan_types as $plan_type) {
            PlanType::create($plan_type);
        }
    }
}
