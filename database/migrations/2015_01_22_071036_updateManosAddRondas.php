<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateManosAddRondas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table("manos", function(Blueprint $table) {
            $table->integer("ronda1_id")->nullable()->default(null)->unsigned();
            $table->foreign('ronda1_id')->references('id')->on('rondas')->onDelete('no action')->onUpdate('no action');
            $table->integer("ronda2_id")->nullable()->default(null)->unsigned();
            $table->foreign('ronda2_id')->references('id')->on('rondas')->onDelete('no action')->onUpdate('no action');
            $table->integer("ronda3_id")->nullable()->default(null)->unsigned();
            $table->foreign('ronda3_id')->references('id')->on('rondas')->onDelete('no action')->onUpdate('no action');


        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table("manos", function(Blueprint $table) {
            $table->dropForeign('ronda1_id');
            $table->dropForeign('ronda2_id');
            $table->dropForeign('ronda3_id');

            $table->dropColumn("ronda1_id");
            $table->dropColumn("ronda2_id");
            $table->dropColumn("ronda3_id");
        });
	}

}
