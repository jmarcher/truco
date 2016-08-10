<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Foreginkey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table("rondas", function(Blueprint $table)
        {
            $table->foreign('manoId')->references('id')->on('manos')->onDelete('no action')->onUpdate('no action');
        });*/
        Schema::table('games', function (Blueprint $table) {
            $table->foreign('manoId')->references('id')->on('manos')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*  Schema::table("rondas", function(Blueprint $table)
        {
            $table->dropForeign('manoId');
        });*/
      /*  Schema::table("games", function(Blueprint $table)
        {
            $table->dropForeign('manoId');
        })*;*/
    }
}
