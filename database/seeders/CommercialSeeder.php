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
            'img_link' => 'https://images.unsplash.com/photo-1487958449943-2429e8be8625?auto=format&fit=crop&w=1920&q=85',
        ]);

        Commercial::create([
            'name' => 'თქვენი რეკლამა',
            'description' => 'რეკლამის განსათავსებლად დაგვიკავშირდით',
            'link' => 'https://example.com/iso-standards',
            'expiration_date' => now()->addMonths(4),
            'weight' => 0.9,
            'duration_weight' => 0.9,
            'img_link' => 'https://images.unsplash.com/photo-1518005020951-eccb494ad742?auto=format&fit=crop&w=1920&q=85',
        ]);

        Commercial::create([
            'name' => 'თქვენი რეკლამა',
            'description' => 'რეკლამის განსათავსებლად დაგვიკავშირდით',
            'link' => 'https://example.com/experience',
            'expiration_date' => now()->addMonths(5),
            'weight' => 0.8,
            'duration_weight' => 0.8,
            'img_link' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1920&q=85',
        ]);

        Commercial::create([
            'name' => 'თქვენი რეკლამა',
            'description' => 'რეკლამის განსათავსებლად დაგვიკავშირდით',
            'link' => 'https://example.com/programs',
            'expiration_date' => now()->addMonths(6),
            'weight' => 0.7,
            'duration_weight' => 0.7,
            'img_link' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1920&q=85',
        ]);

        Commercial::create([
            'name' => 'თქვენი რეკლამა',
            'description' => 'რეკლამის განსათავსებლად დაგვიკავშირდით',
            'link' => 'https://example.com/education',
            'expiration_date' => now()->addMonths(7),
            'weight' => 0.6,
            'duration_weight' => 0.6,
            'img_link' => 'https://images.unsplash.com/photo-1511818966892-d7d671e672a2?auto=format&fit=crop&w=1920&q=85',
        ]);
    }
}
