<?php
/**
 * An helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace {
/**
 * Created by PhpStorm.
 * 
 * User: Joaquin
 * Date: 17.07.14
 * Time: 22:08
 *
 * @property integer $id
 * @property integer $gameId
 * @property integer $mano
 * @property integer $muestra
 * @property integer $carta_A_jugador1
 * @property integer $carta_B_jugador1
 * @property integer $carta_C_jugador1
 * @property integer $carta_A_jugador2
 * @property integer $carta_B_jugador2
 * @property integer $carta_C_jugador2
 * @property integer $carta_A_jugador3
 * @property integer $carta_B_jugador3
 * @property integer $carta_C_jugador3
 * @property integer $carta_A_jugador4
 * @property integer $carta_B_jugador4
 * @property integer $carta_C_jugador4
 * @property integer $carta_A_jugador5
 * @property integer $carta_B_jugador5
 * @property integer $carta_C_jugador5
 * @property integer $carta_A_jugador6
 * @property integer $carta_B_jugador6
 * @property integer $carta_C_jugador6
 * @method static \Illuminate\Database\Query\Builder|\Mano whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereMano($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereMuestra($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCartaAJugador1($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCartaBJugador1($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCartaCJugador1($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCartaAJugador2($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCartaBJugador2($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCartaCJugador2($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCartaAJugador3($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCartaBJugador3($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCartaCJugador3($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCartaAJugador4($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCartaBJugador4($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCartaCJugador4($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCartaAJugador5($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCartaBJugador5($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCartaCJugador5($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCartaAJugador6($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCartaBJugador6($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCartaCJugador6($value)
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property boolean $turno
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereTurno($value)
 * @property integer $ronda1_id
 * @property integer $ronda2_id
 * @property integer $ronda3_id
 * @method static \Illuminate\Database\Query\Builder|\Mano whereRonda1Id($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereRonda2Id($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereRonda3Id($value)
 * @property boolean $ganadorRondas
 * @method static \Illuminate\Database\Query\Builder|\Mano whereGanadorRondas($value)
 * @property boolean $tieneLaPalabra 
 * @property boolean $puntosEnvido 
 * @property boolean $noQuisoEnvido 
 * @property string $flores 
 * @property boolean $alguienTieneFlor 
 * @property boolean $puntosTruco 
 * @property boolean $noQuisoTruco 
 * @method static \Illuminate\Database\Query\Builder|\Mano whereTieneLaPalabra($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano wherePuntosEnvido($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereNoQuisoEnvido($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereFlores($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereAlguienTieneFlor($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano wherePuntosTruco($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereNoQuisoTruco($value)
 * @method static \Mano find($id,$columns)
 */
	class Mano {

    }
}

namespace {
/**
 * Created by PhpStorm.
 * 
 * User: Joaquin
 * Date: 16.07.14
 * Time: 20:03
 *
 * @property integer $id
 * @property integer $puntosN
 * @property integer $puntosE
 * @property integer $jugador1_id
 * @property integer $jugador2_id
 * @property integer $jugador3_id
 * @property integer $jugador4_id
 * @property integer $jugador5_id
 * @property integer $jugador6_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Game whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Game wherePuntosN($value)
 * @method static \Illuminate\Database\Query\Builder|\Game wherePuntosE($value)
 * @method static \Illuminate\Database\Query\Builder|\Game whereJugador1Id($value)
 * @method static \Illuminate\Database\Query\Builder|\Game whereJugador2Id($value)
 * @method static \Illuminate\Database\Query\Builder|\Game whereJugador3Id($value)
 * @method static \Illuminate\Database\Query\Builder|\Game whereJugador4Id($value)
 * @method static \Illuminate\Database\Query\Builder|\Game whereJugador5Id($value)
 * @method static \Illuminate\Database\Query\Builder|\Game whereJugador6Id($value)
 * @method static \Illuminate\Database\Query\Builder|\Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Game whereUpdatedAt($value)
 * @property boolean $rondaActual
 * @method static \Illuminate\Database\Query\Builder|\Game whereRondaActual($value)
 * @property integer $manoId
 * @method static \Illuminate\Database\Query\Builder|\Game whereManoId($value)
 * @property boolean $cantJugadores
 * @method static \Illuminate\Database\Query\Builder|\Game whereCantJugadores($value)
 * @property integer $jugadorMano_id
 * @method static \Illuminate\Database\Query\Builder|\Game whereJugadorManoId($value)
 * @property boolean $turnoRepartir
 * @method static \Illuminate\Database\Query\Builder|\Game whereTurnoRepartir($value)
 * @property boolean $seDebeRepartir
 * @method static \Illuminate\Database\Query\Builder|\Game whereSeDebeRepartir($value)
 * @method static \Game find($id,$columns)
 * @method static \Game findOrFail($id,$columns)
 */
	class Game {}
}

namespace {
/**
 * Created by PhpStorm.
 * 
 * User: Joaquin
 * Date: 17.07.14
 * Time: 16:37
 *
 * @property integer $id
 * @property integer $gameId
 * @property integer $ronda
 * @property integer $muestra
 * @property integer $carta_jugador1
 * @property integer $carta_jugador2
 * @property integer $carta_jugador3
 * @property integer $carta_jugador4
 * @property integer $carta_jugador5
 * @property integer $carta_jugador6
 * @method static \Illuminate\Database\Query\Builder|\Ronda whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Ronda whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\Ronda whereRonda($value)
 * @method static \Illuminate\Database\Query\Builder|\Ronda whereMuestra($value)
 * @method static \Illuminate\Database\Query\Builder|\Ronda whereCartaJugador1($value)
 * @method static \Illuminate\Database\Query\Builder|\Ronda whereCartaJugador2($value)
 * @method static \Illuminate\Database\Query\Builder|\Ronda whereCartaJugador3($value)
 * @method static \Illuminate\Database\Query\Builder|\Ronda whereCartaJugador4($value)
 * @method static \Illuminate\Database\Query\Builder|\Ronda whereCartaJugador5($value)
 * @method static \Illuminate\Database\Query\Builder|\Ronda whereCartaJugador6($value)
 * @property integer $manoId
 * @method static \Illuminate\Database\Query\Builder|\Ronda whereManoId($value)
 * @property boolean $ganador
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Ronda whereGanador($value)
 * @method static \Illuminate\Database\Query\Builder|\Ronda whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Ronda whereUpdatedAt($value)
 * @method static \Ronda find($id,$columns)
 */
	class Ronda {}
}

namespace {
/**
 * User
 *
 * @property integer $id
 * @property string $email
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $password
 * @property string $remember_token
 * @method static \Illuminate\Database\Query\Builder|\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\User whereRememberToken($value)
 * @method static \User find($id,$columns)
 */
	class User {}
}

namespace {
/**
 * Created by PhpStorm.
 * 
 * User: Joaquin
 * Date: 17.07.14
 * Time: 16:37
 *
 * @property integer $id
 * @property boolean $numero
 * @property string $palo
 * @method static \Illuminate\Database\Query\Builder|\Carta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Carta whereNumero($value)
 * @method static \Illuminate\Database\Query\Builder|\Carta wherePalo($value)
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Carta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Carta whereUpdatedAt($value)
 * @method static \Carta find($id,$columns)
 */
	class Carta {}
}

namespace App{
/**
 * App\User
 *
 * @property integer $id
 * @property string $email
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $password
 * @property string $remember_token
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 */
	class User {}
}

