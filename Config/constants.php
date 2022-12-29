<?php

define('BASE_DIR', dirname(__DIR__));
define('SITE_URL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME']);

const ASSETS_URI = SITE_URL . '/assets/';
const VIEW_DIR = BASE_DIR . '/App/Views/';
