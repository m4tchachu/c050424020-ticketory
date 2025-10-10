<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['admin', 'technician', 'user'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('admin');
        $tech = User::firstOrCreate(
            ['email' => 'tech@example.com'],
            [
                'name' => 'Tech User',
                'password' => Hash::make('password'),
            ]
        );
        $tech->assignRole('technician');
        $client = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Client User',
                'password' => Hash::make('password'),
            ]
        );
        $client->assignRole('user');
    }
}
