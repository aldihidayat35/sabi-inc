<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentFollowsTable extends Migration
{
    public function up()
    {
        Schema::create('student_follows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('follower_id');
            $table->unsignedBigInteger('followed_id');
            $table->timestamps();

            $table->unique(['follower_id', 'followed_id']);
            $table->foreign('follower_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('followed_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_follows');
    }
}
