<?php

//LoginController
$routes->get('/',               function() { LoginController::login();     });

//TaskListController
$routes->get('/newtask',        function(){ TaskListController::newtask();      });
$routes->get('/index',          function(){ TaskListController::index();        });
$routes->post('/task',          function(){ TaskListController::store();        });