<?php

namespace Database\Seeders;

use App\Models\Students;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing students to avoid duplicates
        Students::query()->delete();

        Students::insert([
            [
                'id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
