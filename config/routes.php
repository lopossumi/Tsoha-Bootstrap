<?php

$routes->get('/', function() {
    HelloWorldController::index();
});
$routes->get('/home', function() {
    HelloWorldController::home();
});
$routes->get('/newtask', function() {
    HelloWorldController::newtask();
});
$routes->get('/sandbox', function() {
    HelloWorldController::sandbox();
});

