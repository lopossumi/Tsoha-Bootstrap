<?php
class CategoryController extends BaseController{

    public static function categories(){
        $human = self::get_user_logged_in();
        View::make('categories.html', array(
            'myCategories' => Category::allByOwner($human->id)));
    }

    public static function newCategory(){
        $human = self::get_user_logged_in();
        View::make('category/new.html', array(
            'myCategories'  => Category::allByOwner($human->id),
            'validColors'   => BaseModel::VALID_COLORS,
            'validSymbols'  => BaseModel::VALID_SYMBOLS));
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
        $human = self::get_user_logged_in();
        $myCategory = Category::find($id);
        
        if($myCategory->checkOwner($human->id)){
            View::make('category/view.html', array(
                'myTasks'       => Task::activeByCategory($id),
                'myCategory'    => $myCategory));
        }
    }

    public function removeCategory($id){
        $human = self::get_user_logged_in();
        $myCategory = Category::find($id);

        if($myCategory->checkOwner($human->id)){
            Category::destroy($id);
            Redirect::to('/categories');
        }
    }
}
