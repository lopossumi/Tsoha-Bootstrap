<?php
class TaskController extends BaseController{

    public static function newTask(){
        $human = self::get_user_logged_in();
        $myTasklists = Tasklist::allByOwner($human->id);

        // More than one task list; show normal view
        if(count($myTasklists) != 0){
        View::make('task/new.html', array(
            'myTasklists'   => $myTasklists,
            'myCategories'  => Category::allByOwner($human->id)));
        } else {
            Redirect::to('/newlist', array(
                'errors'   => array('Please create a task list first!')));
        }
    }

    public static function storeTask(){
        $human = self::get_user_logged_in();
        $params = $_POST;
        $attributes = array(
            'id_tasklist'   => $params['id_tasklist'],
            'name'          => $params['name'],
            'description'   => $params['description'],
            'duedate'       => $params['duedate'],
            'priority'      => $params['priority'],
            'status'        => '0');
        $task = new Task($attributes);
        $errors = $task->errors();

        if(count($errors) == 0){  
            $task->save();
            // Add categories to junction table
            if(isset ($params['categories'])){
                foreach($params['categories'] as $id_category){
                    Category::insert($task->id, $id_category);
                }
            }
            Redirect::to('/index', array('message' => 'Task added!'));

        } else {
            View::make('task/new.html', array(
                'errors' => $errors,
                'attributes' => $attributes,
                'myTasklists'   => Tasklist::allByOwner($human->id),
                'myCategories'  => Category::allByOwner($human->id)));
        }
    }

    public static function viewTask($id){
        $human = self::get_user_logged_in();
        $task = Task::find($id);

        if($task->checkOwner($human->id)){
            $Parsedown = new Parsedown();
            $myDescription = $Parsedown->text(htmlspecialchars($task->description));
            View::make('task/view.html', array(
                'myTasklist'        => Tasklist::find($task->id_tasklist),
                'myCategories'      => Category::allByOwner($human->id),
                'myTask'            => $task,
                'myTaskCategories'  => Category::idByTask($task->id),
                'myDescription'     => $myDescription));
        }
    }

    public static function editTask($id){
        $human = self::get_user_logged_in();
        $task = Task::find($id);
        
        if($task->checkOwner($human->id)){
            View::make('task/edit.html', array(
                'myTasklists'       => Tasklist::allByOwner($human->id),
                'myCategories'      => Category::allByOwner($human->id),
                'myTask'            => $task,
                'myTaskCategories'  => Category::idByTask($task->id)));
        }
    }

    public static function updateTask($id){
        $human = self::get_user_logged_in();
        $params = $_POST;
        $task = new Task(array(
            'id'            => $id,
            'id_tasklist'   => $params['id_tasklist'],
            'name'          => $params['name'],
            'description'   => $params['description'],
            'duedate'       => $params['duedate'],
            'priority'      => $params['priority'],
            'status'        => '0'));
        
        // User privilege check
        if($task->checkOwner($human->id)){
            $errors = $task->errors();
            if(count($errors) == 0){
                // Credentials and validation ok, update DB
                $task->update($id);

                // Clean existing categories and add updated to junction table
                Category::clean($id);
                if(isset ($params['categories'])){
                    foreach($params['categories'] as $id_category){
                        Category::insert($id, $id_category);
                    }
                }
                
                // Redirect to task details view
                Redirect::to('/task/' . $id . '/view', array(
                    'message' => 'Task updated!'));
            } else {
                // Credentials ok but errors in validation; show editor with error messages
                View::make('task/edit.html', array(
                    'myTasklists'       => Tasklist::allByOwner($human->id),
                    'myCategories'      => Category::allByOwner($human->id),
                    'myTask'            => $task,
                    'myTaskCategories'  => Category::idByTask($task->id),
                    'errors'            => $errors));
            }
        } else {
            //Credentials not ok; empty page
        }
    }

    public function startTask($id){
        $human = self::get_user_logged_in();        
        $task = Task::find($id);

        if($task->checkOwner($human->id)){
            $task->start();
            Redirect::to('/index', array(
                'message' => 'Task started!'));
        }
    }

    public function completeTask($id){
        $human = self::get_user_logged_in();        
        $task = Task::find($id);

        if($task->checkOwner($human->id)){
            $task->complete();
            Redirect::to('/index', array(
                'message' => 'Task completed!'));
        }
    }

    public function removeTask($id){
        $human = self::get_user_logged_in();        
        $task = Task::find($id);

        if($task->checkOwner($human->id)){
            $task->destroy();
            Redirect::to('/index', array(
                'message' => 'Task removed!'));
        }
    }

    public function archiveTask($id){
        $human = self::get_user_logged_in();        
        $task = Task::find($id);

        if($task->checkOwner($human->id)){
            $task->archive();
            Redirect::to('/index', array(
                'message' => 'Task archived!'));
        }
    }

    public function revertTask($id){
        $human = self::get_user_logged_in();        
        $task = Task::find($id);

        if($task->checkOwner($human->id)){
            $task->revert();
            Redirect::to('/archive', array(
                'message' => 'Task reverted!'));
        }
    }

    public function setPriority($id, $priority){
        $human = self::get_user_logged_in();        
        $task = Task::find($id);

        if($task->checkOwner($human->id)){
            $task->setPriority($priority);
            Redirect::to('/index', array(
                'message' => 'Task priority set!'));
        }
    }
}
