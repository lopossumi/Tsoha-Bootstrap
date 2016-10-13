<?php
class Human extends BaseModel{
    public $id, $username, $fullname, $password, $email, $isprivate, $isadmin;
    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_username', 'validate_fullname', 'validate_email', 'validate_password');
    }

    private static function rowToHuman($row){
        $human = new Human(array(
            'id'        => $row['id'],
            'username'  => $row['username'],
            'fullname'  => $row['fullname'],
            'password'  => $row['password'],
            'email'     => $row['email'],
            'isprivate' => $row['isprivate'],
            'isadmin'   => $row['isadmin']
        ));
        return $human;
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM human WHERE id = :id LIMIT 1');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute(); 
        $row = $query->fetch();

        if($row){
            return self::rowToHuman($row);
        }
        return null;
    }

    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM human');
        $query->execute();
        $rows = $query->fetchAll();
        
        $humans = array();
        foreach($rows as $row){
            $humans[]=self::rowToHuman($row);
        }
        return $humans;
    }

    public static function authenticate($email, $password){
        $query = DB::connection()->prepare('SELECT * FROM human WHERE email = :email AND password = :password LIMIT 1');
        $query->bindValue(':email',     $email,     PDO::PARAM_STR);
        $query->bindValue(':password',  $password,  PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetch();

        if($row){
            return self::rowToHuman($row);
        }    
        return null;
    }

    public function save(){
        $query = DB::connection()->prepare('
            INSERT INTO human (username, fullname, email, password) 
                 VALUES (:username, :fullname, :email, :password)
              RETURNING id');
        $query->bindValue(':username',  $this->username,    PDO::PARAM_STR);
        $query->bindValue(':fullname',  $this->fullname,    PDO::PARAM_STR);
        $query->bindValue(':email',     $this->email,       PDO::PARAM_STR);
        $query->bindValue(':password',  $this->password,    PDO::PARAM_STR);
        $query->execute();

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public static function emailAvailable($email){
        $query = DB::connection()->prepare('
            SELECT * 
              FROM human
             WHERE email = :email 
             LIMIT 1');
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetch();

        if($row){
            return false;
        }else{
            return true;
        }
    }

    public static function usernameAvailable($username){
        $query = DB::connection()->prepare('
            SELECT * 
              FROM human
             WHERE username = :username 
             LIMIT 1');
        $query->bindValue(':username', $username, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetch();

        if($row){
            return false;
        }else{
            return true;
        }
    }
}