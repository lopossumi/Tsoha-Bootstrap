<?php

class TaskList extends BaseModel{
    public $id, $id_human, $name, $duedate, $priority, $status, $tasks;
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

    public static function all($id_owner){
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
