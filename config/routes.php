<?php

//HelloworldController
$routes->get('/',               function() { HelloWorldController::index();     });
$routes->get('/home',           function() { HelloWorldController::home();      });
$routes->get('/sandbox',        function() { HelloWorldController::sandbox();   });

//TaskListController
$routes->get('/newtask',        function(){ TaskListController::newtask();      });
$routes->get('/index',          function(){ TaskListController::index();        });
$routes->post('/task',          function(){ TaskListController::store();        });