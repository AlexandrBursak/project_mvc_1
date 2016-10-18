<?php
namespace helpers;

class GlobalData {

  const META_DATA = 'meta_data';
  const CONTENT_DATA = 'content_data';
  private static $data = [];

  public static function set( $property, $value )
  {
    self::$data[$property] = $value;
  }

  public static function get( $property )
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
  
  public static function append( $property, $value )
  {
    if ( isset( static::$data[ $property ] ) )
    {
      $value = array_merge( static::$data[$property], $value );
    }
    self::set( $property, $value );
  }

  public static function __callStatic( $name, $arguments ) 
  {
    return self::$data;
  }

  public static function view()
  {
    echo '<h3>Config</h3><pre><div>';
    print_r( self::$data );
    echo '</div></pre>';
  }

}