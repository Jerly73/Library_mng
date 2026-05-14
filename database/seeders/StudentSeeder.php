<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create student USER accounts (for authentication and issues.student_id reference)
        User::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Juan Dela Cruz',
                'email' => 'student1@umindanao.edu.ph',
                'password' => Hash::make('student1234'),
                'role' => 'student',
            ]
        );

        User::updateOrCreate(
            ['id' => 2],
            [
                'name' => 'Maria Santos',
                'email' => 'student2@umindanao.edu.ph',
                'password' => Hash::make('student1234'),
                'role' => 'student',
            ]
        );

      
    }
}
