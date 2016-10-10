<?php

define('ROOT_PATH', __DIR__);
define('APPLICATION', '/application/');
define('APP_PATH', ROOT_PATH . APPLICATION);
require_once(__DIR__ . '/load.php');

$core = new \Core\Core();
$core->run();