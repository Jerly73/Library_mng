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
        // Drop the old foreign key constraint
        Schema::table('issues', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
        });

        // Re-add foreign key pointing to users table
        Schema::table('issues', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the users foreign key
        Schema::table('issues', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
        });

        // Restore original foreign key pointing to students table
        Schema::table('issues', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }
};