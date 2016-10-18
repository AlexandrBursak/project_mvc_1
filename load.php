<?php

use helpers\ClassException as ClassException;

/**
 * Class autoloader
 */
spl_autoload_register(function ($class)
{
  $file_name = str_replace('\\', '/', $class). '.php';

  if( file_exists( APPLICATION . $file_name ) )
  {
    require_once( APPLICATION . $file_name );
  }
  else
  {
    throw new ClassException('File ' . APPLICATION . $file_name . ' is absent!');
  }
  if( !class_exists($class, false) )
  {
    throw new ClassException('Class ' . $class . ' is absent!');
  }
});