<?php

class Task extends BaseModel{
    public $id, $id_tasklist, $description, $duedate, $priority, $status, $categories;
    public function __construct($attributes){
        parent::__construct($attributes);
    }

    private static function rowToTask($row){
        $task = new Task(array(
            'id'            => $row['id'],
            'id_tasklist'   => $row['id_tasklist'],
            'description'   => $row['description'],
            'duedate'       => $row['duedate'],
            'priority'      => $row['priority'],
            'status'        => $row['status']
        ));
        $task->categories = Category::allByTask($row['id']);
        return $task;
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM task WHERE id = :id LIMIT 1');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute(); 
        $row = $query->fetch();

        if($row){
            return self::rowToTask($row);
        }
        return null;
    }

    public static function all($id_owner){
        $query = DB::connection()->prepare('SELECT * FROM Task WHERE id_tasklist IN (SELECT id FROM TaskList WHERE id_owner = :id_owner)');
        $query->bindValue(':id_owner', $id_owner, PDO::PARAM_INT);
        $query->execute();
        $rows = $query->fetchAll();

        $tasks = array();
        foreach($rows as $row){
            $tasks[]=self::rowToTask($row);
        }
        return $tasks;
    }

    public static function allInTasklist($id_tasklist){
        $query = DB::connection()->prepare('SELECT * FROM task WHERE id_tasklist = :id_tasklist');
        $query->bindValue(':id_tasklist', $id_tasklist, PDO::PARAM_INT);
        $query->execute();
        $rows = $query->fetchAll();

        $tasks = array();
        foreach($rows as $row){
            $tasks[]=self::rowToTask($row);
        }
        return $tasks;
    }

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Task (id_tasklist, description, priority, status) 
            VALUES (:id_tasklist, :description, :priority, :status) RETURNING id');
        $query->bindValue(':id_tasklist',   $this->id_tasklist, PDO::PARAM_STR);
        $query->bindValue(':description',   $this->description, PDO::PARAM_STR);
        //$query->bindValue(':duedate',       $this->duedate,     PDO::PARAM_DATE); check PDO
        $query->bindValue(':priority',      $this->priority,    PDO::PARAM_INT);
        $query->bindValue(':status',        $this->status,      PDO::PARAM_INT);
        $query->execute();

        $row = $query->fetch();
        $this->id = $row['id'];

        // tallenna liitostauluun kategoriat
        foreach ($this->categories as $id_category) {
            Category::insert($this->id, $id_category);
        }
    }
}
