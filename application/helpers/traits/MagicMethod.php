<?php

namespace helpers\traits;
use helpers\ClassException;

trait MagicMethod
{
  /**
   * @param $property
   * @param $value
   *
   * @throws \helpers\ClassException
   */
  function __set( $property, $value )
  {
    if ( property_exists( $this, $property ) )
    {
      $this->$property = $value;
    }
    else
    {
      throw new ClassException( 'Property ' . $property . ' is absent' );
    }
  }

  /**
   * @param $property
   *
   * @return mixed
   * @throws \helpers\ClassException
   */
  function __get( $property )
  {
    if ( property_exists( $this, $property ) )
    {
      return $this->$property;
    }
    else
    {
      throw new ClassException( 'Property ' . $property . ' is absent' );
    }
  }

  /**
   * @param $method
   * @param $values
   *
   * @return mixed
   * @throws \helpers\ClassException
   */
  function __call( $method, $values )
  {
    if ( strpos( $method, 'get' ) === 0 )
    {
      $method_orr = str_replace( 'get_', '', $method );
      return $this->$method_orr;
    }
    else if ( strpos( $method, 'set' ) === 0 )
    {
      $method_orr = str_replace( 'set_', '', $method );
      $this->$method_orr = $values[0];
    }
    else if ( method_exists( $this, $method ) )
    {
      $this->$method( $values );
    }
    else
    {
      throw new ClassException( 'Method ' . $method . ' is absent' );
    }
  }
}