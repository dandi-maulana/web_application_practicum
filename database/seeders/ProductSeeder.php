<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Smartphone Samsung Galaxy S24',
            'sku' => '8801643880507',
            'price' => 12999000,
            'description' => 'Smartphone flagship dengan kamera 200MP dan performa tinggi',
            'image' => null
        ]);

        Product::create([
            'name' => 'Laptop ASUS ROG Strix',
            'sku' => '4711081334187',
            'price' => 25999000,
            'description' => 'Gaming laptop dengan RTX 4060 dan Intel Core i7',
            'image' => null
        ]);

        Product::create([
            'name' => 'Headphone Sony WH-1000XM5',
            'sku' => '4548736142461',
            'price' => 5499000,
            'description' => 'Wireless noise-canceling headphones dengan audio berkualitas tinggi',
            'image' => null
        ]);

        Product::create([
            'name' => 'Keyboard Mechanical Logitech MX',
            'sku' => '5099206098318',
            'price' => 1299000,
            'description' => 'Mechanical keyboard untuk produktivitas dengan konektivitas wireless',
            'image' => null
        ]);

        Product::create([
            'name' => 'Mouse Gaming Razer DeathAdder V3',
            'sku' => '8886419370062',
            'price' => 899000,
            'description' => 'Gaming mouse dengan sensor presisi tinggi dan ergonomis',
            'image' => null
        ]);
    }
}