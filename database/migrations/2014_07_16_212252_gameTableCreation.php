<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class GameTableCreation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('games', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('puntosN');
            $table->integer('puntosE');
            $table->integer('jugador1_id')->nullable()->default(null)->unsigned();
            $table->index('jugador1_id');
            $table->foreign('jugador1_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->integer('jugador2_id')->nullable()->default(null)->unsigned();
            $table->index('jugador2_id');
            $table->foreign('jugador2_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->integer('jugador3_id')->nullable()->default(null)->unsigned();
            $table->index('jugador3_id');
            $table->foreign('jugador3_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->integer('jugador4_id')->nullable()->default(null)->unsigned();
            $table->index('jugador4_id');
            $table->foreign('jugador4_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->integer('jugador5_id')->nullable()->default(null)->unsigned();
            $table->index('jugador5_id');
            $table->foreign('jugador5_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->integer('jugador6_id')->nullable()->unsigned()->default(null);
            $table->index('jugador6_id');
            $table->foreign('jugador6_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('games');
    }
}
