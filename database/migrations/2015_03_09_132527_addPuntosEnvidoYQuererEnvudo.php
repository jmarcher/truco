<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPuntosEnvidoYQuererEnvudo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manos', function (Blueprint $table) {
            $table->json('tantosEnvidoJugadores');
            $table->tinyInteger('quiereEnvido')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manos', function (Blueprint $table) {
            $table->dropColumn('tantosEnvidoJugadores');
            $table->dropColumn('quiereEnvido');
        });
    }
}
