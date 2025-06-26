<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewsToWorksTable extends Migration
{
    public function up()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->unsignedBigInteger('views')->default(0)->after('cover_photo');
        });
    }

    public function down()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->dropColumn('views');
        });
    }
}
