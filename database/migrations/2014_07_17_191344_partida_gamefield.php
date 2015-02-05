<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PartidaGamefield extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create("cartas", function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->tinyInteger('numero');
            $table->enum('palo', array('oro', 'basto','espada', 'copa'));
            $table->timestamps();
        });
        Schema::create("rondas", function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('gameId')->unsigned();
            //$table->foreign('gameId')->references('id')->on('games')->onDelete('no action')->onUpdate('no action');
            $table->integer('ronda')->unsigned();
            //$table->index(array('gameId', 'ronda'));

            $table->integer('muestra')->unsigned();
            $table->foreign('muestra')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            //Cartas son numeradas

            $table->integer('carta_jugador1')->unsigned()->nullable()->default(null);
            $table->foreign('carta_jugador1')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            $table->integer('carta_jugador2')->unsigned()->nullable()->default(null);
            $table->foreign('carta_jugador2')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            $table->integer('carta_jugador3')->unsigned()->nullable()->default(null);
            $table->foreign('carta_jugador3')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            $table->integer('carta_jugador4')->unsigned()->nullable()->default(null);
            $table->foreign('carta_jugador4')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            $table->integer('carta_jugador5')->unsigned()->nullable()->default(null);
            $table->foreign('carta_jugador5')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            $table->integer('carta_jugador6')->unsigned()->nullable()->default(null);
            $table->foreign('carta_jugador6')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');

        });
        Schema::table("games", function($table)
        {
            $table->tinyInteger("rondaActual")->default(0);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('cartas');
		Schema::drop("rondas");
        Schema::table('games', function($table)
        {
            $table->dropColumn('rondaActal');
        });
	}

}
