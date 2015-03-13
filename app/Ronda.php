<?php namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Carta;

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

    /**
     * Resuelve quien es el ganador de la ronda actual con todas las cartas sobre la mesa
     *
     * En caso de no estar todas las cartas sobre la mesa retorna NULL o error
     * En caso contrario retorna al ganador de la ronda actual.
     *
     */
    public function resolverGanadorRonda($muestraId)
    {//FIXME: Mejorable sin tantas consultas SQL???
        $enMesa = array("muestra" => $muestraId,//2 copa
            "user1" => $this->carta_jugador1, //5 copa
            "user2" => $this->carta_jugador2, //6 espada
            "user3" => $this->carta_jugador3, //5 basto
            "user4" => $this->carta_jugador4, //2 oro
            "user5" => $this->carta_jugador5, //2 oro
            "user6" => $this->carta_jugador6, //2 oro
        );

        $muestra = Carta::find($enMesa['muestra']);


        $valoresEnOrden = array(

            Carta::whereRaw("numero=2 and palo=?", array($muestra['palo']))->get(array('id'))[0],
            Carta::whereRaw("numero=4 and palo=?", array($muestra['palo']))->get(array('id'))[0],
            Carta::whereRaw("numero=5 and palo=?", array($muestra['palo']))->get(array('id'))[0],
            Carta::whereRaw("numero=11 and palo=?", array($muestra['palo']))->get(array('id'))[0],
            Carta::whereRaw("numero=10 and palo=?", array($muestra['palo']))->get(array('id'))[0],

            //matas Hardcodeables
            Carta::whereRaw("numero=1 and palo='espada'")->get(array('id'))[0],
            Carta::whereRaw("numero=1 and palo='basto'")->get(array('id'))[0],
            Carta::whereRaw("numero=7 and palo='espada'")->get(array('id'))[0],
            Carta::whereRaw("numero=7 and palo='oro'")->get(array('id'))[0],

            Carta::where("numero", "=", 3)->get(array('id'))->toArray(),

            Carta::whereRaw("numero=2 and palo!=?", array($muestra['palo']))->get(array('id'))->toArray(),

            Carta::whereRaw("numero=1 and (palo='oro' or palo='copa')")->get(array('id'))->toArray(),//hardcodeable

            Carta::where("numero", "=", 12)->get(array('id'))->toArray(), //TODO: Hardcodeable

            Carta::whereRaw("numero=11 and palo!=?", array($muestra['palo']))->get(array('id'))->toArray(),

            Carta::whereRaw("numero=10 and palo!=?", array($muestra['palo']))->get(array('id'))->toArray(),


            Carta::whereRaw("numero=7 and (palo='copa' or palo='basto')")->get(array('id'))->toArray(),//hardcodeable


            Carta::where("numero", "=", 6)->get(array('id'))->toArray(), //TODO: Hardcodeable


            Carta::whereRaw("numero=5 and palo!=?", array($muestra['palo']))->get(array('id'))->toArray(),

            Carta::whereRaw("numero=4 and palo!=?", array($muestra['palo']))->get(array('id'))->toArray(),

        );
        if ($muestra->numero == 2) {
            $valoresEnOrden[0] = Carta::whereRaw("numero=12 and palo=?", array($muestra['palo']))->get(array('id'))[0];
            if ($muestra['palo'] == "oro") {
                unset($valoresEnOrden[12][0]);
            } elseif ($muestra['palo'] == "basto") {
                unset($valoresEnOrden[12][1]);
            } elseif ($muestra['palo'] == "espada") {
                unset($valoresEnOrden[12][2]);
            } elseif ($muestra['palo'] == "copa") {
                unset($valoresEnOrden[12][3]);
            }
            //unset($valoresEnOrden[12][$key]);
        } elseif ($muestra->numero == 4) {
            $valoresEnOrden[1] = Carta::whereRaw("numero=12 and palo=?", array($muestra['palo']))->get(array('id'))[0];
            if ($muestra['palo'] == "oro") {
                unset($valoresEnOrden[12][0]);
            } elseif ($muestra['palo'] == "basto") {
                unset($valoresEnOrden[12][1]);
            } elseif ($muestra['palo'] == "espada") {
                unset($valoresEnOrden[12][2]);
            } elseif ($muestra['palo'] == "copa") {
                unset($valoresEnOrden[12][3]);
            }
        } elseif ($muestra->numero == 5) {
            $valoresEnOrden[2] = Carta::whereRaw("numero=12 and palo=?", array($muestra['palo']))->get(array('id'))[0];
            if ($muestra['palo'] == "oro") {
                unset($valoresEnOrden[12][0]);
            } elseif ($muestra['palo'] == "basto") {
                unset($valoresEnOrden[12][1]);
            } elseif ($muestra['palo'] == "espada") {
                unset($valoresEnOrden[12][2]);
            } elseif ($muestra['palo'] == "copa") {
                unset($valoresEnOrden[12][3]);
            }
        } elseif ($muestra->numero == 11) {
            $valoresEnOrden[3] = Carta::whereRaw("numero=12 and palo=?", array($muestra['palo']))->get(array('id'))[0];
            if ($muestra['palo'] == "oro") {
                unset($valoresEnOrden[12][0]);
            } elseif ($muestra['palo'] == "basto") {
                unset($valoresEnOrden[12][1]);
            } elseif ($muestra['palo'] == "espada") {
                unset($valoresEnOrden[12][2]);
            } elseif ($muestra['palo'] == "copa") {
                unset($valoresEnOrden[12][3]);
            }
        } elseif ($muestra->numero == 10) {
            $valoresEnOrden[4] = Carta::whereRaw("numero=12 and palo=?", array($muestra['palo']))->get(array('id'))[0];
            if ($muestra['palo'] == "oro") {
                unset($valoresEnOrden[12][0]);
            } elseif ($muestra['palo'] == "basto") {
                unset($valoresEnOrden[12][1]);
            } elseif ($muestra['palo'] == "espada") {
                unset($valoresEnOrden[12][2]);
            } elseif ($muestra['palo'] == "copa") {
                unset($valoresEnOrden[12][3]);
            }
        }

        //return Response::make(($valoresEnOrden[12][0]['id']/*["id"]*/));
        //j = jugador
        //v = valor de la carta
        $valoresRonda = array(
            array("j" => 1,
                "v" => $this->valor($valoresEnOrden, $enMesa['user1'])),
            array("j" => 2,
                "v" => $this->valor($valoresEnOrden, $enMesa['user2'])),
            array("j" => 3,
                "v" => $this->valor($valoresEnOrden, $enMesa['user3'])),
            array("j" => 4,
                "v" => $this->valor($valoresEnOrden, $enMesa['user4'])),
            array("j" => 5,
                "v" => $this->valor($valoresEnOrden, $enMesa['user5'])),
            array("j" => 6,
                "v" => $this->valor($valoresEnOrden, $enMesa['user6'])),
        );
        usort($valoresRonda, function ($a, $b) {
            if ($a['v'] == NULL) {
                return 1;
            }
            if ($a['v'] > $b['v']) {
                return 1;
            } elseif ($a['v'] < $b['v']) {
                return -1;
            }

            //TODO: Controlar quien tiró primero la carta
            //Es necesario?
            return 0;

        });
        //dd($valoresRonda);
        //return Response::make($this->valor($valoresEnOrden,$enMesa['user1']). "   ----    ".($this->valor($valoresEnOrden,$enMesa['user2'])). "   ----    ".($this->valor($valoresEnOrden,$enMesa['user3'])). "   ----    ".($this->valor($valoresEnOrden,$enMesa['user4'])) );
        //$header=array();
        return ($valoresRonda);
    }

    /**
     * Resuelve un valor numérico para luego ser evaluado, para saber quien ganó
     *
     * @param $valoresEnOrden
     * @param $idCarta
     * @return int|string
     */
    private function valor($valoresEnOrden, $idCarta)3
    {
        $valor = 1;
        if ($idCarta == NULL) {
            return PHP_INT_MAX;
        }
        foreach ($valoresEnOrden as $carta) {
            //return $carta;
            //return $carta['id'];
            if (isset($carta['id']) && $carta['id'] == $idCarta)
                return $valor;
            elseif (count($carta) > 1) {
                foreach ($carta as $nido) {
                    if (isset($nido['id']) && $nido['id'] == $idCarta)
                        return $valor;
                }
            }
            $valor++;
        }
        return "pepe";

    }


} 