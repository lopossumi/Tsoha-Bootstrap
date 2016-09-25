<?php
class TaskListController extends BaseController{
    public static function index(){
        //testing with spede
        $human = Human::find(1);

        $myTaskLists = TaskList::all($human->id);
        
        $myTasks = Task::all($human->id);

        View::make('tasklist.html', array('myTasks' => $myTasks, 'myTaskLists' => $myTaskLists));
    }

    public static function store(){
        $params = $_POST;

        $task = new Task(array(
            'description' => $params['description'],
            'id_tasklist' => $params['id_tasklist'],
            //'duedate' => $params['duedate'],
            'priority' => $params['priority'],
            'status' => '0'
            ));
        $task->save();
        Redirect::to('/index', array('message' => 'Task added!'));
    }

    public static function newTask(){
        $human = Human::find(1);
        View::make('task/new.html', array('myTaskLists' => TaskList::all($human->id)));
    }
}
