<?php namespace App;


use Illuminate\Database\Eloquent\Model;

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
 * @method static \App\Ronda find($id,$columns = array('*'))
 */
class Ronda extends Model {

    /**
     * @var string
     */
    protected $table = "rondas";

    public function noTiroCarta($pos){
        $str = "carta_jugador".$pos;
        return $this->$str == NULL;
    }
} 