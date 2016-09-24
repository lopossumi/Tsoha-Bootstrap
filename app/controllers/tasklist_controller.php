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
        $task = new Task;
    }    
}
