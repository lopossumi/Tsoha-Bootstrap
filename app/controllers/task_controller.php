<?php
class TaskController extends BaseController{

    public static function newTask(){
        $human = self::get_user_logged_in();
        View::make('task/new.html', array(
            'myTaskLists'   => TaskList::allByOwner($human->id),
            'myCategories'  => Category::allByOwner($human->id)));
    }

    public static function storeTask(){
        $params = $_POST;
        $task = new Task(array(
            'id_tasklist'   => $params['id_tasklist'],
            'name'          => $params['name'],
            'description'   => $params['description'],
            'duedate'       => $params['duedate'],
            'priority'      => $params['priority'],
            'status'        => '0'));
        
        Kint::dump($task->errors());
        /*
        $task->save();

        // Add categories to junction table
        if(isset ($params['categories'])){
            foreach($params['categories'] as $id_category){
                Category::insert($task->id, $id_category);
            }
        }
        Redirect::to('/index', array('message' => 'Task added!'));
        */
    }

    public static function viewTask($id){
        $human = self::get_user_logged_in();
        $task = Task::find($id);
        View::make('task/view.html', array(
            'myTaskLists'       => TaskList::allByOwner($human->id),
            'myCategories'      => Category::allByOwner($human->id),
            'myTask'            => $task,
            'myTaskCategories'  => Category::idByTask($task->id)));
    }

    public static function editTask($id){
        $human = self::get_user_logged_in();
        $task = Task::find($id);
        View::make('task/edit.html', array(
            'myTaskLists'       => TaskList::allByOwner($human->id),
            'myCategories'      => Category::allByOwner($human->id),
            'myTask'            => $task,
            'myTaskCategories'  => Category::idByTask($task->id)));
    }

    public static function updateTask($id){
        $params = $_POST;
        $task = new Task(array(
            'id_tasklist'   => $params['id_tasklist'],
            'name'          => $params['name'],
            'description'   => $params['description'],
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
        Redirect::to('/index', array(
            'message' => 'Task updated!'));
    }

    public function startTask($id){
        Task::start($id);
        Redirect::to('/index', array(
            'message' => 'Task started!'));
    }

    public function completeTask($id){
        Task::complete($id);
        Redirect::to('/index', array(
            'message' => 'Task finished!'));
    }

    public function removeTask($id){
        Task::destroy($id);
        Redirect::to('/index', array(
            'message' => 'Task removed!'));
    }
}