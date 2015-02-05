<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRonda extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table("rondas", function(Blueprint $table) {
            $table->tinyInteger("ganador");
        });
        Schema::table("manos", function(Blueprint $table) {
            $table->tinyInteger("turno");
        });
        Schema::table("games", function(Blueprint $table) {
            $table->tinyInteger("cantJugadores")->default(2);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
