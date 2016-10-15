<?php

function checkLogin(){
    BaseController::check_logged_in();
}

//LoginController
$routes->get('/login',                              function(){     LoginController::login();});
$routes->post('/login',                             function(){     LoginController::handleLogin();});
$routes->post('/logout',                            function(){     LoginController::logout();});
$routes->get('/signup',                             function(){     LoginController::newHuman();});
$routes->post('/signup',                            function(){     LoginController::storeHuman();});

//TasklistController
$routes->get('/',                   'checkLogin',   function(){     TasklistController::index();});
$routes->get('/index',              'checkLogin',   function(){     TasklistController::index();});
$routes->get('/archive',            'checkLogin',   function(){     TasklistController::viewArchive();});
$routes->get('/newlist',            'checkLogin',   function(){     TasklistController::newList();});
$routes->post('/newlist',           'checkLogin',   function(){     TasklistController::storeList();});
$routes->get('/lists',               'checkLogin',   function(){     TasklistController::tasklists();});
$routes->get('/list/:id/view',      'checkLogin',   function($id){  TasklistController::viewList($id);});
$routes->get('/list/:id/edit',      'checkLogin',   function($id){  TasklistController::editList($id);});
$routes->post('/list/:id/edit',     'checkLogin',   function($id){  TasklistController::updateList($id);});
$routes->post('/list/:id/remove',   'checkLogin',   function($id){  TasklistController::removeList($id);});

//TaskController
$routes->get('/newtask',            'checkLogin',   function(){     TaskController::newTask();});
$routes->post('/newtask',           'checkLogin',   function(){     TaskController::storeTask();});
$routes->get('/task/:id/view',      'checkLogin',   function($id){  TaskController::viewTask($id);});
$routes->get('/task/:id/edit',      'checkLogin',   function($id){  TaskController::editTask($id);});
$routes->post('/task/:id/edit',     'checkLogin',   function($id){  TaskController::updateTask($id);});
$routes->post('/task/:id/start',    'checkLogin',   function($id){  TaskController::startTask($id);});
$routes->post('/task/:id/complete', 'checkLogin',   function($id){  TaskController::completeTask($id);});
$routes->post('/task/:id/remove',   'checkLogin',   function($id){  TaskController::removeTask($id);});
$routes->post('/task/:id/archive',  'checkLogin',   function($id){  TaskController::archiveTask($id);});
$routes->post('/task/:id/revert',   'checkLogin',   function($id){  TaskController::revertTask($id);});
$routes->post(
    '/task/:id/setpriority/:priority', 
    'checkLogin', 
    function($id, $priority){TaskController::setPriority($id, $priority);});

//CategoryController
$routes->get('/categories',         'checkLogin',   function(){     CategoryController::categories();});
$routes->get('/newcategory',        'checkLogin',   function(){     CategoryController::newCategory();});
$routes->post('/newcategory',       'checkLogin',   function(){     CategoryController::storeCategory();});
$routes->get('/category/:id/edit',  'checkLogin',   function($id){  CategoryController::editCategory($id);});
$routes->post('/category/:id/edit', 'checkLogin',   function($id){  CategoryController::updateCategory($id);});
$routes->get('/category/:id/view',  'checkLogin',   function($id){  CategoryController::viewCategory($id);});
$routes->post('/category/:id/remove','checkLogin',  function($id){  CategoryController::removeCategory($id);});