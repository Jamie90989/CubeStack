<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'CubeStack',
            'email' => 'cube@stack.nl',
            'password' => Hash::make('CubeStack123'),
            'securityQuestion1' => 'Who is the owner of cubestack?',
            'securityAnswer1' => Hash::make('Jamie'),
            'securityQuestion2' => 'Who is the owners father',
            'securityAnswer2' => Hash::make('Jacko'),
            'securityQuestion3' => 'How is this webpage made',
            'securityAnswer3' => Hash::make('Laravel'),
            'hideStandardAlgs' => false,
            'isAdmin' => true,
        ]);
    }
}
