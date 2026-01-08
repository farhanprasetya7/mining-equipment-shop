<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            // Admin
            [
                'name' => 'Admin Utama',
                'email' => 'admin@miningequip.com',
                'password' => Hash::make('password'),
                'phone' => '081234567890',
                'address' => 'Jl. Admin No. 1, Jakarta',
                'role_id' => 1,
                'is_active' => true,
            ],
            // Sales
            [
                'name' => 'Sales Manager',
                'email' => 'sales@miningequip.com',
                'password' => Hash::make('password'),
                'phone' => '081234567891',
                'address' => 'Jl. Sales No. 2, Jakarta',
                'role_id' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.sales@miningequip.com',
                'password' => Hash::make('password'),
                'phone' => '081234567892',
                'address' => 'Jl. Sudirman No. 10, Surabaya',
                'role_id' => 2,
                'is_active' => true,
            ],
            // Customers (minimal 15 total users)
            [
                'name' => 'PT Tambang Jaya',
                'email' => 'customer@miningequip.com',
                'password' => Hash::make('password'),
                'phone' => '081234567893',
                'address' => 'Jl. Customer No. 3, Jakarta',
                'role_id' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'PT Anugrah Mining',
                'email' => 'anugrah@mining.com',
                'password' => Hash::make('password'),
                'phone' => '081234567894',
                'address' => 'Jl. Industri No. 45, Balikpapan',
                'role_id' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'CV Karya Tambang',
                'email' => 'karya@tambang.com',
                'password' => Hash::make('password'),
                'phone' => '081234567895',
                'address' => 'Jl. Tambang No. 12, Samarinda',
                'role_id' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'PT Bumi Resources',
                'email' => 'bumi@resources.com',
                'password' => Hash::make('password'),
                'phone' => '081234567896',
                'address' => 'Jl. Gatot Subroto No. 88, Jakarta',
                'role_id' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'PT Mandiri Mining',
                'email' => 'mandiri@mining.com',
                'password' => Hash::make('password'),
                'phone' => '081234567897',
                'address' => 'Jl. Ahmad Yani No. 56, Banjarmasin',
                'role_id' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'CV Mitra Sejahtera',
                'email' => 'mitra@sejahtera.com',
                'password' => Hash::make('password'),
                'phone' => '081234567898',
                'address' => 'Jl. Diponegoro No. 23, Makassar',
                'role_id' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'PT Energi Batubara',
                'email' => 'energi@batubara.com',
                'password' => Hash::make('password'),
                'phone' => '081234567899',
                'address' => 'Jl. Sudirman No. 77, Pontianak',
                'role_id' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'PT Global Mining',
                'email' => 'global@mining.com',
                'password' => Hash::make('password'),
                'phone' => '081234567800',
                'address' => 'Jl. MH Thamrin No. 15, Jakarta',
                'role_id' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'CV Berkah Tambang',
                'email' => 'berkah@tambang.com',
                'password' => Hash::make('password'),
                'phone' => '081234567801',
                'address' => 'Jl. Jendral Sudirman No. 99, Palembang',
                'role_id' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'PT Nusantara Coal',
                'email' => 'nusantara@coal.com',
                'password' => Hash::make('password'),
                'phone' => '081234567802',
                'address' => 'Jl. Pahlawan No. 34, Pekanbaru',
                'role_id' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'PT Adaro Mining',
                'email' => 'adaro@mining.com',
                'password' => Hash::make('password'),
                'phone' => '081234567803',
                'address' => 'Jl. Rasuna Said No. 22, Jakarta',
                'role_id' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'CV Sumber Rejeki',
                'email' => 'sumber@rejeki.com',
                'password' => Hash::make('password'),
                'phone' => '081234567804',
                'address' => 'Jl. Veteran No. 17, Medan',
                'role_id' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'PT Indo Tambang',
                'email' => 'indo@tambang.com',
                'password' => Hash::make('password'),
                'phone' => '081234567805',
                'address' => 'Jl. Gajah Mada No. 55, Bandung',
                'role_id' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
