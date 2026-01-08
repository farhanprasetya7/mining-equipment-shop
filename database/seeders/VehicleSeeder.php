<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            [
                'category_id' => 1, // Excavator
                'name' => 'Komatsu PC400-8',
                'brand' => 'Komatsu',
                'model' => 'PC400-8',
                'year' => 2022,
                'price' => 2500000000,
                'stock' => 3,
                'description' => 'Heavy duty excavator with advanced hydraulic system',
                'specifications' => json_encode([
                    'Engine Power' => '257 HP',
                    'Operating Weight' => '40,000 kg',
                    'Bucket Capacity' => '1.9 m³',
                    'Max Digging Depth' => '7.2 m',
                ]),
                'images' => json_encode(['komatsu-pc400-1.jpg', 'komatsu-pc400-2.jpg']),
                'condition' => 'new',
                'is_featured' => true,
                'views_count' => 150,
            ],
            [
                'category_id' => 1, // Excavator
                'name' => 'Caterpillar 336',
                'brand' => 'Caterpillar',
                'model' => '336',
                'year' => 2021,
                'price' => 2800000000,
                'stock' => 2,
                'description' => 'High performance excavator for mining operations',
                'specifications' => json_encode([
                    'Engine Power' => '299 HP',
                    'Operating Weight' => '36,000 kg',
                    'Bucket Capacity' => '1.8 m³',
                    'Max Digging Depth' => '7.0 m',
                ]),
                'images' => json_encode(['cat-336-1.jpg', 'cat-336-2.jpg']),
                'condition' => 'new',
                'is_featured' => true,
                'views_count' => 200,
            ],
            [
                'category_id' => 2, // Dump Truck
                'name' => 'Hino FM 350 JD',
                'brand' => 'Hino',
                'model' => 'FM 350 JD',
                'year' => 2023,
                'price' => 850000000,
                'stock' => 5,
                'description' => 'Heavy duty dump truck for mining operations',
                'specifications' => json_encode([
                    'Engine Power' => '350 HP',
                    'Payload Capacity' => '25 ton',
                    'Fuel Tank' => '400 L',
                    'Wheelbase' => '4,850 mm',
                ]),
                'images' => json_encode(['hino-fm350-1.jpg', 'hino-fm350-2.jpg']),
                'condition' => 'new',
                'is_featured' => false,
                'views_count' => 80,
            ],
            [
                'category_id' => 2, // Dump Truck
                'name' => 'Mitsubishi Fuso FN 527',
                'brand' => 'Mitsubishi',
                'model' => 'Fuso FN 527',
                'year' => 2022,
                'price' => 780000000,
                'stock' => 4,
                'description' => 'Reliable dump truck with large cargo capacity',
                'specifications' => json_encode([
                    'Engine Power' => '285 HP',
                    'Payload Capacity' => '20 ton',
                    'Fuel Tank' => '350 L',
                    'Wheelbase' => '4,600 mm',
                ]),
                'images' => json_encode(['fuso-fn527-1.jpg', 'fuso-fn527-2.jpg']),
                'condition' => 'new',
                'is_featured' => false,
                'views_count' => 65,
            ],
            [
                'category_id' => 3, // Bulldozer
                'name' => 'Komatsu D85EX-18',
                'brand' => 'Komatsu',
                'model' => 'D85EX-18',
                'year' => 2021,
                'price' => 1800000000,
                'stock' => 2,
                'description' => 'Powerful bulldozer for heavy material pushing',
                'specifications' => json_encode([
                    'Engine Power' => '250 HP',
                    'Operating Weight' => '25,500 kg',
                    'Blade Capacity' => '4.5 m³',
                    'Ground Pressure' => '0.8 kg/cm²',
                ]),
                'images' => json_encode(['komatsu-d85-1.jpg', 'komatsu-d85-2.jpg']),
                'condition' => 'new',
                'is_featured' => true,
                'views_count' => 120,
            ],
            [
                'category_id' => 3, // Bulldozer
                'name' => 'Caterpillar D6T',
                'brand' => 'Caterpillar',
                'model' => 'D6T',
                'year' => 2020,
                'price' => 1650000000,
                'stock' => 1,
                'description' => 'Medium bulldozer with excellent fuel efficiency',
                'specifications' => json_encode([
                    'Engine Power' => '215 HP',
                    'Operating Weight' => '19,500 kg',
                    'Blade Capacity' => '3.8 m³',
                    'Ground Pressure' => '0.75 kg/cm²',
                ]),
                'images' => json_encode(['cat-d6t-1.jpg']),
                'condition' => 'used',
                'is_featured' => false,
                'views_count' => 95,
            ],
            [
                'category_id' => 4, // Wheel Loader
                'name' => 'Komatsu WA470-8',
                'brand' => 'Komatsu',
                'model' => 'WA470-8',
                'year' => 2023,
                'price' => 1450000000,
                'stock' => 3,
                'description' => 'High capacity wheel loader for material handling',
                'specifications' => json_encode([
                    'Engine Power' => '272 HP',
                    'Operating Weight' => '23,000 kg',
                    'Bucket Capacity' => '3.4 m³',
                    'Max Lifting Height' => '3.2 m',
                ]),
                'images' => json_encode(['komatsu-wa470-1.jpg', 'komatsu-wa470-2.jpg']),
                'condition' => 'new',
                'is_featured' => true,
                'views_count' => 110,
            ],
            [
                'category_id' => 4, // Wheel Loader
                'name' => 'Volvo L120H',
                'brand' => 'Volvo',
                'model' => 'L120H',
                'year' => 2022,
                'price' => 1380000000,
                'stock' => 2,
                'description' => 'Versatile wheel loader with excellent visibility',
                'specifications' => json_encode([
                    'Engine Power' => '261 HP',
                    'Operating Weight' => '22,500 kg',
                    'Bucket Capacity' => '3.2 m³',
                    'Max Lifting Height' => '3.15 m',
                ]),
                'images' => json_encode(['volvo-l120h-1.jpg']),
                'condition' => 'new',
                'is_featured' => false,
                'views_count' => 75,
            ],
            [
                'category_id' => 5, // Grader
                'name' => 'Komatsu GD825A-2',
                'brand' => 'Komatsu',
                'model' => 'GD825A-2',
                'year' => 2021,
                'price' => 1200000000,
                'stock' => 2,
                'description' => 'Motor grader for road maintenance and leveling',
                'specifications' => json_encode([
                    'Engine Power' => '270 HP',
                    'Operating Weight' => '18,500 kg',
                    'Blade Width' => '4.3 m',
                    'Max Blade Load' => '10,000 kg',
                ]),
                'images' => json_encode(['komatsu-gd825-1.jpg', 'komatsu-gd825-2.jpg']),
                'condition' => 'new',
                'is_featured' => false,
                'views_count' => 60,
            ],
            [
                'category_id' => 5, // Grader
                'name' => 'Caterpillar 140M',
                'brand' => 'Caterpillar',
                'model' => '140M',
                'year' => 2020,
                'price' => 1150000000,
                'stock' => 1,
                'description' => 'Reliable motor grader for precision grading',
                'specifications' => json_encode([
                    'Engine Power' => '265 HP',
                    'Operating Weight' => '17,800 kg',
                    'Blade Width' => '4.27 m',
                    'Max Blade Load' => '9,800 kg',
                ]),
                'images' => json_encode(['cat-140m-1.jpg']),
                'condition' => 'used',
                'is_featured' => false,
                'views_count' => 50,
            ],
            [
                'category_id' => 6, // Drilling Equipment
                'name' => 'Atlas Copco DML',
                'brand' => 'Atlas Copco',
                'model' => 'DML',
                'year' => 2022,
                'price' => 3200000000,
                'stock' => 1,
                'description' => 'Surface drilling rig for mining operations',
                'specifications' => json_encode([
                    'Engine Power' => '450 HP',
                    'Hole Diameter' => '165-311 mm',
                    'Max Depth' => '53 m',
                    'Weight' => '67,000 kg',
                ]),
                'images' => json_encode(['atlas-dml-1.jpg', 'atlas-dml-2.jpg']),
                'condition' => 'new',
                'is_featured' => true,
                'views_count' => 180,
            ],
            [
                'category_id' => 6, // Drilling Equipment
                'name' => 'Sandvik DX800',
                'brand' => 'Sandvik',
                'model' => 'DX800',
                'year' => 2023,
                'price' => 3500000000,
                'stock' => 1,
                'description' => 'Advanced surface drilling rig with automation',
                'specifications' => json_encode([
                    'Engine Power' => '480 HP',
                    'Hole Diameter' => '200-350 mm',
                    'Max Depth' => '60 m',
                    'Weight' => '72,000 kg',
                ]),
                'images' => json_encode(['sandvik-dx800-1.jpg']),
                'condition' => 'new',
                'is_featured' => true,
                'views_count' => 195,
            ],
            [
                'category_id' => 1, // Excavator
                'name' => 'Hitachi ZX470LCH-5G',
                'brand' => 'Hitachi',
                'model' => 'ZX470LCH-5G',
                'year' => 2021,
                'price' => 2350000000,
                'stock' => 2,
                'description' => 'Hydraulic excavator with fuel-efficient engine',
                'specifications' => json_encode([
                    'Engine Power' => '268 HP',
                    'Operating Weight' => '46,000 kg',
                    'Bucket Capacity' => '2.0 m³',
                    'Max Digging Depth' => '7.5 m',
                ]),
                'images' => json_encode(['hitachi-zx470-1.jpg', 'hitachi-zx470-2.jpg']),
                'condition' => 'new',
                'is_featured' => false,
                'views_count' => 88,
            ],
            [
                'category_id' => 2, // Dump Truck
                'name' => 'Volvo FM 460',
                'brand' => 'Volvo',
                'model' => 'FM 460',
                'year' => 2023,
                'price' => 920000000,
                'stock' => 3,
                'description' => 'European standard dump truck with high safety features',
                'specifications' => json_encode([
                    'Engine Power' => '460 HP',
                    'Payload Capacity' => '30 ton',
                    'Fuel Tank' => '450 L',
                    'Wheelbase' => '5,100 mm',
                ]),
                'images' => json_encode(['volvo-fm460-1.jpg', 'volvo-fm460-2.jpg']),
                'condition' => 'new',
                'is_featured' => true,
                'views_count' => 140,
            ],
            [
                'category_id' => 4, // Wheel Loader
                'name' => 'Hitachi ZW310-6',
                'brand' => 'Hitachi',
                'model' => 'ZW310-6',
                'year' => 2022,
                'price' => 1550000000,
                'stock' => 2,
                'description' => 'Large wheel loader with advanced load sensing',
                'specifications' => json_encode([
                    'Engine Power' => '285 HP',
                    'Operating Weight' => '27,000 kg',
                    'Bucket Capacity' => '3.8 m³',
                    'Max Lifting Height' => '3.4 m',
                ]),
                'images' => json_encode(['hitachi-zw310-1.jpg']),
                'condition' => 'new',
                'is_featured' => false,
                'views_count' => 72,
            ],
            [
                'category_id' => 3, // Bulldozer
                'name' => 'Shantui SD32',
                'brand' => 'Shantui',
                'model' => 'SD32',
                'year' => 2021,
                'price' => 1450000000,
                'stock' => 2,
                'description' => 'Heavy bulldozer with strong pushing force',
                'specifications' => json_encode([
                    'Engine Power' => '320 HP',
                    'Operating Weight' => '37,000 kg',
                    'Blade Capacity' => '7.6 m³',
                    'Ground Pressure' => '1.0 kg/cm²',
                ]),
                'images' => json_encode(['shantui-sd32-1.jpg', 'shantui-sd32-2.jpg']),
                'condition' => 'new',
                'is_featured' => false,
                'views_count' => 58,
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}
