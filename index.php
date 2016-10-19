<?php

$m0 = memory_get_usage();

define('MVC_ENV', true);
define('ROOT_PATH', __DIR__);
define('APPLICATION', 'application/');
define('APP_PATH', ROOT_PATH . '/' . APPLICATION);
require_once(__DIR__ . '/load.php');

$core = new \Core\Core();
$core->run();

$m1 = memory_get_usage();
printf("memory %d<br />", $m1 - $m0);