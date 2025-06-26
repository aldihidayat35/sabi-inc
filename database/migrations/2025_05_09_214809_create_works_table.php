<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('cover_photo')->nullable();
            $table->longText('content');
            $table->enum('status', ['Publish', 'Draft', 'Suspend'])->default('Draft');
            $table->text('suspend_note')->nullable();
            $table->timestamps();
        });

        Schema::create('category_work', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_id')->constrained('works')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_work');
        Schema::dropIfExists('works');
    }
};
