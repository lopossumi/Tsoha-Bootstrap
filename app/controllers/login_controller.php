<?php

class LoginController extends BaseController{

    public static function login(){
        View::make('login.html');
    }

    public static function handle_login(){
        $params = $_POST;

        $user = Human::authenticate(
            $params['email'], 
            $params['password']);

        if(!$user){
            View::make('login.html', array('error' => 'Invalid e-mail or password!', 'email' => $params['email']));
        }else{
            $_SESSION['user'] = $user->id;
            Redirect::to('/', array('message' => 'Welcome back ' . $user->username . '!'));
        }
    }
}