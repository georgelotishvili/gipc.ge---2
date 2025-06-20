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
                'plan_name' => '1 კვირა',
                'plan_description' => 'იდეალური მოკლევადიანი მომზადებისთვის',
                'plan_price' => 150,
                'plan_discount' => 0,
                'plan_recommended' => false,
                'plan_order' => 1,
                'is_active' => true,
                'options' => [
                    [
                        'option_description' =>'სრული წვდომა ყველა მასალაზე',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'პროგრესის თვალყურის დევნება',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'ონლაინ კონსულტაცია',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'პრაქტიკული დავალებები',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'მობილური ვერსია',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'სერტიფიკატი',
                        'is_included' => true,
                        'is_active' =>true,
                    ],

                ]
            ],
            [
                'plan_type_id' => 2,
                'plan_name' => '1 თვე',
                'plan_description' => 'საუკეთესო არჩევანი სრული მომზადებისთვის',
                'plan_price' => 350,
                'plan_discount' => 0,
                'plan_recommended' => false,
                'plan_order' => 1,
                'is_active' => true,
                'options' => [
                    [
                        'option_description' =>'ყველა კვირის უპირატესობა',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'ჯგუფური მეცადინეობები',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'პერსონალური მენტორი',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'პერსონალური მენტორი',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'დამატებითი მასალები',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'დამატებითი პრაქტიკული სავარჯიშოები',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                ]
            ],
            [
                'plan_type_id' => 3,
                'plan_name' => '1 წელი',
                'plan_description' => 'სრული წვდომა მთელი წლის განმავლობაში',
                'plan_price' => 1150,
                'plan_discount' => 0,
                'plan_recommended' => true,
                'plan_order' => 1,
                'is_active' => true,
                'options' => [
                    [
                        'option_description' =>'ყველა თვის უპირატესობა',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'VIP მხარდაჭერა',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'კარიერული კონსულტაცია',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'ულიმიტო წვდომა',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'ექსკლუზიური მასალები',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                    [
                        'option_description' =>'გარანტირებული დასაქმება',
                        'is_included' => true,
                        'is_active' =>true,
                    ],
                ]
            ],
        ];
        foreach ($plans as $item) {
            $plan = new Plan;
            $plan->plan_type_id = $item['plan_type_id'];
            $plan->plan_name = $item['plan_name'];
            $plan->plan_description = $item['plan_description'];
            $plan->plan_price = $item['plan_price'];
            $plan->plan_discount = $item['plan_discount'];
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
