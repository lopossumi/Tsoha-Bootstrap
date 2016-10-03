<?php
class TaskListController extends BaseController{
    public static function index(){
        //testing with spede
        $human = self::get_user_logged_in();

        if(!$human){
            Redirect::to('/login');
        }

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
        $task->save();

        // Add categories to junction table
        if(isset ($params['categories'])){
            foreach($params['categories'] as $id_category){
                Category::insert($task->id, $id_category);
            }
        }
        Redirect::to('/index', array('message' => 'Task added!'));
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
        $task = new Task(array(
            'description'   => $params['description'],
            'id_tasklist'   => $params['id_tasklist'],
            'duedate'       => $params['duedate'],
            'priority'      => $params['priority'],
            'status'        => '0'));
        $task->update($id);

        // Add categories to junction table
        if(isset ($params['categories'])){
            foreach($params['categories'] as $id_category){
                Category::insert($task->id, $id_category);
            }
        }
        Redirect::to('/index', array('message' => 'Task updated!'));
    }

    public function destroy($id){
        Task::destroy($id);
        Redirect::to('/index', array('message' => 'Task removed!'));
    }
}
