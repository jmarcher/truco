<?php namespace App\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: Joaquin
 * Date: 14.07.14
 * Time: 15:34
 *
 *
 * La idea es retornar siempre un JSON que pueda ser leido desde JAVA e intrpretado por la UI
 */

//Models
use App\Carta;
use App\Game;
use App\Http\Requests;
use App\Mano;
use App\Ronda;
use App\User;

use Auth;
use \Illuminate\Support\Facades\Response;
use \Illuminate\Database\Eloquent\ModelNotFoundException;


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

        debug($partida);
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
                                    $ganadorRonda = $ronda->resolverGanadorRonda($ronda, $mano->muestra);
                                    $ronda->ganador = $ganadorRonda[0]['j']; //Asigna al ganador
                                    $mano->turno = $ganadorRonda[0]['j'];

                                    $nuevaRonda = new Ronda();
                                    $nuevaRonda->gameId = $game->id;
                                    $nuevaRonda->save();
                                    if (!$mano->asignarRonda($nuevaRonda->id)) {
                                        //Ya no hay más rondas por jugar
                                        //FIXME: Primer ronda empate? [Agregar una ronda dummy si la primera es empate?]
                                        $mano->resolverGanadorMano($mano);
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
        } catch (ModelNotFoundException $model) {
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
        } catch (ModelNotFoundException $model) {
            return Response::json($this->getError(3));
        }
        //return $this->returnGameData($id);
    }

    /**
     * @param int $id
     * @param string $grito
     * @return null
     */
    public function gritar($id, $grito){
        /**
         * TODO:
         * Verificar que tiene la palabra    OK
         * Pasar la palabra al otro equipo (u otro jugador?) OK
         * Comprobar que lo que grita no fue gritado ya (excepto el envido)
         * No querer?????
         * Flor???? automáticamente gritada? u opción de decir envido antes.
         *
         */
        /*
         * Leyenda:
         * e = envido
         * f = flor
         * t = truco
         * re = real envido
         * aie = a igualar envido
         * cfr = contraflor al resto
         * cf5e = con flor 5 tantos de envido
         * rt = re truco
         * v4 = vale cuatro
         *
         * Respetar esta leyenda para ser consiso con cualquier versión.
         *
         */
        try{
            $game = Game::findOrFail($id);
            if($game->perteneceJugador(Auth::id())){
                $mano = Mano::find($game->manoId);
                $user_pos = Auth::id();
                if($mano->tieneLaPalabra($user_pos)){
                    switch($grito){
                        case "e": {//envido
                            $mano->gritarEnvido($user_pos);
                        }
                        case "f": {//flor
                            $mano->gritarFlor($user_pos);
                        }
                        case "t": {//truco
                            $mano->gritarTruco($user_pos);
                        }
                    }
                    $mano->save();
                }else{
                    return Response::json($this->info("No tiene la palabra"));
                }
            }else{
                return Response::json($this->getError(4));
            }

        }catch (ModelNotFoundException $model){
            return Response::json($this->getError(3));
        }
        return null;
    }
} 