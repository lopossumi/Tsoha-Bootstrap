<?php

//LoginController
$routes->get('/login',          function() { LoginController::login();          });
$routes->post('/login',         function() { LoginController::handle_login();   });

//TaskListController
$routes->get('/newtask',        function(){ TaskListController::newtask();      });
$routes->get('/index',          function(){ TaskListController::index();        });
$routes->post('/task',          function(){ TaskListController::store();        });

$routes->get('/task/:id/edit',  function($id){ TaskListController::edit($id);});
