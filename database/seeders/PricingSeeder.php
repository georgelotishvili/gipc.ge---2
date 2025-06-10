<?php

namespace Database\Seeders;

use App\Enums\CertificateStatus;
use App\Models\Certificate;
use App\Models\Comment;
use App\Models\Pricing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class PricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $price1 = Pricing::create([
            'plan_id' => 1,
            'name' => '1 კვირა',
            'small_description' => 'იდეალური მოკლევადიანი მომზადებისთვის',
            'featured' => false,
            'price' => 150,
            'term' => '1 კვირა',
            'tags' => 'სრული წვდომა ყველა მასალაზე,პრაქტიკული დავალებები,პროგრესის თვალყურის დევნება,მობილური ვერსია,ონლაინ კონსულტაცია,სერტიფიკატი',
        ]);

        $price1->plan()->create([
            'name' => '1 კვირა',
            'term_days' => 7
        ]);



        $price2 = Pricing::create([
            'plan_id' => 2,
            'name' => '1 თვე',
            'small_description' => 'საუკეთესო არჩევანი სრული მომზადებისთვის',
            'featured' => true,
            'price' => 350,
            'term' => '1 თვე',
            'tags' => 'ყველა კვირის უპირატესობა,პერსონალური მენტორი,ჯგუფური მეცადინეობები,დამატებითი მასალები,პრიორიტეტული მხარდაჭერა,დამატებითი პრაქტიკული სავარჯიშოები',
        ]);

        $price2->plan()->create([
            'name' => '1 თვე',
            'term_days' => 30
        ]);

        $price3 = Pricing::create([
            'plan_id' => 3,
            'name' => '1 წელი',
            'small_description' => 'სრული წვდომა მთელი წლის განმავლობაში',
            'featured' => false,
            'price' => 1150,
            'term' => '1 წელი',
            'tags' => 'ყველა თვის უპირატესობა,ულიმიტო წვდომა,VIP მხარდაჭერა,ექსკლუზიური მასალები,კარიერული კონსულტაცია,გარანტირებული დასაქმება',
        ]);

        $price3->plan()->create([
            'name' => '1 წელი',
            'term_days' => 365
        ]);
    }
}
