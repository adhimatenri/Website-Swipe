<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah tipe kolom user_id di tabel sessions menjadi uuid
        DB::statement('ALTER TABLE sessions ALTER COLUMN user_id DROP DEFAULT');
        DB::statement('ALTER TABLE sessions ALTER COLUMN user_id DROP NOT NULL');
        DB::statement('ALTER TABLE sessions ALTER COLUMN user_id TYPE uuid USING user_id::uuid');
    }

    public function down(): void
    {
        // Ubah kembali menjadi bigint
        DB::statement('ALTER TABLE sessions ALTER COLUMN user_id TYPE bigint USING user_id::bigint');
    }
};
