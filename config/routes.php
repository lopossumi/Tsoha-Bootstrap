<?php

//LoginController
$routes->get('/login',          function(){ LoginController::login();});
$routes->post('/login',         function(){ LoginController::handle_login();});

//TaskListController
$routes->get('/',               function(){ TaskListController::index();});
$routes->get('/index',          function(){ TaskListController::index();});
$routes->get('/newtask',        function(){ TaskListController::newtask();});
$routes->post('/newtask',       function(){ TaskListController::store();});

$routes->get('/task/:id/edit',      function($id){ TaskListController::edit($id);});
$routes->post('/task/:id/edit',     function($id){ TaskListController::update($id);});
$routes->post('/task/:id/destroy',  function($id){ TaskListController::destroy($id);});
$routes->post('/task/:id/start',    function($id){ TaskListController::start($id);});
$routes->post('/task/:id/complete', function($id){ TaskListController::complete($id);});