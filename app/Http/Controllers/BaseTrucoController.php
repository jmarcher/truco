<?php

namespace App\Http\Controllers;

use App\Error;

class BaseTrucoController extends Controlador
{
    /**
     * @param mixed $error
     *
     * @return Error
     */
    public function getError($error = 0)
    {
        if (is_numeric($error)) {
            return $this->getErrorNumber($error);
        }

        return new Error($error);
    }

    public function getErrorNumber($error)
    {
        switch ($error) {
            case 1:
                return new Error(1, 'La partida esta llena.');
            case 2:
                return new Error(2, 'Contraseña erronea para la partida.');
            case 3:
                return new Error(3, 'La partida no existe.');
            case 4:
                return new Error(4, 'El jugador no pertenece a la mesa.');
            case 5:
                return new Error(5, 'El juego no se inició, esperando mas jugadores.');
            case 6:
                return new Error(6, 'Datos de usuario inválidos.');
            case 7:
                return new Error(7, 'La sala esta llena o el usuario ya esta en ella.');
            case 8:
                return new Error(8, 'Esta carta ya fué tirada.');
            case 9:
                return new Error(9, 'El jugador ya tiró una carta.');
            case 10:
                return new Error(10, 'No es el turno del jugador.');
            case 11:
                return new Error(11, 'No se deben repartir las cartas.');
            default:
                return new Error(0, 'Error!');
        }
    }

    public function info($message)
    {
        return ['info' => $message];
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }
}
