<?php
/**
 * Created by PhpStorm.
 * 
 * User: Joaquin
 * Date: 17.07.14
 * Time: 16:37
 *
 * @property integer $id
 * @property boolean $numero
 * @property string $palo
 * @method static \Illuminate\Database\Query\Builder|\Carta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Carta whereNumero($value)
 * @method static \Illuminate\Database\Query\Builder|\Carta wherePalo($value)
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Carta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Carta whereUpdatedAt($value)
 */

class Carta extends Eloquent {

    /**
     * @var string
     */
    protected $table = "cartas";
} 