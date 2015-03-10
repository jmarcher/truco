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


Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');


Route::get('auth/required', function () {
    return Response::json(array("info" => "Tienes que estar logueado."));
});

// route to show the login form
Route::get('login', array('uses' => 'AuthController@showLogin'));

// route to process the form
Route::get('loginGet', array('uses' => 'AuthController@auth'));

Route::get('logout','AuthController@doLogout');

Route::get('register', function () {
    $user = new User();
    $user->email = "diego@gmail.com";
    $user->password = Hash::make("pass");
    $user->name = "Diego";
    $user->save();
    return "Registrado";
});

Route::get("prueba", function () {
    $time_start = microtime(true);
    for ($i = 1; $i <= 10000; $i++) {
        $mano = new Mano();
        $mano->crearManoAleatoria();
    }
    $time_end = microtime(true);
    $time = $time_end - $time_start;
    return "Esto paso en: " . $time . " segundos.";
});


//LAS RUTAS DE ARRIBA SON DE PRUEBA

//LOGIN
Route::post('loginService', array('uses' => 'AuthController@auth'));

/*
 * Game Routes
 */

//Routes que necesitan auth
Route::group(['middleware' => 'auth'], function () {
    Route::get('startGame', 'GameController@startGame');
    Route::get('joinGame/{id}/{password?}', 'GameController@joinGame');
    Route::get('resolveWinner/{id}', 'GameController@resolverGanadorRonda');
    Route::get('listaJuegos', 'GameController@returnGamesList');
    Route::get('returnGameData/{id}/{date?}', 'GameController@returnGameData');
    Route::get('ponerCarta/{id}/{cartaId}', 'GameController@ponerCarta');
    Route::get('repartirCartas/{id}', 'GameController@repartirCartas');
    Route::get('gritar/{id}/{grito}', 'GameController@gritar');
    Route::get('noQuerer/{id}', 'GameController@noQuerer');
    Route::get('querer/{id}', 'GameController@querer');
});
/*
Route::controllers([
    'auth' => 'AuthController',
   // 'password' => 'Auth\PasswordController',
]);*/