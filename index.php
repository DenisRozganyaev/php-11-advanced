<?php
require __DIR__ . '/output.php';

if ($_GET['stage']) {
    require __DIR__ . '/configs/stage.php';
}

echo 'test';
