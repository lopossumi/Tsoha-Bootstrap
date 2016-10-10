<?php
class LoginController extends BaseController{

    public static function login(){
        View::make('login.html');
    }

    public static function handle_login(){
        $params = $_POST;
        //$pwd = crypt($params['password']);

        $user = Human::authenticate(
            $params['email'], 
            $params['password']);

        if(!$user){
            View::make('login.html', array(
                'error'     => 'Invalid e-mail or password! [' . $pwd . ']', 
                'email'     => $params['email']));
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
}
