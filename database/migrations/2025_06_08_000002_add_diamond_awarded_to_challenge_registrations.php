<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiamondAwardedToChallengeRegistrations extends Migration
{
    public function up()
    {
        Schema::table('challenge_registrations', function (Blueprint $table) {
            $table->boolean('diamond_awarded')->default(false)->after('notes');
        });
    }

    public function down()
    {
        Schema::table('challenge_registrations', function (Blueprint $table) {
            $table->dropColumn('diamond_awarded');
        });
    }
}
