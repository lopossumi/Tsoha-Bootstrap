<?php
class Category extends BaseModel{
    public $id, $id_owner, $name, $description, $symbol, $color;
    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_description_short');
    }

    private static function rowToCategory($row){
        $category = new Category(array(
            'id'        	=> $row['id'],
            'id_owner'  	=> $row['id_owner'],
            'name'          => $row['name'],
            'description'  	=> $row['description'],
            'symbol'  		=> $row['symbol'],
            'color'			=> $row['color']
        ));
        return $category;
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM category WHERE id = :id LIMIT 1');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute(); 
        $row = $query->fetch();

        if($row){
            return self::rowToCategory($row);
        }
        return null;
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

    public static function idByTask($id_task){
		$query = DB::connection()->prepare(
			'SELECT id_category FROM TaskCategory WHERE id_task = :id_task');
        $query->bindValue(':id_task', $id_task, PDO::PARAM_INT);
        $query->execute();
        $rows = $query->fetchAll();
        
        $taskCategory = array();
        foreach($rows as $row){
            $taskCategory[]=$row['id_category'];
        }
        return $taskCategory;
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

    public static function clean($id_task){
        $query = DB::connection()->prepare('
    		DELETE FROM taskcategory 
    		      WHERE id_task = :id_task');
        $query->bindValue(':id_task', $id_task, PDO::PARAM_INT);
        query->execute();
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

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Category (id_owner, name, description, color, symbol) 
            VALUES (:id_owner, :name, :description, :color, :symbol) RETURNING id');
        $query->bindValue(':id_owner',		$this->id_owner, 	PDO::PARAM_INT);
        $query->bindValue(':name',          $this->name,        PDO::PARAM_STR);
        $query->bindValue(':description',   $this->description, PDO::PARAM_STR);
        $query->bindValue(':color',   		$this->color, 		PDO::PARAM_STR);
        $query->bindValue(':symbol',      	$this->symbol,    	PDO::PARAM_STR);
        $query->execute();

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function destroy($id){
        $query = DB::connection()->prepare('DELETE FROM Category WHERE id = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }
}
