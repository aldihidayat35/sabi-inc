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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_id')->constrained('works')->onDelete('cascade'); // Relasi ke karya
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade'); // Relasi ke siswa
            $table->enum('type', ['Like', 'Dislike', 'Comment']); // Jenis feedback
            $table->text('comment')->nullable(); // Komentar jika tipe adalah Comment
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
