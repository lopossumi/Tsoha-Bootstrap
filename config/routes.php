<?php

function checkLogin(){
    BaseController::check_logged_in();
}

//LoginController
$routes->get('/login',          function(){ LoginController::login();});
$routes->post('/login',         function(){ LoginController::handle_login();});
$routes->post('/logout',        function(){ LoginController::logout();});

//TaskListController
$routes->get('/',                   'checkLogin', function(){ TaskListController::index();});
$routes->get('/index',              'checkLogin', function(){ TaskListController::index();});
$routes->get('/newtask',            'checkLogin', function(){ TaskListController::newTask();});
$routes->post('/newtask',           'checkLogin', function(){ TaskListController::storeTask();});
$routes->get('/task/:id/edit',      'checkLogin', function($id){ TaskListController::editTask($id);});
$routes->post('/task/:id/edit',     'checkLogin', function($id){ TaskListController::updateTask($id);});
$routes->post('/task/:id/destroy',  'checkLogin', function($id){ TaskListController::destroyTask($id);});
$routes->post('/task/:id/start',    'checkLogin', function($id){ TaskListController::startTask($id);});
$routes->post('/task/:id/complete', 'checkLogin', function($id){ TaskListController::completeTask($id);});

$routes->get('/categories',         'checkLogin', function(){ TaskListController::categories();});
$routes->get('/newcategory',        'checkLogin', function(){ TaskListController::newCategory();});
$routes->post('/newcategory',	    'checkLogin', function(){ TaskListController::storeCategory();});

$routes->get('/category/:id/list',  'checkLogin', function($id){ TaskListController::listCategory($id);});

$routes->get('/newlist',            'checkLogin', function(){ TaskListController::newList();});
$routes->post('/newlist',           'checkLogin', function(){ TaskListController::storeList();});
