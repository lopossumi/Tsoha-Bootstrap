<?php
class TaskListController extends BaseController{
    public static function index(){
        $human = self::get_user_logged_in();
        if(!$human){
            Redirect::to('/login');
        }

        $myTaskLists = TaskList::all($human->id);
        //$myTasks = Task::all($human->id);

        View::make('tasklist.html', array(
            //'myTasks'       => $myTasks, 
            'myTaskLists'   => $myTaskLists));
    }

    public static function categories(){
        $human = self::get_user_logged_in();
        if(!$human){
            Redirect::to('/login');
        }

        View::make('categorylist.html', array(
            'myCategories'  => Category::allByOwner($human->id)));
    }

    public static function storeTask(){
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

    public static function editTask($id){
        $human = self::get_user_logged_in();
        $task = Task::find($id);

        View::make('task/edit.html', array(
            'myTaskLists'       => TaskList::all($human->id),
            'myCategories'      => Category::allByOwner($human->id),
            'myTask'            => $task,
            'myTaskCategories'  => Category::idByTask($task->id)));
    }

    public static function updateTask($id){
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

    public function destroyTask($id){
        Task::destroy($id);
        Redirect::to('/index', array('message' => 'Task removed!'));
    }

    public function startTask($id){
        Task::start($id);
        Redirect::to('/index', array('message' => 'Task started!'));
    }

    public function completeTask($id){
        Task::complete($id);
        Redirect::to('/index', array('message' => 'Task finished!'));
    }

    public static function newCategory(){
        $human = self::get_user_logged_in();
        View::make('category/new.html', array(
            'myCategories'  => Category::allByOwner($human->id)));
    }

    public static function storeCategory(){
        $params = $_POST;
        $human = self::get_user_logged_in();
        $category = new Category(array(
            'id_owner'      => $human->id,
            'description'   => $params['description'],
            'color'         => $params['color'],
            'symbol'        => $params['symbol']));
        $category->save();

        Redirect::to('/categories', array('message' => 'Category added!'));
    }
}
