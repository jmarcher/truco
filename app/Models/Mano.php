<?php

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
 */
class Mano extends Eloquent
{

    /**
     * @var string
     */
    protected $table = "manos";

    private function darUnaCarta(&$sorteados)
    {
        $candidato = mt_rand(1, 40);
        if (in_array($candidato, $sorteados)) {
            return $this->darUnaCarta($sorteados);
        } else {
            $sorteados[] = $candidato;
            return $candidato;
        }
    }

    public function crearManoAleatoria()
    {
        $this->muestra = mt_rand(1, 40);
        $sorteados = array($this->muestra);
        $this->carta_A_jugador1 = $this->darUnaCarta($sorteados);
        $this->carta_B_jugador1 = $this->darUnaCarta($sorteados);
        $this->carta_C_jugador1 = $this->darUnaCarta($sorteados);
        $this->carta_A_jugador2 = $this->darUnaCarta($sorteados);
        $this->carta_B_jugador2 = $this->darUnaCarta($sorteados);
        $this->carta_C_jugador2 = $this->darUnaCarta($sorteados);
        $this->carta_A_jugador3 = $this->darUnaCarta($sorteados);
        $this->carta_B_jugador3 = $this->darUnaCarta($sorteados);
        $this->carta_C_jugador3 = $this->darUnaCarta($sorteados);
        $this->carta_A_jugador4 = $this->darUnaCarta($sorteados);
        $this->carta_B_jugador4 = $this->darUnaCarta($sorteados);
        $this->carta_C_jugador4 = $this->darUnaCarta($sorteados);
        $this->carta_A_jugador5 = $this->darUnaCarta($sorteados);
        $this->carta_B_jugador5 = $this->darUnaCarta($sorteados);
        $this->carta_C_jugador5 = $this->darUnaCarta($sorteados);
        $this->carta_A_jugador6 = $this->darUnaCarta($sorteados);
        $this->carta_B_jugador6 = $this->darUnaCarta($sorteados);
        $this->carta_C_jugador6 = $this->darUnaCarta($sorteados);
    }

    public function cartasDe($jugador)
    {
        if ($jugador == 1) {
            return array($this->carta_A_jugador1, $this->carta_B_jugador1, $this->carta_C_jugador1);
        } elseif ($jugador == 2) {
            return array($this->carta_A_jugador2, $this->carta_B_jugador2, $this->carta_C_jugador2);
        } elseif ($jugador == 3) {
            return array($this->carta_A_jugador3, $this->carta_B_jugador3, $this->carta_C_jugador3);
        } elseif ($jugador == 4) {
            return array($this->carta_A_jugador4, $this->carta_B_jugador4, $this->carta_C_jugador4);
        } elseif ($jugador == 5) {
            return array($this->carta_A_jugador5, $this->carta_B_jugador5, $this->carta_C_jugador5);
        } elseif ($jugador == 6) {
            return array($this->carta_A_jugador6, $this->carta_B_jugador6, $this->carta_C_jugador6);
        }
    }

    /**
     * @param $posicion
     * @param $carta
     * @return bool
     */
    public function tieneCarta($posicion, $carta)
    {
        $str = "carta_" . $carta . "_jugador" . $posicion;
        return $this->$str != NULL;
    }

    /**
     * @param Ronda $ronda
     * @return bool
     */
    public function asignarRonda($ronda)
    {
        if ($this->ronda3_id == NULL) {
            if ($this->ronda2_id == NULL) {
                if ($this->ronda1_id == NULL) {
                    $this->ronda1_id = $ronda;
                } else {
                    $this->ronda2_id = $ronda;
                }
            } else {
                $this->ronda3_id = $ronda;
            }
            return true;
        }
        return false;
    }

    public function ultimaRonda(Carbon\Carbon $date = NULL)
    {//FIXME:Si la fecha es igual no descaga novedades
        if ($date != NULL) {
            $ronda = Ronda::find($this->ronda1_id);
            if (($date->diffInSeconds($ronda->updated_at)) > 0) {
                return $ronda;
            } else {
                if ($this->ronda2_id != NULL) {
                    $ronda = Ronda::find($this->ronda2_id);
                    if (($date->diffInSeconds($ronda->updated_at)) > 0) {
                        return $ronda;
                    } else {
                        if ($this->ronda3_id != NULL) {
                            $ronda = Ronda::find($this->ronda3_id);
                            return $ronda;
                        } else {
                            return $ronda;//retorna ronda anterior
                        }
                    }
                } else {
                    return $ronda;//Retorna ronda anterior
                }
            }
        } else {
            if ($this->ronda3_id == NULL) {
                if ($this->ronda2_id == NULL) {
                    if ($this->ronda1_id == NULL) {
                        return null;
                    } else {
                        return Ronda::find($this->ronda1_id);
                    }
                } else {
                    return Ronda::find($this->ronda2_id);
                }
            } else {
                return Ronda::find($this->ronda3_id);
            }
        }
    }
} 