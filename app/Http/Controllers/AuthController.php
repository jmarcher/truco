<?php
/**
 * Created by PhpStorm.
 * User: Joaquin
 * Date: 14.07.14
 * Time: 19:53
 */

//namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;


class AuthController extends Controlador
{

    use AuthenticatesAndRegistersUsers;


    public function auth()
    {

        // validate the info, create rules for the inputs
        $rules = array(
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        // $input = array("email"=>$usuario, "password"=>$password)
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Response::json($this->getErrorNumber(6));
            /*return Redirect::to('login')
                ->withErrors($validator); */// send back all errors to the login form
            //->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            //dd(Input::get('email'));
            /*dd(Input::get('password'));
            exit();*/
            $userdata = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );

            // attempt to do the login
            if (Auth::check())
                return Response::json(array("logged_in" => false));
            //dd($userdata);
            if (Auth::attempt($userdata)) {

                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)=
                return Response::json(array("logged_in" => true));

            } else {

                // validation not successful, send back to form
                return Response::json(array("logged_in" => false));/* ->withErrors($validator) // send back all errors to the login form
                    ->withInput(Input::except('password'));*/;

            }

        }
    }

    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('login'); // redirect the user to the login screen
    }

    public function showLogin()
    {
        return View::make("loginForm");
    }
} 