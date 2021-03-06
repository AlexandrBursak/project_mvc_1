<?php
namespace helpers;

class GlobalData {

  const META_DATA = 'meta_data';
  const CONTENT_DATA = 'content_data';

  const TEMPLATE_HEADER = 'path_header_template';

  private static $data = [];

  public function __construct()
  {
    throw new ClassException( 'Нельзя!!!!' );
  }

  /**
   * Set to global data any value
   *
   * @param $property
   * @param $value
   */
  public static function set( $property, $value )
  {
    self::$data[$property] = $value;
  }

  /**
   * Get any global values
   *
   * @param $property
   *
   * @return bool|mixed
   */
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

  /**
   * Add or change any values into data
   *
   * @param $property
   * @param $value
   */
  public static function append( $property, $value )
  {
    if ( isset( static::$data[ $property ] ) )
    {
      $value = array_merge( static::$data[$property], $value );
    }
    self::set( $property, $value );
  }

  public static function view()
  {
    echo '<h3>Config</h3>';
    dump( self::$data );
  }

}