<?php

require __DIR__ . '/vendor/autoload.php';

echo (new AliceFramework\App(file_get_contents('php://input')))->start();
