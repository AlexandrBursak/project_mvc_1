<?php

namespace Core;

use helpers\ClassException;
use helpers\Routing;
use helpers\Loader;
use helpers\GlobalData;


class Base_Controller {

  private $model;
  private $view;

  function __construct() {
//    echo 'Hello from our controller';
  }

  function render()
  {
    $this->set_model();
    $this->set_view();

    $this->get_view()->parse_layout();
  }

  function prepare_data()
  {
  }

  function set_view( $name = null, $action = null )
  {
    if ( empty($this->view) )
    {
      $this->view = Loader::load_component( Loader::COMPONENT_VIEW );
      $name_method = Loader::load_method( $this->view, Loader::COMPONENT_VIEW );

      $this->view->$name_method( );
    }

  }

  function set_model( $name = null, $action = null )
  {
    if ( empty( $this->model ) )
    {
      $this->model = Loader::load_component( Loader::COMPONENT_MODEL );
      $name_method = Loader::load_method( $this->model, Loader::COMPONENT_MODEL );

      $this->model->$name_method( );
    }

  }

  function get_view()
  {
    return $this->view;
  }

  function get_model()
  {
    return $this->model;
  }


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