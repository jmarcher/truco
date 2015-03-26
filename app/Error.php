<?php
namespace App;
    /**
     * Created by PhpStorm.
     * User: Joaquin
     * Date: 17.07.14
     * Time: 01:16
     *
     * Modelo de error, es tirado para el json
     */

//TODO: Hacer esto un Model y guardar cada vez que pasa un error

class Error
{
    public $error;

    private $errors = array(
        "faltan_cartas" => array("number" => 6, "message" => "Faltan cartas en la mesa para decidir un ganador."),
    );

    public function __construct($number, $message = null)
    {
        if (is_numeric($number))
            $this->error = array("error" => $number, "message" => $message);
        else
            $this->error = array("error" => $this->errors[$number]['number'], "message" => $this->errors[$number]['message']);
    }
} 
