<?php

class Category extends BaseModel{
    public $id, $id_owner, $description, $symbol;
    public function __construct($attributes){
        parent::__construct($attributes);
    }

    private static function rowToCategory($row){
        $category = new Category(array(
            'id'        	=> $row['id'],
            'id_owner'  	=> $row['id_owner'],
            'description'  	=> $row['description'],
            'symbol'  		=> $row['symbol']
        ));
        return $category;
    }

    public static function allByTask($id_task){
		$query = DB::connection()->prepare(
			'SELECT * FROM Category WHERE id IN (SELECT id_category FROM TaskCategory WHERE id_task = :id_task)');
        $query->bindValue(':id_task', $id_task, PDO::PARAM_INT);
        $query->execute();
        $rows = $query->fetchAll();
        
        $categories = array();
        foreach($rows as $row){
            $categories[]=self::rowToCategory($row);
        }
        return $categories;
    }

    public static function allByOwner($id_owner){
        $query = DB::connection()->prepare('SELECT * FROM category WHERE id_owner = :id_owner');
        $query->bindValue(':id_owner', $id_owner, PDO::PARAM_INT);

        $query->execute();
        $rows = $query->fetchAll();
        
        $categories = array();
        foreach($rows as $row){
            $categories[]=self::rowToCategory($row);
        }
        return $categories;
    }

    public static function insert($id_task, $id_category){
    	$query = DB::connection()->prepare('
    		SELECT * FROM TaskCategory 
    		WHERE id_task = :id_task AND id_category = :id_category 
    		LIMIT 1');
        $query->bindValue(':id_task', $id_task, PDO::PARAM_INT);
        $query->bindValue(':id_category', $id_category, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetchAll();

        if (!$row){
    		$query = DB::connection()->prepare('
    			INSERT INTO TaskCategory (id_task, id_category) VALUES (:id_task, :id_category)');
        		$query->bindValue(':id_task', $id_task, PDO::PARAM_INT);
        		$query->bindValue(':id_category', $id_category, PDO::PARAM_INT);
 		    	$query->execute();
        }
    }
}