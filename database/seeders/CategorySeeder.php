<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Excavator',
                'slug' => Str::slug('Excavator'),
                'description' => 'Heavy equipment for digging and material handling',
                'icon' => 'excavator-icon.png',
            ],
            [
                'name' => 'Dump Truck',
                'slug' => Str::slug('Dump Truck'),
                'description' => 'Large trucks for transporting materials',
                'icon' => 'dump-truck-icon.png',
            ],
            [
                'name' => 'Bulldozer',
                'slug' => Str::slug('Bulldozer'),
                'description' => 'Powerful machines for pushing and clearing',
                'icon' => 'bulldozer-icon.png',
            ],
            [
                'name' => 'Wheel Loader',
                'slug' => Str::slug('Wheel Loader'),
                'description' => 'Front-loading equipment for material handling',
                'icon' => 'loader-icon.png',
            ],
            [
                'name' => 'Grader',
                'slug' => Str::slug('Grader'),
                'description' => 'Equipment for leveling and grading surfaces',
                'icon' => 'grader-icon.png',
            ],
            [
                'name' => 'Drilling Equipment',
                'slug' => Str::slug('Drilling Equipment'),
                'description' => 'Equipment for drilling and exploration',
                'icon' => 'drill-icon.png',
            ],
            [
                'name' => 'Engine Parts',
                'slug' => Str::slug('Engine Parts'),
                'description' => 'Spare parts for heavy equipment engines',
                'icon' => 'engine-icon.png',
            ],
            [
                'name' => 'Hydraulic Parts',
                'slug' => Str::slug('Hydraulic Parts'),
                'description' => 'Hydraulic system components',
                'icon' => 'hydraulic-icon.png',
            ],
            [
                'name' => 'Transmission Parts',
                'slug' => Str::slug('Transmission Parts'),
                'description' => 'Transmission and drivetrain components',
                'icon' => 'transmission-icon.png',
            ],
            [
                'name' => 'Undercarriage Parts',
                'slug' => Str::slug('Undercarriage Parts'),
                'description' => 'Track, roller, and undercarriage components',
                'icon' => 'undercarriage-icon.png',
            ],
            [
                'name' => 'Electrical Parts',
                'slug' => Str::slug('Electrical Parts'),
                'description' => 'Electrical and electronic components',
                'icon' => 'electrical-icon.png',
            ],
            [
                'name' => 'Filters & Fluids',
                'slug' => Str::slug('Filters & Fluids'),
                'description' => 'Filters, oils, and fluids',
                'icon' => 'filter-icon.png',
            ],
            [
                'name' => 'Bucket & Attachments',
                'slug' => Str::slug('Bucket & Attachments'),
                'description' => 'Buckets, rippers, and attachments',
                'icon' => 'bucket-icon.png',
            ],
            [
                'name' => 'Cabin Parts',
                'slug' => Str::slug('Cabin Parts'),
                'description' => 'Operator cabin and interior parts',
                'icon' => 'cabin-icon.png',
            ],
            [
                'name' => 'Safety Equipment',
                'slug' => Str::slug('Safety Equipment'),
                'description' => 'Safety devices and protective equipment',
                'icon' => 'safety-icon.png',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
