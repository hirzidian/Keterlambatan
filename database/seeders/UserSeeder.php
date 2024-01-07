<?php

namespace Database\Seeders;

use App\Models\users;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        users::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);
        users::create([
            'name' => 'Pembimbing Siswa',
            'email' => 'ps@gmail.com',
            'password' => Hash::make('ps'),
            'role' => 'ps',
        ]);
        if (Auth::check()) {
            // Access the authenticated user's name
            $userName = Auth::user()->name;
        
            // Now you can use $userName as needed
            echo $userName;
        } else {
            // User is not authenticated
            echo "User not authenticated";
        }
    }
}
