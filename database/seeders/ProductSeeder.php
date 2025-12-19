<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::truncate();
        
        $fruits = Category::where('slug', 'fruits')->first();
        $legumes = Category::where('slug', 'legumes')->first();
        $vetements = Category::where('slug', 'vetements')->first();
        $sport = Category::where('slug', 'sport')->first();
        $technologie = Category::where('slug', 'technologie')->first();
        $electronique = Category::where('slug', 'electronique')->first();
        
        $products = [
            [
                'name' => 'Bananes (kg)',
                'slug' => 'bananes-kg',
                'description' => 'Bananes mûres de Madagascar',
                'price' => 3500,
                'category_id' => $fruits->id,
                'is_active' => true
            ],
            [
                'name' => 'Mangues (kg)',
                'slug' => 'mangues-kg',
                'description' => 'Mangues Amélie de Madagascar',
                'price' => 4500,
                'category_id' => $fruits->id,
                'is_active' => true
            ],
            [
                'name' => 'Litchis (kg)',
                'slug' => 'litchis-kg',
                'description' => 'Litchis frais de Tamatave',
                'price' => 6000,
                'category_id' => $fruits->id,
                'is_active' => true
            ],
            [
                'name' => 'Ananas',
                'slug' => 'ananas-unite',
                'description' => 'Ananas sucré de la côte Est',
                'price' => 2500,
                'category_id' => $fruits->id,
                'is_active' => true
            ],
            
            [
                'name' => 'Tomates (kg)',
                'slug' => 'tomates-kg',
                'description' => 'Tomates locales bio',
                'price' => 2000,
                'category_id' => $legumes->id,
                'is_active' => true
            ],
            [
                'name' => 'Carottes (kg)',
                'slug' => 'carottes-kg',
                'description' => 'Carottes fraîches du Vakinankaratra',
                'price' => 1800,
                'category_id' => $legumes->id,
                'is_active' => true
            ],
            [
                'name' => 'Pommes de terre (kg)',
                'slug' => 'pommes-de-terre-kg',
                'description' => 'Pommes de terre de l\'Itasy',
                'price' => 1500,
                'category_id' => $legumes->id,
                'is_active' => true
            ],
            [
                'name' => 'Oignons (kg)',
                'slug' => 'oignons-kg',
                'description' => 'Oignons rouges de Madagascar',
                'price' => 2200,
                'category_id' => $legumes->id,
                'is_active' => true
            ],
            
            [
                'name' => 'Lamba traditionnel',
                'slug' => 'lamba-traditionnel',
                'description' => 'Lamba malagasy en soie sauvage',
                'price' => 35000,
                'category_id' => $vetements->id,
                'is_active' => true
            ],
            [
                'name' => 'T-shirt Madagascar',
                'slug' => 't-shirt-madagascar',
                'description' => 'T-shirt avec impression de lémurien',
                'price' => 12000,
                'category_id' => $vetements->id,
                'is_active' => true
            ],
            [
                'name' => 'Jupe longue',
                'slug' => 'jupe-longue',
                'description' => 'Jupe traditionnelle en coton',
                'price' => 25000,
                'category_id' => $vetements->id,
                'is_active' => true
            ],
            [
                'name' => 'Chemise homme',
                'slug' => 'chemise-homme',
                'description' => 'Chemise en lin pour homme',
                'price' => 28000,
                'category_id' => $vetements->id,
                'is_active' => true
            ],
            
            [
                'name' => 'Ballon de rugby',
                'slug' => 'ballon-rugby',
                'description' => 'Ballon officiel taille 5',
                'price' => 45000,
                'category_id' => $sport->id,
                'is_active' => true
            ],
            [
                'name' => 'Raquette de tennis',
                'slug' => 'raquette-tennis',
                'description' => 'Raquette professionnelle graphite',
                'price' => 180000,
                'category_id' => $sport->id,
                'is_active' => true
            ],
            [
                'name' => 'Sac de sport',
                'slug' => 'sac-sport',
                'description' => 'Sac à dos pour équipement sportif',
                'price' => 35000,
                'category_id' => $sport->id,
                'is_active' => true
            ],
            [
                'name' => 'Chaussures de running',
                'slug' => 'chaussures-running',
                'description' => 'Chaussures de course à pied',
                'price' => 120000,
                'category_id' => $sport->id,
                'is_active' => true
            ],
            
            [
                'name' => 'Smartphone Xiaomi',
                'slug' => 'smartphone-xiaomi',
                'description' => 'Smartphone Android 128GB',
                'price' => 600000,
                'category_id' => $technologie->id,
                'is_active' => true
            ],
            [
                'name' => 'Tablette Samsung',
                'slug' => 'tablette-samsung',
                'description' => 'Tablette 10 pouces 64GB',
                'price' => 850000,
                'category_id' => $technologie->id,
                'is_active' => true
            ],
            [
                'name' => 'Laptop HP',
                'slug' => 'laptop-hp',
                'description' => 'Ordinateur portable 15 pouces 8GB RAM',
                'price' => 2500000,
                'category_id' => $technologie->id,
                'is_active' => true
            ],
            [
                'name' => 'Imprimante Epson',
                'slug' => 'imprimante-epson',
                'description' => 'Imprimante multifonction couleur',
                'price' => 450000,
                'category_id' => $technologie->id,
                'is_active' => true
            ],
            
            [
                'name' => 'Casque Bluetooth',
                'slug' => 'casque-bluetooth',
                'description' => 'Casque sans fil avec réduction de bruit',
                'price' => 75000,
                'category_id' => $electronique->id,
                'is_active' => true
            ],
            [
                'name' => 'Haut-parleur JBL',
                'slug' => 'haut-parleur-jbl',
                'description' => 'Enceinte portable étanche',
                'price' => 120000,
                'category_id' => $electronique->id,
                'is_active' => true
            ],
            [
                'name' => 'Montre connectée',
                'slug' => 'montre-connectee',
                'description' => 'Smartwatch avec écran tactile',
                'price' => 150000,
                'category_id' => $electronique->id,
                'is_active' => true
            ],
            [
                'name' => 'Chargeur portable',
                'slug' => 'chargeur-portable',
                'description' => 'Powerbank 20000mAh',
                'price' => 35000,
                'category_id' => $electronique->id,
                'is_active' => true
            ]
        ];
        
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}