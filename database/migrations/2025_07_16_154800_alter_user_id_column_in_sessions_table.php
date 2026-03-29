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
        // Cek apakah kolom user_id sudah ada
        if (Schema::hasColumn('sessions', 'user_id')) {
            // Untuk MySQL: MODIFY kolom agar nullable
            DB::statement('ALTER TABLE sessions MODIFY user_id INT NULL');
        } else {
            // Jika kolom belum ada, tambahkan
            Schema::table('sessions', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback: kembalikan ke NOT NULL (jika sebelumnya NOT NULL)
        if (Schema::hasColumn('sessions', 'user_id')) {
            DB::statement('ALTER TABLE sessions MODIFY user_id INT NOT NULL');
        }
    }
};