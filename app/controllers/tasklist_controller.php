<?php
class TaskListController extends BaseController{
    public static function index(){
        //testing with spede
        $human = self::get_user_logged_in();

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
            'duedate'       => $params['duedate'],
            'priority'      => $params['priority'],
            'status'        => '0'));
        $task->categories = $params['categories'];
        $task->save();
        Redirect::to('/index', array('message' => 'Task added!'));
        //Kint::dump($params);
    }

    public static function newTask(){
        $human = self::get_user_logged_in();
        View::make('task/new.html', array(
            'myTaskLists'   => TaskList::all($human->id),
            'myCategories'  => Category::allByOwner($human->id)));
    }

    public static function edit($id){
        $human = self::get_user_logged_in();
        $task = Task::find($id);
        View::make('task/edit.html', array(
            'myTaskLists'   => TaskList::all($human->id),
            'myCategories'  => Category::allByOwner($human->id),
            'myTask'        => $task));
    }

    public static function update($id){
        $params = $_POST;
        Kint::dump($params);
    }

    public function destroy($id){
        Task::destroy($id);
        Redirect::to('/index', array('message' => 'Task removed!'));
    }
}
