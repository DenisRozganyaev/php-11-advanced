<?php

function url(string $path): string
{
    return SITE_URL . '/' . $path;
}

function currentLink(string $path): bool
{
    return trim($_SERVER['REQUEST_URI'], '/') === $path;
}

function redirect(string $path = '')
{
    header('Location: ' . SITE_URL . '/' . $path);
    exit;
}
