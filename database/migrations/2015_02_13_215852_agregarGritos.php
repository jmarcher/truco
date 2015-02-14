<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarGritos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('manos', function(Blueprint $table)
		{
			$table->tinyInteger("tieneLaPalabra");
            $table->tinyInteger("puntosEnvido")->unsigned();
            $table->tinyInteger("noQuisoEnvido")->unsigned();
            $table->json("flores");
            $table->boolean("alguienTieneFlor");//Para deshabilitar envido fácil
            $table->tinyInteger("puntosTruco")->unsigned();
            $table->tinyInteger("noQuisoTruco")->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('manos', function(Blueprint $table)
		{
            $table->dropColumn("tieneLaPalabra");
            $table->dropColumn("puntosEnvido");
            $table->dropColumn("noQuisoEnvido");
            $table->dropColumn("flores");
            $table->dropColumn("alguienTieneFlor");
            $table->dropColumn("puntosTruco");
            $table->dropColumn("noQuisoTruco");
		});
	}

}
