<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Administrator',
            'Cashier'
        ];

        foreach($roles as $role) {
            Role::create(['name' => $role]);
        }

        $user = User::create([
            'name' => 'Admin',
            'email' => env('DEFAULT_EMAIL'),
            'password' => env('DEFAULT_PASSWORD'),
        ]);
        $cashier = User::create([
            'name' => 'kasir_1',
            'email' => 'kasir@gmail.com',
            'password' => 'secret321!'
        ]);

        $user->assignRole($roles[0]);
        $cashier->assignRole($roles[1]);

        $this->command->info('success seeding Users data');
    }
}
