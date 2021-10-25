<?php

ini_set('display_errors', '1');

include $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';

$app = new \framework\Application(new \framework\Components\Router\Router());
$app->run();