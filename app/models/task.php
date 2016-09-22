<?php

class Task extends BaseModel{
    public $id, $id_tasklist, $description, $duedate, $priority, $status;
    public function __construct($attributes){
        parent::__construct($attributes);
    }

    private static function rowToTask($row){
        $task = new Task(array(
            'id' => $row['id'],
            'id_tasklist' => $row['id_tasklist'],
            'description' => $row['description'],
            'duedate' => $row['duedate'],
            'priority' => $row['priority'],
            'status' => $row['status']
        ));
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

    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM task');
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
}
