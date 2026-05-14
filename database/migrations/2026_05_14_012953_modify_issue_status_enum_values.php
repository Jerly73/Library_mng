<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modify the status column to include new enum values
        DB::statement("ALTER TABLE issues MODIFY COLUMN status ENUM('Pending', 'Approved', 'Borrowed', 'Returned', 'Overdue', 'Rejected') DEFAULT 'Pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original enum values
        DB::statement("ALTER TABLE issues MODIFY COLUMN status ENUM('Borrowed', 'Returned', 'Overdue') DEFAULT 'Borrowed'");
    }
};
