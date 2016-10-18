<?php

define('ROOT_PATH', __DIR__ . '/');
define('APPLICATION', 'application/');
define('APP_PATH', ROOT_PATH . APPLICATION);
require_once(__DIR__ . '/load.php');

//echo '<pre>';
//print_r($_SERVER);
//echo '</pre>';

$core = new \Core\Core();
$core->run();