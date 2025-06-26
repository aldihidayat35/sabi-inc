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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')->constrained('topics')->onDelete('cascade'); // Relasi ke tabel Topik
            $table->string('title'); // Judul Materi
            $table->text('abstract')->nullable(); // Abstrak
            $table->integer('reward_diamond')->default(0); // Reward Diamond
            $table->longText('content'); // Isi Materi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
