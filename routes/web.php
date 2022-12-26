<?php
$router->add(
    '',
  [
    'controller' => \App\Controllers\HomeController::class,
    'action' => 'index',
    'method' => 'GET'
  ]
);

$router->add(
    'login',
  [
    'controller' => \App\Controllers\AuthController::class,
    'action' => 'login',
    'method' => 'GET'
  ]
);

$router->add(
  'register',
  [
      'controller' => \App\Controllers\AuthController::class,
      'action' => 'register',
      'method' => 'GET'
  ]
);

$router->add(
  'auth/signup',
  [
      'controller' => \App\Controllers\AuthController::class,
      'action' => 'signup',
      'method' => 'POST'
  ]
);

$router->add(
  'auth/verify',
  [
      'controller' => \App\Controllers\AuthController::class,
      'action' => 'verify',
      'method' => 'POST'
  ]
);

$router->add(
  'admin/dashboard',
  [
      'controller' => \App\Controllers\Admin\DashboardController::class,
      'action' => 'index',
      'method' => 'GET'
  ]
);
