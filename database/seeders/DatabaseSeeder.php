<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      User::factory()->create([
        'name' => 'Admin',
        'password' => 'admin', 
        'email' => 'admin@example.com',
        'role' => 'admin',
      ]);
    
      User::factory()->create([
        'name' => 'Teacher',
        'email' => 'teacher@example.com',
        'password' => 'teacher',
        'role' => 'teacher',
      ]);
    
      User::factory()->create([
        'name' => 'Student',
        'email' => 'student@example.com',
        'password' => 'student',
        'role' => 'student',
      ]);
  }
}
