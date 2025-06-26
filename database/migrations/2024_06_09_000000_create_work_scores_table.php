<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkScoresTable extends Migration
{
    public function up()
    {
        Schema::create('work_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_id')->constrained()->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            $table->float('score');
            $table->timestamps();

            $table->unique(['work_id', 'teacher_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_scores');
    }
}
