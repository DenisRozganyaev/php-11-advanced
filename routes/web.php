<?php

// /
// /login
// /dashboard

//$router->add('', [
//    'controller' => HomeController::class,
//    'action' => 'index',
//    'method' => 'GET'
//]);

// /parks - index
// /parks/4 - show
// /parks/4/edit - edit
// /parks/4/update - update

$router->add('parks/{id:\d+}/show', [
    'controller' => \App\Controllers\ParksController::class,
    'action' => 'show',
    'method' => 'GET'
]);

//$router->add('parks/{slug:\w+}/update', [
//    'controller' => ParksController::class,
//    'action' => 'update',
//    'method' => 'POST'
//]);

// /parks/create - create
// /parks/store - store
// /parks/4/destroy - delete
