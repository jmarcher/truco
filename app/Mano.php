<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Carta;

/**
 * Created by PhpStorm.
 *
 * User: Joaquín
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
 * @method static \App\Mano find($id,$columns = array('*'))
 */
class Mano extends Model
{

    /**
     * @var string
     */
    protected $table = "manos";


    /**
     * @param array $sorteados
     * @return int
     */
    private function darUnaCarta(&$sorteados)
    {//Probado, la performanceno cambia
        $candidato = mt_rand(1, 40);
        if (in_array($candidato, $sorteados)) {
            return $this->darUnaCarta($sorteados);
        } else {
            $sorteados[] = $candidato;
            return $candidato;
        }
    }


    /**
     * Crea una mano aleatoria bzw. reparte las cartas
     */
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

        //TODO: asignar quien tiene flor
    }

    /**
     * Decide si la carta pasada por parametro es muestra
     *
     * @param Carta $muestra
     * @param Carta $carta
     * @return bool
     */
    private function esMuestra(Carta $muestra, Carta $carta){
        if($carta->palo == $muestra->palo){
            switch($carta->numero){
                case 2: return true; break;
                case 4: return true; break;
                case 5: return true; break;
                case 10: return true; break;
                case 11: return true; break;
                case 12:{
                    switch ($muestra->numero) {
                        case 2: return true; break;
                        case 4: return true; break;
                        case 5: return true; break;
                        case 10: return true; break;
                        case 11: return true; break;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Busca dos carta del mismo palo
     *
     * @param Carta $cartaA
     * @param Carta $cartaB
     * @param Carta $cartaC
     * @return bool
     */
    private function dosMismoPalo(Carta $cartaA, Carta $cartaB, Carta $cartaC){
        return $cartaA->palo == $cartaB->palo
            || $cartaB->palo==$cartaC->palo
            || $cartaA->palo==$cartaC->palo;
    }

    /**
     * Busca una muestra
     *
     * @param Carta $muestra
     * @param Carta $cartaA
     * @param Carta $cartaB
     * @param Carta $cartaC
     * @return bool
     */
    private function unaEsMuestra(Carta $muestra, Carta $cartaA, Carta $cartaB, Carta $cartaC){
        return $this->esMuestra($muestra, $cartaA)
            || $this->esMuestra($muestra, $cartaB)
            || $this->esMuestra($muestra, $cartaC);

    }

    /**
     * Busca dos muestras
     * (Si tiene más también retorna true
     *
     * @param Carta $muestra
     * @param Carta $cartaA
     * @param Carta $cartaB
     * @param Carta $cartaC
     * @return bool
     */
    private function dosSonMuestra(Carta $muestra, Carta $cartaA, Carta $cartaB, Carta $cartaC){
        return ($this->esMuestra($muestra, $cartaA) && $this->esMuestra($muestra, $cartaB))
            || ($this->esMuestra($muestra, $cartaA) && $this->esMuestra($muestra, $cartaC))
            || ($this->esMuestra($muestra, $cartaB) && $this->esMuestra($muestra, $cartaC));

    }

    /**
     * Decide si las cartas del jugador son
     *
     * @param int $jugador
     */
    private function tieneFlor($jugador){
        $muestra = Carta::find($this->muestra);

        $cartas = $this->cartasDe($jugador);

        $cartaA = Carta::find($cartas[0]);
        $cartaB = Carta::find($cartas[1]);
        $cartaC = Carta::find($cartas[2]);
        if($cartaA->palo == $cartaB->palo
            && $cartaC->palo == $cartaB->palo)
        {
            return true;
        }elseif($this->dosMismoPalo($cartaA,$cartaB,$cartaC)
            && $this->unaEsMuestra($muestra, $cartaA,$cartaB,$cartaC)){
            return true;
        }elseif($this->dosSonMuestra($muestra, $cartaA,$cartaB,$cartaC)){
            return true;
        }
        return false;

    }

    /**
     * @param int $jugador
     * @return array
     */
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
        }

        return array($this->carta_A_jugador6, $this->carta_B_jugador6, $this->carta_C_jugador6);
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

    /**
     * @param \Carbon\Carbon $date
     * @return Ronda
     */
    public function ultimaRonda(\Carbon\Carbon $date = NULL)
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

    /**
     * Para preguntar sie l jugador tiene la palabra o no.
     *
     * @param int $used_id
     * @return bool Si el jugador tiene la palabra o no
     */
    public function tieneLaPalabra($user_pos){

        //throw new Exception('Not implemented');
        return $this->tieneLaPalabra == $user_pos%2; //Palabra por grupo
    }

    /**
     * Las precondiciones tienen que ser satisfechas para entrar a estos métodos.
     *
     * @param int $user_pos
     * @return bool
     */
    public function gritarEnvido($user_pos){
        //App::abort(201,"'tieneLaPalabra': Not fully implemented");
        if($this->puntosEnvido != null) {
            if ($this->noQuisoEnvido == null) {
                $this->puntosEnvido += 2; //Suma dos puntos de envido a lo que hay ahi.
                $this->tieneLaPalabra = ($user_pos + 1) % 2;
                return true;
            }
        }
        return false;

    }

    /**
     * @param int $user_pos
     * @return bool
     */
    public function gritarTruco($user_pos){
        if($this->noQuisoTruco == null) {
            $this->puntosTruco = 2; //Suma dos puntos de truco
            $this->tieneLaPalabra = ($user_pos + 1) % 2;
            return true;
        }
        return false;
    }

    /**
     * @param int $user_pos
     * @return bool
     */
    public function gritarFlor($user_pos){
        if($this->tieneFlor($user_pos)) {
            $this->flores[$user_pos-1] = true; //Le da true al array de flores
            $this->puntosEnvido=null;
            return true;
        }
        return false;
    }

    /**
     * @param int $user_pos
     * @return bool
     */
    public function noQuererEnvido($user_pos){
        if($this->noQuisoEnvido==null){
            $this->puntosEnvido /= 2;
            $this->tieneLaPalabra = null;
            $this->noQuisoEnvido = $user_pos;
            return true;
        }
        return false;
    }

    /**
     * @param int $user_pos
     * @return bool
     */
    public function noQuererTruco($user_pos){
        if($this->noQuisoTruco==null){
            $this->puntosTruco /= 2;
            $this->tieneLaPalabra = null;
            $this->noQuisoTruco = $user_pos;
            //TODO: Finalizar la partida en GameController?
            return true;
        }
        return false;//al pedo?
    }
} 