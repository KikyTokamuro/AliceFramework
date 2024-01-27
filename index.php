<?php

require __DIR__ . '/vendor/autoload.php';

header('Content-Type: application/json');

// Get request and start app
echo (new AliceFramework\App(file_get_contents('php://input'), 'Моя автоматизация'))->start();
