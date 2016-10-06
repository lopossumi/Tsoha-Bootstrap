<?php
class TaskList extends BaseModel{
    public $id, $id_owner, $name, $description, $tasks;
    public function __construct($attributes){
        parent::__construct($attributes);
    }

    private static function rowToTaskList($row){
        $tasklist = new TaskList(array(
            'id'            => $row['id'],
            'id_owner'      => $row['id_owner'],
            'name'          => $row['name'],
            'description'   => $row['description']
            ));
        return $tasklist;
    }

    public static function allByOwner($id_owner){
        $query = DB::connection()->prepare('SELECT * FROM tasklist WHERE id_owner = :id_owner');
        $query->bindValue(':id_owner', $id_owner, PDO::PARAM_INT);
        $query->execute();
        $rows = $query->fetchAll();

        $taskLists = array();
        foreach($rows as $row){
            $taskLists[]=self::rowToTaskList($row);
        }

        // Link all tasks in list
        foreach ($taskLists as $taskList) {
            $taskList->tasks = Task::allInTaskList($taskList->id);
        }
        return $taskLists;
    }

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO tasklist (id_owner, name, description) 
            VALUES (:id_owner, :name, :description) RETURNING id');
        $query->bindValue(':id_owner',      $this->id_owner,    PDO::PARAM_INT);
        $query->bindValue(':name',          $this->name,        PDO::PARAM_STR);
        $query->bindValue(':description',   $this->description, PDO::PARAM_STR);
        $query->execute();

        $row = $query->fetch();
        $this->id = $row['id'];
    }
}
