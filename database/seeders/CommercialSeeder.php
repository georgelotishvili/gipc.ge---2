<?php

namespace Database\Seeders;

use App\Models\Commercial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommercialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Commercial::create([
            'name' => 'თქვენი რეკლამა',
            'description' => 'რეკლამის განსათავსებლად დაგვიკავშირდით',
            'link' => 'https://example.com/certification',
            'expiration_date' => now()->addMonths(3),
            'weight' => 1.0,
            'duration_weight' => 1.0,
            'img_link' => 'https://picsum.photos/1600/900?random=1',
        ]);

        Commercial::create([
            'name' => 'თქვენი რეკლამა',
            'description' => 'რეკლამის განსათავსებლად დაგვიკავშირდით',
            'link' => 'https://example.com/iso-standards',
            'expiration_date' => now()->addMonths(4),
            'weight' => 0.9,
            'duration_weight' => 0.9,
            'img_link' => 'https://picsum.photos/1600/900?random=2',
        ]);

        Commercial::create([
            'name' => 'თქვენი რეკლამა',
            'description' => 'რეკლამის განსათავსებლად დაგვიკავშირდით',
            'link' => 'https://example.com/experience',
            'expiration_date' => now()->addMonths(5),
            'weight' => 0.8,
            'duration_weight' => 0.8,
            'img_link' => 'https://picsum.photos/1600/900?random=3',
        ]);

        Commercial::create([
            'name' => 'თქვენი რეკლამა',
            'description' => 'რეკლამის განსათავსებლად დაგვიკავშირდით',
            'link' => 'https://example.com/programs',
            'expiration_date' => now()->addMonths(6),
            'weight' => 0.7,
            'duration_weight' => 0.7,
            'img_link' => 'https://picsum.photos/1600/900?random=4',
        ]);

        Commercial::create([
            'name' => 'თქვენი რეკლამა',
            'description' => 'რეკლამის განსათავსებლად დაგვიკავშირდით',
            'link' => 'https://example.com/education',
            'expiration_date' => now()->addMonths(7),
            'weight' => 0.6,
            'duration_weight' => 0.6,
            'img_link' => 'https://picsum.photos/1600/900?random=5',
        ]);
    }
}
