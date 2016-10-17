<?php
namespace helpers;

class GlobalData {

  private static $data = [];

  public static function set ( $property, $value )
  {
    self::$data[$property] = $value;
  }

  public static function get ( $property )
  {
    if ( isset( self::$data[$property] ) )
    {
      return self::$data[ $property ];
    }
    else
    {
      return false;
    }
  }

  public static function __callStatic( $name, $arguments ) {

    return self::$data;

  }

}