<?php

use Core\ClassException as ClassException;

/**
 * Class autoloader
 */
spl_autoload_register(function ($class)
{
  $file_name = str_replace('\\', '/', $class). '.php';

  if( file_exists('application/' . $file_name) )
  {
    require_once('application/' . $file_name);
  }
  else
  {
    throw new ClassException('Class is absent!');
  }
});