<?php


namespace App;
use Illuminate\Database\Eloquent\Model;

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
 * @method static \App\Game find($id,$columns = array('*'))
 * @method static \App\Game findOrFail($id,$columns = array('*'))
 */
class Game extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'games';


    /**
     *
     * Retorna true si el usuario fue ingresado, en caso de estar llena
     * o el usuario ya estaba ingresado retorna false
     *
     * @param integer $user
     * @return bool
     */
    public function playerPosition($user_id)
    {
        if ($this->jugador1_id == $user_id) {
            return 1;
        } elseif ($this->jugador2_id == $user_id) {
            return 2;
        } elseif ($this->jugador3_id == $user_id) {
            return 3;
        } elseif ($this->jugador4_id == $user_id) {
            return 4;
        } elseif ($this->jugador5_id == $user_id) {
            return 5;
        }
        return 6;
    }

    public function insertPlayer($user_id)
    {
        if ($this->jugador2_id == NULL) {
            if ($this->jugador1_id != $user_id) {
                $this->jugador2_id = $user_id;
                return 2;
            }
        } elseif ($this->jugador3_id == NULL) {
            if ($this->jugador2_id != $user_id) {
                $this->jugador3_id = $user_id;
                return 3;
            }
        } elseif ($this->jugador4_id == NULL) {
            if ($this->jugador3_id != $user_id) {
                $this->jugador4_id = $user_id;
                return 4;
            }
        } elseif ($this->jugador5_id == NULL) {
            if ($this->jugador4_id != $user_id) {
                $this->jugador5_id = $user_id;
                return 5;
            }
        } elseif ($this->jugador6_id == NULL) {
            if ($this->jugador5_id != $user_id) {
                $this->jugador6_id = $user_id;
                return 6;
            }
        }
        return -1;
    }

    /**
     * Determina si es válida la contraseña de la partida.
     *
     * @param string $password
     * @return bool
     */
    public function validPassword($password)
    {
        if ((!isset($password) || $password == null) && $this->password == null) {
            return true;
        } else {
            $hashPass = Hash::make($password);
            return $this->password == $hashPass;
        }
    }

    /**
     * Retorna si el usuario esta en la mesa
     * @param integer $user
     * @return bool
     */
    public function  perteneceJugador($user_id)
    {
        if (   $this->jugador1_id == $user_id
            || $this->jugador2_id == $user_id
            || $this->jugador3_id == $user_id
            || $this->jugador4_id == $user_id
            || $this->jugador5_id == $user_id
            || $this->jugador6_id == $user_id
        ) {
            return true;
        }
        return false;
    }

    /**
     * Si la partida ya se inició
     *
     * @return bool
     */
    public function partidaIniciada()
    {
        return $this->rondaActual > 0;
    }


}