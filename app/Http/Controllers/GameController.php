<?php
/**
 * Created by PhpStorm.
 * User: Joaquin
 * Date: 14.07.14
 * Time: 15:34
 *
 *
 * La idea es retornar siempre un JSON que pueda ser leido desde JAVA e intrpretado por la UI
 */


use App\Http\Requests;
use App\Http\Controllers\BaseTrucoController;


class GameController extends BaseTrucoController
{

    public function startGame()
    {
        //Debugbar::error('Error!');
        /*
         * Cosas a hacer:
         * - Crear juego, agregar jugador al jugador
         * - Retorna el id de la partida
         */
        //FIXME: hacer algunos controles antes para que no se creen muchas partidas al pedo.
        $usuarioActivo = Auth::user();
        $partida = new Game();
        $partida->jugador1_id = $usuarioActivo->id;
        $partida->turnoRepartir = 1;
        $partida->puntosE = 0;
        $partida->puntosN = 0;
        $partida->seDebeRepartir=false;
        $partida->save();

        return Response::json(array("partida" => array("id" => $partida['id'])));
    }

    public function joinGame($id, $password = null)
    {
        try {
            $game = Game::findOrFail($id);
            if ($game->perteneceJugador(Auth::id())) {
                return Response::json(array("id" => $game->id));
            }
            if ($game->validPassword($password)) {
                $pos = $game->insertPlayer(Auth::id());
                if ($pos > 0) {
                    if ($game->cantJugadores == $pos) {//ya estamos en la max cant de jugadores
                        $game->seDebeRepartir=true; //Ahora marcamos para que se puedan repartir las cartas
                    }
                    $game->save();
                    return Response::json(array("id" => $game->id));
                } else {
                    return Response::json($this->getError(4));
                }
            } else {
                return Response::json($this->getError(2));
            }
        } catch (ModelNotFoundException $model) {
            return Response::json($this->getError(3));
        }
        return Response::json($this->getError());

    }

    /**
     * Resuelve quien es el ganador de la ronda actual con todas las cartas sobre la mesa
     *
     * En caso de no estar todas las cartas sobre la mesa retorna NULL o error
     * En caso contrario retorna al ganador de la ronda actual.
     *
     */
    public function resolverGanadorRonda(Ronda $ronda, $muestraId)
    {
        $enMesa = array("muestra" => $muestraId,//2 copa
            "user1" => $ronda->carta_jugador1, //5 copa
            "user2" => $ronda->carta_jugador2, //6 espada
            "user3" => $ronda->carta_jugador3, //5 basto
            "user4" => $ronda->carta_jugador4, //2 oro
            "user5" => $ronda->carta_jugador5, //2 oro
            "user6" => $ronda->carta_jugador6, //2 oro
        );
        $muestra = Carta::find($enMesa['muestra']);


        $valoresEnOrden = array(

            Carta::whereRaw("numero=2 and palo=?", array($muestra['palo']))->get(array('id'))[0],
            Carta::whereRaw("numero=4 and palo=?", array($muestra['palo']))->get(array('id'))[0],
            Carta::whereRaw("numero=5 and palo=?", array($muestra['palo']))->get(array('id'))[0],
            Carta::whereRaw("numero=11 and palo=?", array($muestra['palo']))->get(array('id'))[0],
            Carta::whereRaw("numero=10 and palo=?", array($muestra['palo']))->get(array('id'))[0],

            //matas
            Carta::whereRaw("numero=1 and palo='espada'")->get(array('id'))[0],
            Carta::whereRaw("numero=1 and palo='basto'")->get(array('id'))[0],
            Carta::whereRaw("numero=7 and palo='espada'")->get(array('id'))[0],
            Carta::whereRaw("numero=7 and palo='oro'")->get(array('id'))[0],

            Carta::where("numero", "=", 3)->get(array('id'))->toArray(),

            Carta::whereRaw("numero=2 and palo!=?", array($muestra['palo']))->get(array('id'))->toArray(),

            Carta::whereRaw("numero=1 and (palo='oro' or palo='copa')")->get(array('id'))->toArray(),

            Carta::where("numero", "=", 12)->get(array('id'))->toArray(),

            Carta::whereRaw("numero=11 and palo!=?", array($muestra['palo']))->get(array('id'))->toArray(),

            Carta::whereRaw("numero=10 and palo!=?", array($muestra['palo']))->get(array('id'))->toArray(),


            Carta::whereRaw("numero=7 and (palo='copa' or palo='basto')")->get(array('id'))->toArray(),


            Carta::where("numero", "=", 6)->get(array('id'))->toArray(),


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
                return 0;

            }
        );
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
    private function valor($valoresEnOrden, $idCarta)
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

    /**
     * @param $id Id de la partida
     * @param $cartaId Lugar de la carta:  A;B;C
     * @return \Illuminate\Http\JsonResponse|null
     */
    public function ponerCarta($id, $cartaId)
    {
        $gameId = $id;
        /*
         * Validaciones:
         *  - Pertenece a la mesa OK
         *  - No puso ya una carta OK
         *  - Tiene esa carta en la mano OK
         *  - Es su turno (opcional) OK
         */

        $user = Auth::user();
        try {
            $game = Game::findOrFail($gameId);
            if ($game->perteneceJugador(Auth::id())) {
                if ($game->partidaIniciada()) {
                    /*
                     * LISTODO: Obtener la ronda actual
                     * LISTODO: que no puso una carta ya (???)
                     * LISTODO:Validar turno
                     */
                    $posicion = $game->playerPosition(Auth::id());
                    $mano = Mano::find($game->manoId);
                    $ronda = $mano->ultimaRonda();
                    if ($mano->tieneCarta($posicion, $cartaId)) {
                        if ($ronda->noTiroCarta($posicion)) {//Verifico que no tiró una carta ya
                            if ($mano->turno == $posicion) {//Verifico que sea el turno
                                $strMano = "carta_" . $cartaId . "_jugador" . $posicion;
                                $strRondaJug = "carta_jugador" . $posicion;
                                $carta = $mano->$strMano;
                                $ronda->$strRondaJug = $carta;
                                $mano->$strMano = NULL;
                                if ($game->cantJugadores == $posicion) {
                                    $mano->turno = 1;
                                } else {
                                    $mano->turno++;
                                }
                                if (!$ronda->noTiroCarta($mano->turno)) {//Quiere decir que tiró la carta
                                    //esto quiere decir que es el fin de la ronda actual
                                    $ganadorRonda = $this->resolverGanadorRonda($ronda, $mano->muestra);
                                    $ronda->ganador = $ganadorRonda[0]['j']; //Asigna al ganador
                                    $mano->turno = $ganadorRonda[0]['j'];

                                    $nuevaRonda = new Ronda();
                                    $nuevaRonda->gameId = $game->id;
                                    $nuevaRonda->save();
                                    if (!$mano->asignarRonda($nuevaRonda->id)) {
                                        //Ya no hay más rondas por jugar
                                        //FIXME: Primer ronda empate? [Agregar una ronda dummy si la primera es empate?]
                                        $this->resolverGanadorMano($mano);
                                        $game->turnoRepartir++;
                                        if ($game->turnoRepartir > $game->cantJugadores) {
                                            $game->turnoRepartir = 1;
                                        }
                                        $game->seDebeRepartir = true;
                                        $game->manoId = null;
                                        $game->save();
                                    }
                                }
                                $mano->save();
                                $ronda->save();
                                return $this->returnGameData($gameId, $ronda->updated_at->subMinute());
                            } else {
                                return Response::json($this->getError(10));
                            }
                        } else {
                            return Response::json($this->getError(9));
                        }
                    } else {
                        return Response::json($this->getError(8));
                    }

                } else {
                    return Response::json($this->getError(5));
                }
            } else {
                return Response::json($this->getError(4));
            }
        } catch (ModelNotFoundException $model) {
            return Response::json($this->getError(3));
        }
        return null;
    }

    /**
     * @param Mano $mano
     * @return array Puntos a sumar Nosotros y ellos
     */
    private function resolverGanadorMano(Mano $mano){
        /*
         *
         */
        $rondas = array(
            Ronda::find($mano->ronda1_id),
            Ronda::find($mano->ronda2_id),
            Ronda::find($mano->ronda3_id),
        );
        $retorno = array(
            "n" => 0,
            "e" => 0
        );
        /**
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
        foreach($rondas as $ronda){
            $sum += ($ronda->ganador) % 2; //Modulo del ganador es 0 ó 1
        }

        //TODO: Que sume los puntos de los gritos
        if($sum >= 2){//Gana el equipo 2,4,6
            $retorno['e'] = 1;//Punto por haber ganado la mano
        }else{ //Gana el equipo 1,3,5
            $retorno['n'] = 1; //Punto por haber ganado la mano
        }
    }

    public function returnGamesList()
    {
        $listaJuegos = Game::all();
        /*$listaRetorno=array();
        foreach($listaJuegos as $juego){
            array_push($listaRetorno,array("properties"=>array("title"=>"Juego ID:".$juego['id'])));
        }*/
        //TODO: Mostrar solo los juegos que son validos para el jugador bzw. que el creó o que lo invitaron

        return Response::json($listaJuegos);
    }

    public function returnGameData($id, $date = null)
    {
        //TODO: retornar todos los datos necesarios
        /*
         * Nombre de los usuarios, cartas que tienen en la mano actual.
         * no enviar mas información de la necesaria
         */
        try {
            $game = Game::findOrFail($id);
            if ($game->perteneceJugador(Auth::id())) {
                if ($date != null) {
                    $date = new \Carbon\Carbon($date);
                }
                if($game->seDebeRepartir){
                    if($game->playerPosition(Auth::id()) == $game->turnoRepartir){
                        return Response::json(array("repartir"=>true));
                    }else{
                        return Response::json($this->info("Esperando que se repartan las cartas."));
                    }
                }
                if ($game->rondaActual != 0) {
                    $gameData = $game;

                    $gameData['jugador1'] = User::find($game->jugador1_id);
                    $gameData['jugador2'] = User::find($game->jugador2_id);
                    $gameData['jugador3'] = User::find($game->jugador3_id);
                    $gameData['jugador4'] = User::find($game->jugador4_id);
                    $gameData['jugador5'] = User::find($game->jugador5_id);
                    $gameData['jugador6'] = User::find($game->jugador6_id);

                    $playerPos = $game->playerPosition(Auth::id());
                    $mano = Mano::find($game->manoId);
                    $ronda = $mano->ultimaRonda($date);
                    if ($playerPos == $mano->turno) {
                        $gameData['turno'] = true;
                    }
                    $gameData['cartasEnMano'] = $mano->cartasDe($playerPos);
                    $gameData['cartasEnMesa'] = array(
                        $ronda->carta_jugador1,
                        $ronda->carta_jugador2,
                        $ronda->carta_jugador3,
                        $ronda->carta_jugador4,
                        $ronda->carta_jugador5,
                        $ronda->carta_jugador6,

                    );//todo: depende de la ronda

                    if ($ronda->ganador != 0) {//Esto significa que alguien ganó
                        $gameData['ganador'] = $ronda->ganador;
                    }

                    $gameData['muestra'] = $mano->muestra;
                    $gameData['updated'] = $mano->updated_at . "";
                    return Response::json($gameData);
                } else {
                    return Response::json($this->info("Esperando más jugadores."));
                }
            } else {
                return Response::json($this->getError(4));
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $model) {
            return Response::json($this->getError(3));
        }
        return Response::json($this->getError());
    }

    public function repartirCartas($id)
    {
        try {
            $game = Game::findOrFail($id);
            if($game->seDebeRepartir) {
                //return Response::make($game->playerPosition(Auth::user()));
                if ($game->playerPosition(Auth::id()) == $game->turnoRepartir) { //Es el turno del jugador
                    $ronda = new Ronda();
                    $mano = new Mano();
                    $mano->gameId = $game->id;
                    $mano->crearManoAleatoria();
                    $mano->turno = $game->playerPosition(Auth::user())+1;//Se le asigna al siguiente
                    if($mano->turno > $game->cantJugadores){
                        //Si nos pasamos de la cantidad de jugadores,
                        //tenemos que el turno es del primero
                        $mano->turno = 1;
                    }

                    $game->turnoRepartir++;
                    if($game->turnoRepartir>$game->cantJugadores){
                        $game->turnoRepartir = 1;
                    }
                    //$ronda->manoId = $mano->id;
                    $ronda->gameId = $game->id;
                    $ronda->save();
                    $mano->ronda1_id = $ronda->id;
                    $mano->save();
                    $game->manoId = $mano->id;
                    $game->rondaActual = 1;
                    $game->manoId = $mano->id;
                    $game->seDebeRepartir = false;
                    $game->save();
                    return $this->returnGameData($id);
                } else {
                    return Response::json($this->getError(10));
                }
            }else{
                return Response::json($this->getError(11));
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $model) {
            return Response::json($this->getError(3));
        }
        //return $this->returnGameData($id);
    }

    public function gritar($id, $grito){
        /**
         * TODO:
         * Verificar que tiene la palabra
         * Pasar la palabra al otro equipo (u otro jugador?)
         * No querer?????
         * Flor???? automaticamente gritada? u opción de decir envido antes.
         */
        try{
            $game = Game::findOrFail($id);

            if($game->perteneceJugador(Auth::id())){

            }else{
                return Response::json($this->getError(4));
            }

        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $model){
            return Response::json($this->getError(3));
        }
        return null;
    }
} 