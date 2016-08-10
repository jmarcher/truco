<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddGanadorMano extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manos', function (Blueprint $table) {
            $table->tinyInteger('ganadorRondas');
        });
        /*Schema::table('games',function(Blueprint $table){
            $table->integer("ganadorMano");
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manos', function (Blueprint $table) {
            $table->dropColumn('ganadorRondas');
        });
    }
}
