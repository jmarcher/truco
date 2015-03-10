<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddManoCantJugadores extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table("manos",function(Blueprint $table){
            $table->tinyInteger("cantJugadores");
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table("manos",function(Blueprint $table){
            $table->dropColumn("cantJugadores");
        });
	}

}
