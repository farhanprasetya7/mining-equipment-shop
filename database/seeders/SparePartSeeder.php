<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SparePart;

class SparePartSeeder extends Seeder
{
    public function run(): void
    {
        $spareParts = [
            [
                'category_id' => 7, // Engine Parts
                'name' => 'Komatsu SAA6D140E-5 Engine',
                'part_number' => 'SAA6D140E-5-001',
                'brand' => 'Komatsu',
                'price' => 185000000,
                'stock' => 5,
                'description' => 'Complete engine assembly for PC400 series',
                'compatible_vehicles' => json_encode(['Komatsu PC400', 'Komatsu PC450']),
                'image' => 'engine-komatsu-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 7, // Engine Parts
                'name' => 'Caterpillar C9 ACERT Engine',
                'part_number' => 'C9-ACERT-002',
                'brand' => 'Caterpillar',
                'price' => 195000000,
                'stock' => 3,
                'description' => 'High performance engine for CAT 336',
                'compatible_vehicles' => json_encode(['Caterpillar 336', 'Caterpillar 340']),
                'image' => 'engine-cat-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 8, // Hydraulic Parts
                'name' => 'Main Hydraulic Pump',
                'part_number' => 'HYD-PUMP-003',
                'brand' => 'Kawasaki',
                'price' => 75000000,
                'stock' => 8,
                'description' => 'High pressure hydraulic pump for excavators',
                'compatible_vehicles' => json_encode(['Komatsu PC400', 'Hitachi ZX470']),
                'image' => 'hydraulic-pump-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 8, // Hydraulic Parts
                'name' => 'Hydraulic Cylinder Set',
                'part_number' => 'HYD-CYL-004',
                'brand' => 'KYB',
                'price' => 45000000,
                'stock' => 12,
                'description' => 'Boom and arm cylinder for excavators',
                'compatible_vehicles' => json_encode(['Komatsu PC400', 'Caterpillar 336']),
                'image' => 'hydraulic-cylinder-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 9, // Transmission Parts
                'name' => 'Transmission Assembly',
                'part_number' => 'TRANS-005',
                'brand' => 'ZF',
                'price' => 125000000,
                'stock' => 4,
                'description' => 'Complete transmission for dump trucks',
                'compatible_vehicles' => json_encode(['Hino FM 350', 'Mitsubishi Fuso']),
                'image' => 'transmission-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 9, // Transmission Parts
                'name' => 'Torque Converter',
                'part_number' => 'TORQ-006',
                'brand' => 'Allison',
                'price' => 55000000,
                'stock' => 6,
                'description' => 'Heavy duty torque converter',
                'compatible_vehicles' => json_encode(['Komatsu WA470', 'Volvo L120H']),
                'image' => 'torque-converter-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 10, // Undercarriage Parts
                'name' => 'Track Link Assembly',
                'part_number' => 'TRACK-007',
                'brand' => 'Berco',
                'price' => 35000000,
                'stock' => 15,
                'description' => 'Complete track link for excavators',
                'compatible_vehicles' => json_encode(['Komatsu PC400', 'Caterpillar 336', 'Hitachi ZX470']),
                'image' => 'track-link-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 10, // Undercarriage Parts
                'name' => 'Track Roller (Lower)',
                'part_number' => 'ROLLER-008',
                'brand' => 'ITM',
                'price' => 8500000,
                'stock' => 25,
                'description' => 'Lower track roller for excavators',
                'compatible_vehicles' => json_encode(['Komatsu PC400', 'Hitachi ZX470']),
                'image' => 'track-roller-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 10, // Undercarriage Parts
                'name' => 'Sprocket Rim',
                'part_number' => 'SPKT-009',
                'brand' => 'ITR',
                'price' => 12000000,
                'stock' => 18,
                'description' => 'Sprocket rim for excavator final drive',
                'compatible_vehicles' => json_encode(['Komatsu PC400', 'Caterpillar 336']),
                'image' => 'sprocket-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 11, // Electrical Parts
                'name' => 'Alternator',
                'part_number' => 'ALT-010',
                'brand' => 'Denso',
                'price' => 18500000,
                'stock' => 10,
                'description' => '24V high output alternator',
                'compatible_vehicles' => json_encode(['Komatsu PC400', 'Komatsu WA470']),
                'image' => 'alternator-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 11, // Electrical Parts
                'name' => 'Starter Motor',
                'part_number' => 'START-011',
                'brand' => 'Hitachi',
                'price' => 15000000,
                'stock' => 12,
                'description' => 'Heavy duty starter motor',
                'compatible_vehicles' => json_encode(['Caterpillar 336', 'Volvo L120H']),
                'image' => 'starter-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 12, // Filters & Fluids
                'name' => 'Engine Oil Filter',
                'part_number' => 'FILT-012',
                'brand' => 'Sakura',
                'price' => 450000,
                'stock' => 50,
                'description' => 'High quality engine oil filter',
                'compatible_vehicles' => json_encode(['Komatsu PC400', 'Komatsu WA470', 'Komatsu D85']),
                'image' => 'oil-filter-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 12, // Filters & Fluids
                'name' => 'Fuel Filter',
                'part_number' => 'FILT-013',
                'brand' => 'Donaldson',
                'price' => 380000,
                'stock' => 60,
                'description' => 'Water separator fuel filter',
                'compatible_vehicles' => json_encode(['Caterpillar 336', 'Hitachi ZX470']),
                'image' => 'fuel-filter-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 12, // Filters & Fluids
                'name' => 'Hydraulic Oil 10W',
                'part_number' => 'OIL-014',
                'brand' => 'Shell',
                'price' => 850000,
                'stock' => 100,
                'description' => 'Premium hydraulic oil per liter',
                'compatible_vehicles' => json_encode(['All Excavators', 'All Wheel Loaders']),
                'image' => 'hydraulic-oil-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 13, // Bucket & Attachments
                'name' => 'Rock Bucket 1.9m³',
                'part_number' => 'BCK-015',
                'brand' => 'Hensley',
                'price' => 65000000,
                'stock' => 6,
                'description' => 'Heavy duty rock bucket with teeth',
                'compatible_vehicles' => json_encode(['Komatsu PC400', 'Caterpillar 336']),
                'image' => 'rock-bucket-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 13, // Bucket & Attachments
                'name' => 'Ripper Attachment',
                'part_number' => 'RIP-016',
                'brand' => 'Esco',
                'price' => 48000000,
                'stock' => 4,
                'description' => 'Single shank ripper for bulldozers',
                'compatible_vehicles' => json_encode(['Komatsu D85', 'Caterpillar D6T']),
                'image' => 'ripper-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 14, // Cabin Parts
                'name' => 'Operator Seat',
                'part_number' => 'SEAT-017',
                'brand' => 'Grammer',
                'price' => 12500000,
                'stock' => 15,
                'description' => 'Air suspension operator seat',
                'compatible_vehicles' => json_encode(['All Heavy Equipment']),
                'image' => 'operator-seat-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 14, // Cabin Parts
                'name' => 'Air Conditioning Unit',
                'part_number' => 'AC-018',
                'brand' => 'Denso',
                'price' => 18000000,
                'stock' => 8,
                'description' => 'Heavy duty AC unit for cabin',
                'compatible_vehicles' => json_encode(['Komatsu PC400', 'Caterpillar 336']),
                'image' => 'ac-unit-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 15, // Safety Equipment
                'name' => 'Backup Camera System',
                'part_number' => 'CAM-019',
                'brand' => 'Brigade',
                'price' => 8500000,
                'stock' => 20,
                'description' => 'HD backup camera with monitor',
                'compatible_vehicles' => json_encode(['All Heavy Equipment']),
                'image' => 'backup-camera-1.jpg',
                'is_available' => true,
            ],
            [
                'category_id' => 15, // Safety Equipment
                'name' => 'Fire Extinguisher 9kg',
                'part_number' => 'FIRE-020',
                'brand' => 'Yamato',
                'price' => 850000,
                'stock' => 50,
                'description' => 'ABC dry powder fire extinguisher',
                'compatible_vehicles' => json_encode(['All Heavy Equipment']),
                'image' => 'fire-extinguisher-1.jpg',
                'is_available' => true,
            ],
        ];

        foreach ($spareParts as $part) {
            SparePart::create($part);
        }
    }
}
