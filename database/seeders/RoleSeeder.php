<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'description' => 'Administrator with full access',
            ],
            [
                'name' => 'sales',
                'description' => 'Sales staff with limited access',
            ],
            [
                'name' => 'customer',
                'description' => 'Customer who can browse and purchase',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
