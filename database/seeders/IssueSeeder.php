<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Issue;
use App\Models\Students;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get student and book instances
        $student1 = Students::find(1);
        $student2 = Students::find(2);
        $book1 = Book::find(1);
        $book2 = Book::find(2);

        // Only proceed if we have the data
        if ($student1 && $student2 && $book1 && $book2) {
            // Create issue for student 2 borrowing book 1
            if (!$book1->issues()->where('status', 'Borrowed')->exists()) {
                $issue1 = Issue::create([
                    'student_id' => $student2->id,
                    'book_id' => $book1->id,
                    'borrow_date' => now()->subDays(2)->toDateString(),
                    'due_date' => now()->addDays(5)->toDateString(),
                    'status' => 'Borrowed',
                ]);
                // Update book status
                $book1->update(['status' => 'Borrowed']);
            }

            // Create issue for student 1 borrowing book 2
            if (!$book2->issues()->where('status', 'Borrowed')->exists()) {
                $issue2 = Issue::create([
                    'student_id' => $student1->id,
                    'book_id' => $book2->id,
                    'borrow_date' => now()->subDays(1)->toDateString(),
                    'due_date' => now()->addDays(6)->toDateString(),
                    'status' => 'Borrowed',
                ]);
                // Update book status
                $book2->update(['status' => 'Borrowed']);
            }
        }
    }
}
