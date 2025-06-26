<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialStudentTable extends Migration
{
    public function up()
    {
        Schema::create('material_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['material_id', 'student_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('material_student');
    }
}
