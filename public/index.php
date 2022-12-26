<?php

use Config\Config;

require_once dirname(__DIR__) . '/Config/constants.php';
require_once BASE_DIR . '/vendor/autoload.php';

if (!session_id()) {
    session_start();
}

$dotenv = \Dotenv\Dotenv::createUnsafeImmutable(BASE_DIR);
$dotenv->load();

try {
    $router = new \Core\Router();

    require_once BASE_DIR . '/routes/web.php';

    if (!preg_match('/assets/i', $_SERVER['REQUEST_URI'])) {
        $router->dispatch($_SERVER['REQUEST_URI']);
    }
} catch (PDOException $exception) {
    dd('PDOException', $exception->getMessage());
} catch (Exception $exception) {
    dd('Exception', $exception->getMessage());
}
