<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE issues MODIFY borrow_date DATETIME NOT NULL');
        DB::statement('ALTER TABLE issues MODIFY return_date DATETIME NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE issues MODIFY borrow_date DATE NOT NULL');
        DB::statement('ALTER TABLE issues MODIFY return_date DATE NULL');
    }
};
