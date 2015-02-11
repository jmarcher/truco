<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::pattern('id', '[0-9]+');//Cualquier parametro llamado "id" tiene que ser numérico

Route::get('/', array('before' =>  'auth', function()
{
	return View::make('hello');
}));

Route::get('auth/required',function(){
    return Response::json(array("info"=>"Tienes que estar logueado."));
});

// route to show the login form
Route::get('login', array('uses' => 'AuthController@showLogin'));

// route to process the form
Route::get('loginGet', array('uses' => 'AuthController@auth'));

Route::get('logout', array('uses' => 'AuthController@doLogout'));

Route::get('register', function()
{
    $user = new User();
    $user->email = "diego@gmail.com";
    $user->password = Hash::make("pass");
    $user->name = "Diego";
    $user->save();
    return "Registrado";
});

Route::get("prueba",function(){
   return 3%3;
});



//LAS RUTAS DE ARRIBA SON DE PRUEBA

//LOGIN
Route::post('loginService', array('uses' => 'AuthController@auth'));

/*
 * Game Routes
 */

//Routes que necesitan auth
Route::group(['middleware'=>'auth'], function() {
    Route::get('startGame', array('uses' => 'GameController@startGame'));
    Route::get('joinGame/{id}/{password?}', array('uses' => 'GameController@joinGame'));
    Route::get('resolveWinner/{id}', array('uses' => 'GameController@resolverGanadorRonda'));
    Route::get('listaJuegos', array('uses' => 'GameController@returnGamesList'));
    Route::get('returnGameData/{id}/{date?}', array('uses' => 'GameController@returnGameData'));
    Route::get('ponerCarta/{id}/{cartaId}', array('uses' => 'GameController@ponerCarta'));
    Route::get('repartirCartas/{id}',array('uses' => 'GameController@repartirCartas'));
});
