<?php
class Tasklist extends BaseModel{
    public $id, $id_owner, $name, $description, $tasks;
    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_description_short');
    }

    private static function newFromParams($row){
        $tasklist = new Tasklist(array(
            'id'            => $row['id'],
            'id_owner'      => $row['id_owner'],
            'name'          => $row['name'],
            'description'   => $row['description']
            ));
        return $tasklist;
    }

    public static function find($id){
        $query = DB::connection()->prepare('
            SELECT * 
              FROM tasklist 
             WHERE id = :id 
             LIMIT 1');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute(); 
        $row = $query->fetch();

        if($row){
            return self::newFromParams($row);
        }
        return null;
    }

    public static function allByOwner($id_owner){
        $query = DB::connection()->prepare('
            SELECT * 
              FROM tasklist 
             WHERE id_owner = :id_owner');
        $query->bindValue(':id_owner', $id_owner, PDO::PARAM_INT);
        $query->execute();
        $rows = $query->fetchAll();

        $tasklists = array();
        foreach($rows as $row){
            $tasklists[]=self::newFromParams($row);
        }

        // Link all tasks in list
        foreach ($tasklists as $tasklist) {
            $tasklist->tasks = Task::allInTasklist($tasklist->id);
        }
        return $tasklists;
    }

    public function save(){
        $query = DB::connection()->prepare('
        INSERT INTO tasklist (id_owner, name, description) 
             VALUES (:id_owner, :name, :description) 
          RETURNING id');
        $query->bindValue(':id_owner',      $this->id_owner,    PDO::PARAM_INT);
        $query->bindValue(':name',          $this->name,        PDO::PARAM_STR);
        $query->bindValue(':description',   $this->description, PDO::PARAM_STR);
        $query->execute();

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update($id){
        $query = DB::connection()->prepare('
            UPDATE tasklist
               SET name         =:name, 
                   description  =:description, 
             WHERE id           =:id');
        $query->bindValue(':name',          $this->name,        PDO::PARAM_STR);
        $query->bindValue(':description',   $this->description, PDO::PARAM_STR);
        $query->execute();
    }

}
