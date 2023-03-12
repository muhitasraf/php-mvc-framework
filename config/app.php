<?php
define('APP_NAME', 'PHP MVC FRAMEWORK');
define('APP_ROOT', dirname(dirname(__FILE__)));
define('HOST_NAME',$_SERVER['HTTP_HOST']);
// $project_folder = str_replace('public','',dirname($_SERVER['SCRIPT_NAME']));
define('PROJECT_FOLDER',str_replace('public','',dirname($_SERVER['SCRIPT_NAME']));
define('URL','//'.HOST_NAME.$url_sub_folder.'/');