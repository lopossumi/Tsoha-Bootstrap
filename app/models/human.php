<?php

class Human extends BaseModel{
    public $id, $username, $fullname, $password, $email, $isprivate, $isadmin;
    public function __construct($attributes){
        parent::__construct($attributes);
    }

    private static function rowToHuman($row){
        $human = new Human(array(
            'id' => $row['id'],
            'username' => $row['username'],
            'fullname' => $row['fullname'],
            'password' => $row['password'],
            'email' => $row['email'],
            'isprivate' => $row['isprivate'],
            'isadmin' => $row['isadmin']
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

}
