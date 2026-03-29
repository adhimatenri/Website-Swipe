<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah kolom user_id dari INT menjadi VARCHAR(36) untuk UUID
        DB::statement('ALTER TABLE sessions MODIFY user_id VARCHAR(36) NULL');
    }

    public function down(): void
    {
        // Kembalikan ke INT jika rollback
        DB::statement('ALTER TABLE sessions MODIFY user_id INT NULL');
    }
};


