<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama tantangan
            $table->integer('reward_diamond_points'); // Reward diamond point
            $table->string('cover_photo')->nullable(); // Foto sampul
            $table->string('reward')->nullable(); // Reward tantangan
            $table->text('details'); // Detail tantangan
            $table->timestamp('start_time')->nullable(); // Waktu mulai (nullable)
            $table->timestamp('end_time')->nullable(); // Waktu berakhir (nullable)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenges');
    }
};
