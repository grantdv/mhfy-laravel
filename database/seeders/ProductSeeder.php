<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Seed the database.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Classic Concierge Service',
            'slug' => 'classic-concierge-service',
            'description' => 'A premium, personalized concierge experience tailored to your needs.',
            'price' => 99.99,
            'stock_quantity' => 100,
        ]);

        Product::create([
            'name' => 'Premium Travel Package',
            'slug' => 'premium-travel-package',
            'description' => 'All-inclusive travel planning and management for your next adventure.',
            'price' => 499.99,
            'stock_quantity' => 50,
        ]);

        Product::create([
            'name' => 'Event Management Pro',
            'slug' => 'event-management-pro',
            'description' => 'Seamless event coordination for your most important celebrations.',
            'price' => 250.00,
            'stock_quantity' => 30,
        ]);
    }
}
