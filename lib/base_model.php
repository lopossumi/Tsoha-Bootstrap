<?php

class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
  protected $validators;

  public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
    foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
      if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
        $this->{$attribute} = $value;
      }
    }
  }

  public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
    $errors = array();

    foreach($this->validators as $validator){

        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        $errors = array_merge($errors, $this->{$validator}());
    }

    return $errors;
  }

  public static function validate_string_length($string, $minLength, $maxLength, $field){
    $errors = array();
    if(strlen($string) < $minLength || strlen($string) > $maxLength){
      $errors[] = $field . ' length must be between '. $minLength . '...' . $maxLength . ' characters!';
    }
    return $errors;
  }

  public function validate_name(){
    $string = $this->name;
    if($string == null || $string == ''){
      return array('Name cannot be empty!');
    }
    return self::validate_string_length($string, 3, 50, 'Name');
  }

  public function validate_description(){
    $string = $this->description;
    if(!is_null($string)){
      return self::validate_string_length($string, 0, 2000, 'Description');
    }
  }
  
  public function validate_description_short(){
    $string = $this->description;
    if(!is_null($string)){
      return self::validate_string_length($string, 0, 200, 'Description');
    }
  }

  public function validate_username(){
    $string = $this->username;
    if($string == null || $string == ''){
      return array('Username cannot be empty!');
    }elseif(!Human::usernameAvailable($string)){
      return array('Username is taken!');
    }else{
      return self::validate_string_length($string, 2, 20, 'Username');
    }
  }

  public function validate_fullname(){
    $string = $this->fullname;
    if($string == null || $string == ''){
      return array('Fullname cannot be empty!');
    }else{
      return self::validate_string_length($string, 1, 100, 'Fullname');
    }
  }

  public function validate_email(){
    $string = $this->email;
    if($string == null || $string == ''){
      return array('Email cannot be empty!');
    }elseif(!Human::emailAvailable($string)){
      return array('Email is taken!');
    }else{
      return self::validate_string_length($string, 3, 254, 'Email');
    }
  }
}

