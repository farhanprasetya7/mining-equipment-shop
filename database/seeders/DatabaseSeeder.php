<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run seeders in order
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            VehicleSeeder::class,
            SparePartSeeder::class,
            OrderSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
