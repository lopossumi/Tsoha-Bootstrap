<?php

class BaseModel{
  protected $validators;

  public function __construct($attributes = null){
    foreach($attributes as $attribute => $value){
      if(property_exists($this, $attribute)){
        $this->{$attribute} = $value;
      }
    }
  }

  // Returns all $errors from validators as a table
  public function errors(){
    $errors = array();
    foreach($this->validators as $validator){
        $errors = array_merge($errors, $this->{$validator}());
    }
    return $errors;
  }

  // Generic validator for string min/max lenght
  public static function validate_string_length($string, $minLength, $maxLength, $fieldName){
    $errors = array();
    if(strlen($string) < $minLength || strlen($string) > $maxLength){
      $errors[] = $fieldName . ' length must be between '. $minLength . '...' . $maxLength . ' characters!';
    }
    return $errors;
  }

  //============================================
  // VALIDATORS
  //============================================

  public function validate_name(){
    $name = $this->name;
    if($name == null || $name == ''){
      return array('Name cannot be empty!');
    }
    return self::validate_string_length($name, 3, 50, 'Name');
  }

  public function validate_description(){
    $description = $this->description;
    if(!is_null($description)){
      return self::validate_string_length($description, 0, 2000, 'Description');
    }
  }
  
  public function validate_description_short(){
    $description = $this->description;
    if(!is_null($description)){
      return self::validate_string_length($description, 0, 200, 'Description');
    }
  }

  public function validate_username(){
    $username = $this->username;
    if($username == null || $username == ''){
      return array('Username cannot be empty!');
    } elseif (!Human::usernameAvailable($username)){
      return array('Username is taken!');
    } else {
      return self::validate_string_length($username, 2, 20, 'Username');
    }
  }

  public function validate_fullname(){
    $fullname = $this->fullname;
    if($fullname == null || $fullname == ''){
      return array('Fullname cannot be empty!');
    } else {
      return self::validate_string_length($fullname, 1, 100, 'Fullname');
    }
  }

  public function validate_email(){
    $email = $this->email;
    if($email == null || $email == ''){
      return array('Email cannot be empty!');
    } elseif (!Human::emailAvailable($email)){
      return array('Email is taken!');
    } else {
      return self::validate_string_length($email, 3, 254, 'Email');
    }
  }

  public function validate_password(){
    $password = $this->password;
    if($password == null || $password == ''){
      return array('Password cannot be empty!');
    } else {
      return self::validate_string_length($password, 4, 255, 'Password');
    }
  }

  public function validate_color(){
    $color = $this->color;
    if(!in_array($color, self::VALID_COLORS)){
      return array('Invalid color!');
    }
  }

  public function validate_symbol(){
  $symbol = $this->symbol;
    if(!in_array($symbol, self::VALID_SYMBOLS)){
      return array('Invalid symbol!');
    }
  }
}