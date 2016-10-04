<?php

//LoginController
$routes->get('/login',          function(){ LoginController::login();});
$routes->post('/login',         function(){ LoginController::handle_login();});

//TaskListController
$routes->get('/',               function(){ TaskListController::index();});
$routes->get('/index',          function(){ TaskListController::index();});
$routes->get('/newtask',        function(){ TaskListController::newTask();});
$routes->post('/newtask',       function(){ TaskListController::storeTask();});

$routes->get('/task/:id/edit',      function($id){ TaskListController::editTask($id);});
$routes->post('/task/:id/edit',     function($id){ TaskListController::updateTask($id);});
$routes->post('/task/:id/destroy',  function($id){ TaskListController::destroyTask($id);});
$routes->post('/task/:id/start',    function($id){ TaskListController::startTask($id);});
$routes->post('/task/:id/complete', function($id){ TaskListController::completeTask($id);});

$routes->get('/categories',     function(){ TaskListController::categories();});
$routes->get('/newcategory',    function(){ TaskListController::newCategory();});
$routes->post('/newcategory',	function(){ TaskListController::storeCategory();});