<?php
class CategoryController extends BaseController{

    public static function categories(){
        View::make('categories.html', array(
            'myCategories' => Category::allByOwner(self::get_user_logged_in()->id)));
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
            'name'          => $params['name'],
            'description'   => $params['description'],
            'color'         => $params['color'],
            'symbol'        => $params['symbol']));
        $category->save();

        Redirect::to('/categories', array('message' => 'Category added!'));
    }

    public static function listCategory($id){
        View::make('category/list.html', array(
            'myTasks'       => Task::activeByCategory($id),
            'myCategory'    => Category::find($id)));
    }

    public function removeCategory($id){
        Category::destroy($id);
        Redirect::to('/categories');
    }
}
