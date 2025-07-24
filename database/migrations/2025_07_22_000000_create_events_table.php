<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->dateTime('datetime_start')->nullable();
            $table->dateTime('datetime_end')->nullable();
            $table->string('location')->nullable();
            $table->string('poster_url')->nullable();
            $table->integer('max_amount_participants')->nullable();
            $table->boolean('is_active_event')->default(true);

            $table->uuid('created_by_id')->nullable();
            $table->uuid('updated_by_id')->nullable();
            $table->uuid('deactivated_by_id')->nullable();
            $table->uuid('deleted_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
