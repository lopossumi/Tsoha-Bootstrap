<?php
class TasklistController extends BaseController{

    public static function index(){
        $human = self::get_user_logged_in();
        if(!$human){
            Redirect::to('/login');
        }
        $myTasklists = Tasklist::allByOwner($human->id);
        View::make('tasklist.html', array(
            'myTasklists'   => $myTasklists));
    }

    public static function viewArchive(){
        $human = self::get_user_logged_in();
        if(!$human){
            Redirect::to('/login');
        }
        $myTasks = Task::archivedByOwner($human->id);
        View::make('archive.html', array(
            'myTasks'   => $myTasks));
    }

    public static function newList(){
        $human = self::get_user_logged_in();
        View::make('list/new.html');
    }

    public static function storeList(){
        $params = $_POST;
        $human = self::get_user_logged_in();
        $tasklist = new Tasklist(array(
            'id_owner'      => $human->id,
            'name'          => $params['name'],
            'description'   => $params['description']));
        $tasklist->save();
        Redirect::to('/index', array('message' => 'List added!'));
    }

    public static function viewList($id){
        $human = self::get_user_logged_in();
        $tasklist = Tasklist::find($id);
        View::make('list/view.html', array(
            'myTasklist'        => $tasklist));
    }
    
    public static function editList($id){
        $human = self::get_user_logged_in();
        $tasklist = Tasklist::find($id);
        View::make('list/edit.html', array(
            'myTasklist'        => $tasklist));
    }
    
    public static function removeList(){
        Redirect::to('/index', array('message' => 'NOTHING DONE!'));
    }
    
    public static function updateList($id){
        $params = $_POST;
        $tasklist = new Tasklist(array(
            'name'          => $params['name'],
            'description'   => $params['description']));
        $tasklist->update($id);

        Redirect::to('/index', array(
            'message' => 'Task list updated!'));
    }
}