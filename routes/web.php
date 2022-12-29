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
    'logout',
  [
    'controller' => \App\Controllers\AuthController::class,
    'action' => 'logout',
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

// Admin Parks

$router->add(
    'admin/parks',
    [
        'controller' => \App\Controllers\Admin\ParksController::class,
        'action' => 'index',
        'method' => 'GET'
    ]
);

$router->add(
    'admin/parks/create',
    [
        'controller' => \App\Controllers\Admin\ParksController::class,
        'action' => 'create',
        'method' => 'GET'
    ]
);

$router->add(
    'admin/parks/store',
    [
        'controller' => \App\Controllers\Admin\ParksController::class,
        'action' => 'store',
        'method' => 'POST'
    ]
);

$router->add(
    'admin/parks/{id:\d+}/edit',
    [
        'controller' => \App\Controllers\Admin\ParksController::class,
        'action' => 'edit',
        'method' => 'GET'
    ]
);

$router->add(
    'admin/parks/{id:\d+}/update',
    [
        'controller' => \App\Controllers\Admin\ParksController::class,
        'action' => 'update',
        'method' => 'POST'
    ]
);

$router->add(
    'admin/parks/{id:\d+}/destroy',
    [
        'controller' => \App\Controllers\Admin\ParksController::class,
        'action' => 'destroy',
        'method' => 'GET'
    ]
);

