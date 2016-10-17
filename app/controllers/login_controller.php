<?php
class LoginController extends BaseController{

    public static function login(){
         if(!isset($_SESSION['user'])){
            View::make('login/login.html');
        }else{
            View::make('login/login.html', array(
                'user'      => self::get_user_logged_in()->username));
        }
    }

    public static function handleLogin(){
        $params = $_POST;

        $user = Human::authenticate(
            $params['user'],
            $params['password']);

        if(!$user){
            View::make('login/login.html', array(
                'errors'     => array('Invalid user account or password!'), 
                'user'      => $params['user']));
        }else{
            $_SESSION['user'] = $user->id;
            Redirect::to('/index', array(
                'message'   => 'Welcome back ' . $user->username . '!'));
        }
    }

    public static function logout(){
        $_SESSION['user'] = null;
        Redirect::to('/login', array(
            'message' => 'You have successfully logged out.'));
    }

    /*
    public static function newHuman(){
        View::make('login/signup.html');
    }
    */

    public static function storeHuman(){
        $params = $_POST;
        // validate and create user
        $attributes = array(
            'username'  => $params['username'],
            'fullname'  => $params['fullname'],
            'email'     => $params['email'],
            'password'  => crypt($params['password']));
        $newuser = new Human($attributes);
        $errors = $newuser->errors();
        if($params['password'] != $params['password2']){
            array_push($errors, "Passwords did not match!");
        }
        if(count($errors) == 0){
            // Save new user to DB and login
            $newuser->save();
            $_SESSION['user'] = $newuser->id;
            Redirect::to('/index', array('message' => 'Welcome to askare, ' . $newuser->username . '!'));
        }else{
            View::make('login/login.html', array(
            'errors'        => $errors,
            'attributes'    => $attributes,
            'showmodal'     => true));
        }
    }

    public static function account(){
        $human = self::get_user_logged_in();
        View::make('/login/account.html', array(
            'myAccount'     => $human));
    }
}
