<?php

class BaseController{

    public static function get_user_logged_in(){
        if(isset($_SESSION['user'])){
            $user = Human::find($_SESSION['user']);
            return $user;
        }
        return null;
    }

    public static function check_logged_in(){
        if(!isset($_SESSION['user'])){
            Redirect::to('/login', array('message' => 'Please login first!'));
        }
    }
}