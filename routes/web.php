<?php

use Core\Application;

$app = new Application();

$app::get('/','HomeController','test');
$app::get('/test','HomeController','test2');
$app::get('/test/{id}','HomeController','test3');
$app::get('/work/test/{id}','HomeController','work');

$app->run();