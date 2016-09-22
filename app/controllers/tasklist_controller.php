<?php
class TaskListController extends BaseController{
    public static function index(){
        $tasks = Task::all();
        View::make('tasklist.html', array('tasks' => $tasks));
    }
}
