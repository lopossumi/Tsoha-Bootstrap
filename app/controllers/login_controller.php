<?php

class LoginController extends BaseController{

    public static function login(){
        View::make('login.html');
    }
}
