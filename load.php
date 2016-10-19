<?php

if ( !defined('MVC_ENV') || MVC_ENV !== true )
{
  echo 'Stop';
  exit;
}

use helpers\ClassException as ClassException;

/**
 * Class autoloader
 */
spl_autoload_register(function ($class)
{
  $file_name = str_replace('\\', '/', $class). '.php';

//  echo APPLICATION . $file_name . "</br>";
  if( file_exists( APPLICATION . $file_name ) )
  {
    require_once( APPLICATION . $file_name );
  }
  else
  {
    throw new ClassException('File ' . APPLICATION . $file_name . ' is absent!');
  }

  /**
   * Validate on trait
   */
  if ( strpos( $class, 'trait' ) === false )
  {
    /**
     * Valid on exist class
     */
    if( !class_exists($class, false) )
    {
      throw new ClassException('Class ' . $class . ' is absent!');
    }
  }
});