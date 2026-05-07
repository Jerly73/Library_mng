<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing books to avoid duplicates
        Book::query()->delete();

        Book::insert([
            [
                'name' => 'Calculus',
                'writer' => 'James Stewart',
                'book_id' => 'CALC001',
                'subject' => 'Mathematics',
                'class' => '12',
                'date' => '2023-01-15',
                'title' => 'Calculus',
                'author' => 'James Stewart',
                'category_id' => 1,
                'cover' => 'book1.jpg',
                'description' => 'Fundamentals of differential and integral calculus.',
                'status' => 'Available'
            ],
            [
                'name' => 'Algebra Basics',
                'writer' => 'Ron Larson',
                'book_id' => 'ALGB002',
                'subject' => 'Mathematics',
                'class' => '11',
                'date' => '2023-02-20',
                'title' => 'Algebra Basics',
                'author' => 'Ron Larson',
                'category_id' => 1,
                'cover' => 'book1.jpg',
                'description' => 'Core algebra concepts for students.',
                'status' => 'Available'
            ],
            [
                'name' => 'Physics Fundamentals',
                'writer' => 'Halliday',
                'book_id' => 'PHYS003',
                'subject' => 'Physics',
                'class' => '12',
                'date' => '2023-03-10',
                'title' => 'Physics Fundamentals',
                'author' => 'Halliday',
                'category_id' => 2,
                'cover' => 'book1.jpg',
                'description' => 'Core concepts in physics.',
                'status' => 'Available'
            ],
            [
                'name' => 'World Literature',
                'writer' => 'Various Authors',
                'book_id' => 'LIT004',
                'subject' => 'Literature',
                'class' => '12',
                'date' => '2023-04-05',
                'title' => 'World Literature',
                'author' => 'Various Authors',
                'category_id' => 3,
                'cover' => 'book1.jpg',
                'description' => 'A collection of classic world literature.',
                'status' => 'Available'
            ],
            [
                'name' => 'The Great Gatsby',
                'writer' => 'F. Scott Fitzgerald',
                'book_id' => 'GATSBY005',
                'subject' => 'Literature',
                'class' => '11',
                'date' => '2023-05-12',
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'category_id' => 3,
                'cover' => 'book1.jpg',
                'description' => 'A tale of wealth and obsession in the Jazz Age.',
                'status' => 'Available'
            ],
            [
                'name' => 'World History',
                'writer' => 'J.M. Roberts',
                'book_id' => 'HIST006',
                'subject' => 'History',
                'class' => '12',
                'date' => '2023-06-18',
                'title' => 'World History',
                'author' => 'J.M. Roberts',
                'category_id' => 4,
                'cover' => 'book1.jpg',
                'description' => 'A sweeping account of human civilization.',
                'status' => 'Available'
            ],
            [
                'name' => 'Physical Geography',
                'writer' => 'James Petersen',
                'book_id' => 'GEO007',
                'subject' => 'Geography',
                'class' => '11',
                'date' => '2023-07-22',
                'title' => 'Physical Geography',
                'author' => 'James Petersen',
                'category_id' => 5,
                'cover' => 'book1.jpg',
                'description' => 'Introduction to earth\'s physical landscapes.',
                'status' => 'Available'
            ],
            [
                'name' => 'Computer Science',
                'writer' => 'Donald Knuth',
                'book_id' => 'CS008',
                'subject' => 'Computer Science',
                'class' => '12',
                'date' => '2023-08-30',
                'title' => 'Computer Science',
                'author' => 'Donald Knuth',
                'category_id' => 6,
                'cover' => 'book1.jpg',
                'description' => 'Fundamentals of programming and algorithms.',
                'status' => 'Available'
            ],
            [
                'name' => 'Harry Potter',
                'writer' => 'J.K. Rowling',
                'book_id' => 'HP009',
                'subject' => 'Fiction',
                'class' => '10',
                'date' => '2023-09-15',
                'title' => 'Harry Potter',
                'author' => 'J.K. Rowling',
                'category_id' => 7,
                'cover' => 'book1.jpg',
                'description' => 'A young wizard\'s journey at Hogwarts.',
                'status' => 'Available'
            ],
            [
                'name' => 'Sapiens',
                'writer' => 'Yuval Noah Harari',
                'book_id' => 'SAPIENS010',
                'subject' => 'Anthropology',
                'class' => '12',
                'date' => '2023-10-01',
                'title' => 'Sapiens',
                'author' => 'Yuval Noah Harari',
                'category_id' => 8,
                'cover' => 'book1.jpg',
                'description' => 'A brief history of humankind.',
                'status' => 'Available'
            ]
        ]);
    }
}
