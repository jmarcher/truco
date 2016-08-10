<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 *
 * User: Joaquín
 * Date: 17.07.14
 * Time: 22:08
 *
 * @property int $id
 * @property int $gameId
 * @property int $mano
 * @property int $muestra
 * @property int $carta_A_jugador1
 * @property int $carta_B_jugador1
 * @property int $carta_C_jugador1
 * @property int $carta_A_jugador2
 * @property int $carta_B_jugador2
 * @property int $carta_C_jugador2
 * @property int $carta_A_jugador3
 * @property int $carta_B_jugador3
 * @property int $carta_C_jugador3
 * @property int $carta_A_jugador4
 * @property int $carta_B_jugador4
 * @property int $carta_C_jugador4
 * @property int $carta_A_jugador5
 * @property int $carta_B_jugador5
 * @property int $carta_C_jugador5
 * @property int $carta_A_jugador6
 * @property int $carta_B_jugador6
 * @property int $carta_C_jugador6
 *
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
 *
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property bool $turno
 *
 * @method static \Illuminate\Database\Query\Builder|\Mano whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereTurno($value)
 *
 * @property int $ronda1_id
 * @property int $ronda2_id
 * @property int $ronda3_id
 *
 * @method static \Illuminate\Database\Query\Builder|\Mano whereRonda1Id($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereRonda2Id($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereRonda3Id($value)
 *
 * @property bool $ganadorRondas
 *
 * @method static \Illuminate\Database\Query\Builder|\Mano whereGanadorRondas($value)
 *
 * @property bool $tieneLaPalabra
 * @property bool $puntosEnvido
 * @property bool $noQuisoEnvido
 * @property string $flores
 * @property bool $alguienTieneFlor
 * @property bool $puntosTruco
 * @property bool $noQuisoTruco
 *
 * @method static \Illuminate\Database\Query\Builder|\Mano whereTieneLaPalabra($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano wherePuntosEnvido($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereNoQuisoEnvido($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereFlores($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereAlguienTieneFlor($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano wherePuntosTruco($value)
 * @method static \Illuminate\Database\Query\Builder|\Mano whereNoQuisoTruco($value)
 * @method static \App\Mano find($id, $columns = array('*'))
 *
 * @property string $tantosEnvidoJugadores
 * @property bool $quiereEnvido
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Mano whereTantosEnvidoJugadores($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Mano whereQuiereEnvido($value)
 *
 * @property bool $cantJugadores
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Mano whereCantJugadores($value)
 *
 * @property bool $ganadorEnvido
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Mano whereGanadorEnvido($value)
 */
class Mano extends Model
{
    /**
     * @var string
     */
    protected $table = 'manos';

    /**
     * Crea una mano aleatoria bzw. reparte las cartas.
     */
    public function crearManoAleatoria()
    {
        $this->muestra = mt_rand(1, 40);
        $sorteados = [$this->muestra];
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
        $this->alguienTieneFlor = $this->alguienTieneFlor();

        //TODO: Calcular puntos de envido
        $this->calcularPuntosEnvido();
    }

    /**
     * @param array $sorteados
     *
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
     * Se fija si alguno de los jugadores (de los que estan jugando), tiene flor.
     *
     * @return bool
     */
    private function alguienTieneFlor()
    {
        for ($jugador = 1; $jugador <= $this->cantJugadores; $jugador++) {
            if ($this->tieneFlor($jugador)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Decide si las cartas del jugador son.
     *
     * @param int $jugador
     */
    private function tieneFlor($jugador)
    {
        $muestra = Carta::find($this->muestra);

        $cartas = $this->cartasDe($jugador);

        $cartaA = Carta::find($cartas[0]);
        $cartaB = Carta::find($cartas[1]);
        $cartaC = Carta::find($cartas[2]);
        if ($cartaA->palo == $cartaB->palo
            && $cartaC->palo == $cartaB->palo
        ) {
            return true;
        } elseif ($this->dosMismoPalo($cartaA, $cartaB, $cartaC)
            && $this->unaEsMuestra($muestra, $cartaA, $cartaB, $cartaC)
        ) {
            return true;
        } elseif ($this->dosSonMuestra($muestra, $cartaA, $cartaB, $cartaC)) {
            return true;
        }

        return false;
    }

    /**
     * @param int $jugador
     *
     * @return array
     */
    public function cartasDe($jugador)
    {
        if ($jugador == 1) {
            return [$this->carta_A_jugador1, $this->carta_B_jugador1, $this->carta_C_jugador1];
        } elseif ($jugador == 2) {
            return [$this->carta_A_jugador2, $this->carta_B_jugador2, $this->carta_C_jugador2];
        } elseif ($jugador == 3) {
            return [$this->carta_A_jugador3, $this->carta_B_jugador3, $this->carta_C_jugador3];
        } elseif ($jugador == 4) {
            return [$this->carta_A_jugador4, $this->carta_B_jugador4, $this->carta_C_jugador4];
        } elseif ($jugador == 5) {
            return [$this->carta_A_jugador5, $this->carta_B_jugador5, $this->carta_C_jugador5];
        }

        return [$this->carta_A_jugador6, $this->carta_B_jugador6, $this->carta_C_jugador6];
    }

    /**
     * Busca dos carta del mismo palo.
     *
     * @param Carta $cartaA
     * @param Carta $cartaB
     * @param Carta $cartaC
     *
     * @return bool
     */
    private function dosMismoPalo(Carta $cartaA, Carta $cartaB, Carta $cartaC)
    {
        return $cartaA->palo == $cartaB->palo
        || $cartaB->palo == $cartaC->palo
        || $cartaA->palo == $cartaC->palo;
    }

    /**
     * Busca una muestra.
     *
     * @param Carta $muestra
     * @param Carta $cartaA
     * @param Carta $cartaB
     * @param Carta $cartaC
     *
     * @return bool
     */
    private function unaEsMuestra(Carta $muestra, Carta $cartaA, Carta $cartaB, Carta $cartaC)
    {
        return $this->esMuestra($muestra, $cartaA)
        || $this->esMuestra($muestra, $cartaB)
        || $this->esMuestra($muestra, $cartaC);
    }

    /**
     * Decide si la carta pasada por parametro es muestra.
     *
     * @param Carta $muestra
     * @param Carta $carta
     *
     * @return bool
     */
    private function esMuestra(Carta $muestra, Carta $carta)
    {
        return $this->puntosCarta($muestra, $carta) > 26; //Si los puntos de envido son mas grandes de 26 es una muestra
    }

    /**
     * Calcula los puntos para el envido de una carta.
     *
     * @param Carta $muestra
     * @param Carta $carta
     *
     * @return int
     */
    private function puntosCarta(Carta $muestra, Carta $carta)
    {
        if ($carta->palo == $muestra->palo) {
            switch ($carta->numero) {
                case 2:
                    return 30;
                    break;
                case 4:
                    return 29;
                    break;
                case 5:
                    return 28;
                    break;

                case 10:
                case 11:
                    return 27;
                    break;
                case 12: {
                    switch ($muestra->numero) {
                        case 2:
                            return 30;
                            break;
                        case 4:
                            return 29;
                            break;
                        case 5:
                            return 28;
                            break;

                        case 10:
                        case 11:
                            return 27;
                            break;
                    }
                }
            }
        }
        switch ($carta->numero) {
            case 12:
            case 11:
            case 10:
                return 0;
                break;
            default:
                $carta->numero;
        }

        return $carta->numero;
    }

    /**
     * Busca dos muestras
     * (Si tiene más también retorna true.
     *
     * @param Carta $muestra
     * @param Carta $cartaA
     * @param Carta $cartaB
     * @param Carta $cartaC
     *
     * @return bool
     */
    private function dosSonMuestra(Carta $muestra, Carta $cartaA, Carta $cartaB, Carta $cartaC)
    {
        return ($this->esMuestra($muestra, $cartaA) && $this->esMuestra($muestra, $cartaB))
        || ($this->esMuestra($muestra, $cartaA) && $this->esMuestra($muestra, $cartaC))
        || ($this->esMuestra($muestra, $cartaB) && $this->esMuestra($muestra, $cartaC));
    }

    private function calcularPuntosEnvido()
    {
        if (!$this->alguienTieneFlor) {
            $muestra = Carta::find($this->muestra);

            $puntosEnvidoJugadores = [
                0,
                0,
                0,
                0,
                0,
                0,
            ];

            for ($jugador = 1; $jugador <= $this->cantJugadores; $jugador++) {
                $cartas = $this->cartasDe($jugador);
                if ($cartas[0] == null) {
                    break;
                }
                $cartas = $this->intToCarta($cartas);
                $puntos = [
                    $this->puntosCarta($muestra, $cartas[0]),
                    $this->puntosCarta($muestra, $cartas[1]),
                    $this->puntosCarta($muestra, $cartas[2]),
                ];

                if ($this->unaEsMuestraArray($muestra, $cartas)) {
                    //De acá agarramos las dos más grandes y las sumamos
                    //Primero borramos el mínimo
                    $puntos[array_search(min($puntos), $puntos)] = 0;
                    $puntosEnvidoJugadores[$jugador - 1] = array_sum($puntos);
                } elseif ($this->dosMismoPalo($cartas[0], $cartas[1], $cartas[2])) {
                    $cartasMismoPalo = $this->dosMismoPaloArray($cartas);
                    $puntosEnvidoJugadores[$jugador - 1] = 20
                        + $this->puntosCarta($muestra, $cartasMismoPalo[0])
                        + $this->puntosCarta($muestra, $cartasMismoPalo[1]);
                } else {
                    $puntosEnvidoJugadores[$jugador - 1] = max($puntos) + 0;
                }
            }

            $this->ganadorEnvido = array_search(max($puntosEnvidoJugadores), $puntosEnvidoJugadores) + 1;
            $this->tantosEnvidoJugadores = json_encode($puntosEnvidoJugadores);
        }
    }

    /**
     * Convierte el array de cartas (int) a un array de clases de Carta.
     *
     * @param array $cartas
     *
     * @return array
     */
    private function intToCarta($cartas)
    {
        return [
            Carta::find($cartas[0]),
            Carta::find($cartas[1]),
            Carta::find($cartas[2]),
        ];
    }

    /**
     * @param Carta $muestra
     * @param array $cartas
     *
     * @return bool
     */
    private function unaEsMuestraArray(Carta $muestra, $cartas)
    {
        return $this->unaEsMuestra($muestra, $cartas[0], $cartas[1], $cartas[2]);
    }

    /**
     * Devuelve un array con las cartas del mismo palo.
     *
     * @param $cartas
     *
     * @return array
     */
    private function dosMismoPaloArray($cartas)
    {
        if ($cartas[0]->palo == $cartas[1]->palo) {
            return [$cartas[0], $cartas[1]];
        } elseif ($cartas[0]->palo == $cartas[2]->palo) {
            return [$cartas[0], $cartas[2]];
        } elseif ($cartas[1]->palo == $cartas[2]->palo) {
            return [$cartas[1], $cartas[2]];
        }
    }

    /**
     * @param $posicion
     * @param $carta
     *
     * @return bool
     */
    public function tieneCarta($posicion, $carta)
    {
        $str = 'carta_'.$carta.'_jugador'.$posicion;

        return $this->$str != null;
    }

    /**
     * @param Ronda $ronda
     *
     * @return bool
     */
    public function asignarRonda($ronda)
    {
        if ($this->ronda3_id == null) {
            if ($this->ronda2_id == null) {
                if ($this->ronda1_id == null) {
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
     * Pasa a última ronda.
     * Si hay una fecha, va a descargar la más reciente después de ese tiempo,
     * sin importar si hay una más nueva, de esta manera se "sincroniza" la partida
     * y todos los jugadores ven las cartas antes de ser retiradas de la mesa.
     *
     * @param \Carbon\Carbon $date
     *
     * @return Ronda
     */
    public function ultimaRonda(\Carbon\Carbon $date = null)
    {
        if ($date != null) {
            $ronda = Ronda::find($this->ronda1_id);
            if (($date->diffInSeconds($ronda->updated_at, false)) > 0) {
                return $ronda;
            } else {
                if ($this->ronda2_id != null) {
                    $ronda = Ronda::find($this->ronda2_id);
                    if (($date->diffInSeconds($ronda->updated_at, false)) > 0) {
                        return $ronda;
                    } else {
                        if ($this->ronda3_id != null) {
                            $ronda = Ronda::find($this->ronda3_id);

                            return $ronda;
                        } else {
                            return $ronda; //retorna ronda anterior
                        }
                    }
                } else {
                    return $ronda; //Retorna ronda anterior
                }
            }
        } else {
            if ($this->ronda3_id == null) {
                if ($this->ronda2_id == null) {
                    if ($this->ronda1_id == null) {
                        //Devolver la utima ronda de la mano anterior
                        // Ronda::whereGameId($this->gameId)->latest();
                        return;
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
     * Las precondiciones tienen que ser satisfechas para entrar a estos métodos.
     *
     * @param int $user_pos
     *
     * @return bool
     */
    public function gritarEnvido($user_pos)
    {
        //App::abort(201,"'tieneLaPalabra': Not fully implemented");
        if (!$this->alguienTieneFlor) {
            if ($this->puntosEnvido != null) {
                if ($this->noQuisoEnvido == null) {
                    $this->puntosEnvido += 2; //Suma dos puntos de envido a lo que hay ahi.
                    $this->tieneLaPalabra = ($user_pos + 1) % 2;

                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @param int $user_pos
     *
     * @return bool
     */
    public function gritarTruco($user_pos)
    {
        if ($this->noQuisoTruco == null) {
            if ($this->puntosTruco == 0) { //No fue gritado antes y tampoco el re o el vale cuatro
                $this->puntosTruco = 2; //Suma dos puntos de truco
                $this->tieneLaPalabra = ($user_pos + 1) % 2;

                return true;
            }
        }

        return false;
    }

    /**
     * @param int $user_pos
     *
     * @return bool
     */
    public function gritarFlor($user_pos)
    {
        if ($this->tieneFlor($user_pos)) {
            $flores = json_decode($this->flores);
            $flores[$user_pos - 1] = true; //Le da true al array de flores
            $this->flores = json_encode($flores);
            $this->puntosEnvido = null;

            return true;
        }

        return false;
    }

    /**
     * @param int $user_pos
     *
     * @return bool
     */
    public function noQuererTruco($user_pos)
    {
        if ($this->noQuisoTruco == null) {
            $this->puntosTruco /= 2;
            $this->tieneLaPalabra = null;
            $this->noQuisoTruco = $user_pos;
            //TODO: Finalizar la partida en GameController?
            return true;
        }

        return false; //al pedo?
    }

    /**
     * @param Mano $mano
     *
     * @return array Puntos a sumar Nosotros y ellos
     */
    public function resolverGanadorMano()
    {
        /*
         *
         */
        $rondas = [
            Ronda::find($this->ronda1_id),
            Ronda::find($this->ronda2_id),
            Ronda::find($this->ronda3_id),
        ];
        $retorno = [
            'n' => 0,
            'e' => 0,
        ];
        /*
         *    000 = sum(0) || g=0
         *    001 = sum(1) || g =0
         *    011 = sum(2) || g = 1
         *    010 = sum(1) || g = 0
         *    101 = sum(2) || g = 1
         *    110 = sum(2) || g 1
         *    100 = sum(1) || g=0
         *    111 = sum(3) || g 1
         */
        $sum = 0;
        foreach ($rondas as $ronda) {
            $sum += ($ronda->ganador) % 2; //Modulo del ganador es 0 ó 1
        }

        //TODO: Que sume los puntos de los gritos
        if ($sum >= 2) {//Gana el equipo 2,4,6
            $retorno['e'] = 1; //Punto por haber ganado la mano
        } else { //Gana el equipo 1,3,5
            $retorno['n'] = 1; //Punto por haber ganado la mano
        }

        //Puntos de envido.
        if ($this->noQuisoEnvido != null && $this->noQuisoEnvido % 2 == 0) {
            $retorno['n'] += $this->puntosEnvido;
        } elseif ($this->noQuisoEnvido != null && $this->noQuisoEnvido % 2 == 1) {
            $retorno['e'] += $this->puntosEnvido;
        }
        if ($this->quiereEnvido != 0) { //Alguien quiso envido
            if ($this->ganadorEnvido % 2 == 0) {
                $retorno['e'] += $this->puntosEnvido;
            } else {
                $retorno['n'] += $this->puntosEnvido;
            }
        }
    }

    /**
     * Quiere el grito actual, primero se tiene que verificar que grito esta en juego primero.
     * "Querer" no diferencia cual grito es, solo deja el querido. Por ello se tiene que verificar
     * cual es el que se tiene que querer.
     *
     * @param int $user_pos
     *
     * @return bool
     */
    public function querer($user_pos)
    {
        if ($this->noQuisoEnvido == null && $this->quiereEnvido == 0) {
            //significa que se podría querer el envido (ahora verificar que se gritó
            if ($this->puntosEnvido > 0) {
                return $this->quererEnvido($user_pos);
            } else {//Esto significa que nadie gritó envido
                return false;
            }
        }
    }

    /**
     * Las precondiciones tienen que ser satisfechas para entrar a estos métodos
     * Hace todo lo necesario para dar por querido el envido
     * ¿¿¿¿¿Tiene que ser el mano???????
     *
     * @param int $user_pos
     *
     * @return bool
     */
    public function quererEnvido($user_pos)
    {
        if ($this->puntosEnvido > 0) {
            if ($this->tieneLaPalabra($user_pos)) {
                if ($this->noQuisoEnvido == null && $this->ganadorEnvido == null) {
                    $envidos = json_decode($this->tantosEnvidoJugadores);
                    $ganadorEnvido = 1 + array_search(max($envidos), $envidos);
                    $this->ganadorEnvido = $ganadorEnvido;
                    $this->quiereEnvido = $user_pos;

                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Para preguntar sie l jugador tiene la palabra o no.
     *
     * @param int $used_id
     *
     * @return bool Si el jugador tiene la palabra o no
     */
    public function tieneLaPalabra($user_pos)
    {

        //throw new Exception('Not implemented');
        return ($this->tieneLaPalabra == null) || $this->tieneLaPalabra == $user_pos % 2; //Palabra por grupo
    }

    /**
     * Devuelve true si el jugador tiene que querer el envido.
     *
     * @param int $playerPos
     *
     * @return bool
     */
    public function seTieneQueQuererEnvido($playerPos)
    {
        if ($this->noQuisoEnvido == null && $this->quiereEnvido == 0) {
            //significa que se podría querer el envido (ahora verificar que se gritó
            if ($this->puntosEnvido > 0) {
                if ($this->tieneLaPalabra($playerPos)) {
                    return true;
                }
            }
        }

        return false;
    }

    public function noQuerer($user_pos)
    {
        if ($this->noQuisoEnvido == null && $this->quiereEnvido == 0) {
            //significa que se podría querer el envido (ahora verificar que se gritó
            if ($this->puntosEnvido > 0) {
                return $this->noQuererEnvido($user_pos);
            } else {//Esto significa que nadie gritó envido
                return false;
            }
        }
    }

    /**
     * @param int $user_pos
     *
     * @return bool
     */
    public function noQuererEnvido($user_pos)
    {
        if ($this->noQuisoEnvido == null) {
            $this->puntosEnvido /= 2;
            $this->tieneLaPalabra = null;
            $this->noQuisoEnvido = $user_pos;

            return true;
        }

        return false;
    }
}
