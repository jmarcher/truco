<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ManoModRondaModGame extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("manos", function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments("id");
            $table->integer("gameId")->unsigned();
            //$table->foreign('gameId')->references('id')->on('games')->onDelete('no action')->onUpdate('no action');
            $table->integer("mano");
            //$table->index(array("gameId", "mano"));


            $table->integer('muestra')->unsigned();
            $table->foreign('muestra')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            //Cartas son numeradas

            $table->integer('carta_A_jugador1')->unsigned()->nullable()->default(null);
            $table->foreign('carta_A_jugador1')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            $table->integer('carta_B_jugador1')->unsigned()->nullable()->default(null);
            $table->foreign('carta_B_jugador1')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            $table->integer('carta_C_jugador1')->unsigned()->nullable()->default(null);
            $table->foreign('carta_C_jugador1')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');

            $table->integer('carta_A_jugador2')->unsigned()->nullable()->default(null);
            $table->foreign('carta_A_jugador2')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            $table->integer('carta_B_jugador2')->unsigned()->nullable()->default(null);
            $table->foreign('carta_B_jugador2')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            $table->integer('carta_C_jugador2')->unsigned()->nullable()->default(null);
            $table->foreign('carta_C_jugador2')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');

            $table->integer('carta_A_jugador3')->unsigned()->nullable()->default(null);
            $table->foreign('carta_A_jugador3')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            $table->integer('carta_B_jugador3')->unsigned()->nullable()->default(null);
            $table->foreign('carta_B_jugador3')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            $table->integer('carta_C_jugador3')->unsigned()->nullable()->default(null);
            $table->foreign('carta_C_jugador3')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');

            $table->integer('carta_A_jugador4')->unsigned()->nullable()->default(null);
            $table->foreign('carta_A_jugador4')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            $table->integer('carta_B_jugador4')->unsigned()->nullable()->default(null);
            $table->foreign('carta_B_jugador4')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            $table->integer('carta_C_jugador4')->unsigned()->nullable()->default(null);
            $table->foreign('carta_C_jugador4')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');

            $table->integer('carta_A_jugador5')->unsigned()->nullable()->default(null);
            $table->foreign('carta_A_jugador5')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            $table->integer('carta_B_jugador5')->unsigned()->nullable()->default(null);
            $table->foreign('carta_B_jugador5')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            $table->integer('carta_C_jugador5')->unsigned()->nullable()->default(null);
            $table->foreign('carta_C_jugador5')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');

            $table->integer('carta_A_jugador6')->unsigned()->nullable()->default(null);
            $table->foreign('carta_A_jugador6')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            $table->integer('carta_B_jugador6')->unsigned()->nullable()->default(null);
            $table->foreign('carta_B_jugador6')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');
            $table->integer('carta_C_jugador6')->unsigned()->nullable()->default(null);
            $table->foreign('carta_C_jugador6')->references('id')->on('cartas')->onDelete('no action')->onUpdate('no action');


        });

        /* Schema::table("rondas", function(Blueprint $table)
         {
             $table->integer("manoId")->unsigned()->nullable()->default(null);
             $table->index("manoId");
            // $table->foreign('manoId')->references('id')->on('manos')->onDelete('no action')->onUpdate('no action');
         });*/
        Schema::table("games", function (Blueprint $table) {
            $table->integer("manoId")->unsigned()->nullable()->default(null);
            $table->index("manoId");
            //   $table->foreign('manoId')->references('id')->on('manos')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("manos");
        Schema::table("rondas", function (Blueprint $table) {
            $table->dropColumn("manoId");
        });
        Schema::table("games", function (Blueprint $table) {
            $table->dropIndex("manoId");
            $table->dropColumn("manoId");
        });
    }

}
