<?php
class TaskListController extends BaseController{

    public static function index(){
        $human = self::get_user_logged_in();
        if(!$human){
            Redirect::to('/login');
        }

        $myTaskLists = TaskList::allByOwner($human->id);
        View::make('tasklist.html', array(
            'myTaskLists'   => $myTaskLists));
    }

    public static function newList(){
        $human = self::get_user_logged_in();
        View::make('list/new.html');
    }

    public static function storeList(){
        $params = $_POST;
        $human = self::get_user_logged_in();
        $tasklist = new TaskList(array(
            'id_owner'      => $human->id,
            'name'          => $params['name'],
            'description'   => $params['description']));
        $tasklist->save();
        Redirect::to('/index', array('message' => 'List added!'));
    }

    public static function viewList(){
        $human = self::get_user_logged_in();
        View::make('list/view.html');
    }
    
    public static function editList(){
        $human = self::get_user_logged_in();
        View::make('list/edit.html');
    }
    
    public static function removeList(){
        Redirect::to('/index', array('message' => 'NOTHING DONE!'));
    }
}