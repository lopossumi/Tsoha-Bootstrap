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
    
    public const VALID_COLORS = array(
        "default",
        "primary",
        "success",
        "info",
        "warning",
        "danger");
    
  public const VALID_SYMBOLS = array(
        "plus",
        "minus",
        "eur",
        "cloud",
        "envelope",
        "glass",
        "music",
        "search",
        "heart",
        "star",
        "star-empty",
        "user",
        "film",
        "th-large",
        "signal",
        "cog",
        "home",
        "file",
        "time",
        "road",
        "lock",
        "flag",
        "headphones",
        "book",
        "bookmark",
        "camera",
        "adjust",
        "tint",
        "globe",
        "wrench");
}
