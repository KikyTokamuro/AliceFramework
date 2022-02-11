<?php

require __DIR__ . '/vendor/autoload.php';

use AliceFramework\Core;

header('Content-Type: application/json');

// Get request and start
$core = new Core(file_get_contents('php://input'), 'мой информер');
echo $core->start();

