<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fruits',
                'slug' => 'fruits',
                'description' => 'Fruits frais de saison et exotiques',
                'is_active' => true
            ],
            [
                'name' => 'Légumes',
                'slug' => 'legumes',
                'description' => 'Légumes bio et locaux',
                'is_active' => true
            ],
            [
                'name' => 'Vêtements',
                'slug' => 'vetements',
                'description' => 'Vêtements pour hommes, femmes et enfants',
                'is_active' => true
            ],
            [
                'name' => 'Sport',
                'slug' => 'sport',
                'description' => 'Équipements et accessoires sportifs',
                'is_active' => true
            ],
            [
                'name' => 'Technologie',
                'slug' => 'technologie',
                'description' => 'Appareils électroniques et informatiques',
                'is_active' => true
            ],
            [
                'name' => 'Électronique',
                'slug' => 'electronique',
                'description' => 'Appareils électroniques et gadgets',
                'is_active' => true
            ]
        ];
        
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}