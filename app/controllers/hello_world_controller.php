<?php

  class HelloWorldController extends BaseController{

    public static function index(){
   	  View::make('login.html');
    }

    public static function home(){
   	  View::make('home.html');
    }

    public static function newtask(){
   	  View::make('newtask.html');
    }

    public static function sandbox(){
      echo 'Hello World!';
    }
  }
