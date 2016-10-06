<?php

function checkLogin(){
    BaseController::check_logged_in();
}

//LoginController
$routes->get('/login',          					function(){ 	LoginController::login();});
$routes->post('/login',         					function(){ 	LoginController::handle_login();});
$routes->post('/logout',        					function(){ 	LoginController::logout();});

//TaskListController
$routes->get('/',                   'checkLogin', 	function(){ 	TaskListController::index();});
$routes->get('/index',              'checkLogin', 	function(){ 	TaskListController::index();});
$routes->get('/newlist',            'checkLogin', 	function(){ 	TaskListController::newList();});
$routes->post('/newlist',           'checkLogin', 	function(){ 	TaskListController::storeList();});

//TaskController
$routes->get('/newtask',            'checkLogin', 	function(){ 	TaskController::newTask();});
$routes->post('/newtask',           'checkLogin', 	function(){ 	TaskController::storeTask();});
$routes->get('/task/:id/edit',      'checkLogin', 	function($id){ 	TaskController::editTask($id);});
$routes->post('/task/:id/edit',     'checkLogin', 	function($id){ 	TaskController::updateTask($id);});
$routes->post('/task/:id/start',    'checkLogin', 	function($id){ 	TaskController::startTask($id);});
$routes->post('/task/:id/complete', 'checkLogin', 	function($id){ 	TaskController::completeTask($id);});
$routes->post('/task/:id/destroy',  'checkLogin', 	function($id){ 	TaskController::destroyTask($id);});

//CategoryController
$routes->get('/categories',         'checkLogin', 	function(){ 	CategoryController::categories();});
$routes->get('/newcategory',        'checkLogin', 	function(){ 	CategoryController::newCategory();});
$routes->post('/newcategory',	    'checkLogin', 	function(){ 	CategoryController::storeCategory();});
$routes->get('/category/:id/list',  'checkLogin', 	function($id){ 	CategoryController::listCategory($id);});