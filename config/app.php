<?php
define('APP_NAME', 'PHP MVC FRAMEWORK');
define('APP_ROOT', dirname(dirname(__FILE__)));
define('HOST_NAME',$_SERVER['HTTP_HOST']);
define('PROJECT_FOLDER',str_replace('public','',dirname($_SERVER['SCRIPT_NAME'])));
define('URL','//'.HOST_NAME.PROJECT_FOLDER);