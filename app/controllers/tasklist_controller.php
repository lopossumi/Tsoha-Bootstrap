<?php
class TaskListController extends BaseController{
    public static function index(){
        //testing with spede
        $human = Human::find(1);

        $myTaskLists = TaskList::all($human->id);
        $myTasks = Task::all($human->id);

        View::make('tasklist.html', array(
            'myTasks'       => $myTasks, 
            'myTaskLists'   => $myTaskLists));
    }

    public static function store(){
        $params = $_POST;
        $task = new Task(array(
            'description'   => $params['description'],
            'id_tasklist'   => $params['id_tasklist'],
            //'duedate' => $params['duedate'],
            'priority'      => $params['priority'],
            'status'        => '0'));
        $task->categories = $params['categories'];
        $task->save();
        Redirect::to('/index', array('message' => 'Task added!'));
        //Kint::dump($params);
    }

    public static function newTask(){
        $human = Human::find(1);
        View::make('task/new.html', array(
            'myTaskLists'   => TaskList::all($human->id),
            'myCategories'  => Category::allByOwner($human->id)));
    }

    public static function edit($id){
        $human = Human::find(1);
        $task = Task::find($id);
        View::make('task/edit.html', array(
            'myTaskLists'   => TaskList::all($human->id),
            'myCategories'  => Category::allByOwner($human->id),
            'myTask'        => $task));
    }

    public function remove($id){
        Task::destroy($id);
        Redirect::to('/index', array('message' => 'Task removed!'));
    }
}
