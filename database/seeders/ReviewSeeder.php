<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Vehicle;
use App\Models\SparePart;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [
            // Vehicle Reviews
            [
                'user_id' => 4,
                'reviewable_type' => Vehicle::class,
                'reviewable_id' => 1, // Komatsu PC400-8
                'rating' => 5,
                'comment' => 'Excellent excavator! Very powerful and fuel efficient. Highly recommended for mining operations.',
            ],
            [
                'user_id' => 5,
                'reviewable_type' => Vehicle::class,
                'reviewable_id' => 3, // Hino FM 350 JD
                'rating' => 4,
                'comment' => 'Good dump truck with reliable performance. Maintenance is easy and spare parts available.',
            ],
            [
                'user_id' => 7,
                'reviewable_type' => Vehicle::class,
                'reviewable_id' => 2, // Caterpillar 336
                'rating' => 5,
                'comment' => 'Top quality excavator. CAT never disappoints. Worth every rupiah!',
            ],
            [
                'user_id' => 10,
                'reviewable_type' => Vehicle::class,
                'reviewable_id' => 7, // Komatsu WA470-8
                'rating' => 5,
                'comment' => 'Perfect wheel loader for our mining site. Operator training was very helpful.',
            ],
            [
                'user_id' => 12,
                'reviewable_type' => Vehicle::class,
                'reviewable_id' => 11, // Atlas Copco DML
                'rating' => 4,
                'comment' => 'Great drilling rig. Advanced features make operation easier. Slightly expensive but worth it.',
            ],
            [
                'user_id' => 13,
                'reviewable_type' => Vehicle::class,
                'reviewable_id' => 14, // Volvo FM 460
                'rating' => 5,
                'comment' => 'Best dump truck we ever bought. Safety features are impressive. Delivery was on time.',
            ],
            [
                'user_id' => 6,
                'reviewable_type' => Vehicle::class,
                'reviewable_id' => 5, // Komatsu D85EX-18
                'rating' => 4,
                'comment' => 'Solid bulldozer. Good pushing power and stable operation.',
            ],
            [
                'user_id' => 8,
                'reviewable_type' => Vehicle::class,
                'reviewable_id' => 8, // Volvo L120H
                'rating' => 4,
                'comment' => 'Nice wheel loader. Visibility is excellent and comfortable cabin.',
            ],

            // Spare Part Reviews
            [
                'user_id' => 6,
                'reviewable_type' => SparePart::class,
                'reviewable_id' => 3, // Main Hydraulic Pump
                'rating' => 5,
                'comment' => 'Original quality hydraulic pump. Perfect fit and excellent performance.',
            ],
            [
                'user_id' => 9,
                'reviewable_type' => SparePart::class,
                'reviewable_id' => 5, // Transmission Assembly
                'rating' => 5,
                'comment' => 'Genuine transmission. Solved our problem completely. Fast delivery too!',
            ],
            [
                'user_id' => 9,
                'reviewable_type' => SparePart::class,
                'reviewable_id' => 7, // Track Link Assembly
                'rating' => 4,
                'comment' => 'Good quality track links. Installation was straightforward.',
            ],
            [
                'user_id' => 11,
                'reviewable_type' => SparePart::class,
                'reviewable_id' => 1, // Komatsu SAA6D140E-5 Engine
                'rating' => 5,
                'comment' => 'Original Komatsu engine. Worth the price for reliability and durability.',
            ],
            [
                'user_id' => 11,
                'reviewable_type' => SparePart::class,
                'reviewable_id' => 12, // Engine Oil Filter
                'rating' => 5,
                'comment' => 'Always buy filters from here. Genuine products at competitive prices.',
            ],
            [
                'user_id' => 4,
                'reviewable_type' => SparePart::class,
                'reviewable_id' => 10, // Alternator
                'rating' => 4,
                'comment' => 'Good alternator. Works perfectly on our excavator.',
            ],
            [
                'user_id' => 5,
                'reviewable_type' => SparePart::class,
                'reviewable_id' => 15, // Rock Bucket 1.9m³
                'rating' => 5,
                'comment' => 'Heavy duty bucket. Perfect for our rock loading operations.',
            ],
            [
                'user_id' => 7,
                'reviewable_type' => SparePart::class,
                'reviewable_id' => 17, // Operator Seat
                'rating' => 5,
                'comment' => 'Very comfortable seat. Our operators love it!',
            ],
            [
                'user_id' => 8,
                'reviewable_type' => SparePart::class,
                'reviewable_id' => 19, // Backup Camera System
                'rating' => 4,
                'comment' => 'Good safety addition. Clear image quality and easy installation.',
            ],
            [
                'user_id' => 10,
                'reviewable_type' => SparePart::class,
                'reviewable_id' => 4, // Hydraulic Cylinder Set
                'rating' => 5,
                'comment' => 'Excellent hydraulic cylinders. No leaks and smooth operation.',
            ],
            [
                'user_id' => 12,
                'reviewable_type' => SparePart::class,
                'reviewable_id' => 8, // Track Roller (Lower)
                'rating' => 4,
                'comment' => 'Quality rollers at reasonable price. Will order again.',
            ],
            [
                'user_id' => 13,
                'reviewable_type' => SparePart::class,
                'reviewable_id' => 14, // Hydraulic Oil 10W
                'rating' => 5,
                'comment' => 'Premium hydraulic oil. Our machines run smoother with this oil.',
            ],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
