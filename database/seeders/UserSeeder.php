<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $createUser = new \App\Actions\Fortify\CreateNewUser();

        // Create admin user - Giorgi Bekurashvili
        $user = $createUser->create([
            'name' => 'Giorgi Bekurashvili',
            'email' => 'giorgibekurashvili@gmail.com',
            'password' => 'archfix123',
            'password_confirmation' => 'archfix123',
            'terms' => true,
        ]);
        $user->forceFill([
            'is_admin' => 1,
            'position' => 'Architect',
            'company' => 'Arch Studio',
        ])->save();

        // Create admin user - Giorgi Lotishvili
        $user = $createUser->create([
            'name' => 'Giorgi Lotishvili',
            'email' => 'naormala@gmail.com',
            'password' => 'fixfix123',
            'password_confirmation' => 'fixfix123',
            'terms' => true,
        ]);
        $user->forceFill([
            'is_admin' => 1,
            'position' => 'Architect',
            'company' => 'Arch Studio',
        ])->save();

        // Create admin user - Nika Jimshitashvili
        $user = $createUser->create([
            'name' => 'Nika Jimshitashvili',
            'email' => 'jimshitashvilinika742@gmail.com',
            'password' => 'archfix123',
            'password_confirmation' => 'archfix123',
            'terms' => true,
        ]);
        $user->forceFill([
            'is_admin' => 1,
            'position' => 'Architect',
            'company' => 'Arch Studio',
        ])->save();

        // Create regular user - Sarah Johnson
        $user = $createUser->create([
            'name' => 'Sarah Johnson',
            'email' => 'sarah@archstudio.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms' => true,
        ]);
        $user->forceFill([
            'is_admin' => 0,
            'position' => 'Architect',
            'company' => 'Arch Studio',
        ])->save();

        $user = $createUser->create([
            'name' => 'David Chen',
            'email' => 'david.chen@example.com',
            'password' => 'secure456',
            'password_confirmation' => 'secure456',
            'terms' => true,
        ]);
        $user->forceFill([
            'is_admin' => 0,
            'position' => 'Civil Engineer',
            'company' => 'Civil Engineering Firm',
        ])->save();

        $user = $createUser->create([
            'name' => 'User Without Subscription',
            'email' => 'user1@user.ge',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms' => true,
        ]);
        $user->forceFill([
            'is_admin' => 0,
            'position' => 'Junior Architect',
            'company' => 'Design Studio',
        ])->save();

        $user = $createUser->create([
            'name' => 'User With Weekly Subscription',
            'email' => 'user2@user.ge',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'terms' => true,
        ]);
        $user->forceFill([
            'is_admin' => 0,
            'position' => 'Designer',
            'company' => 'Creative Solutions',
        ])->save();
    }
}
