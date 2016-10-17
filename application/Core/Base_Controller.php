<?php

namespace Core;

use \Core\ClassException;
use helpers\Routing;
use helpers\GlobalData as GlobalData;


class Base_Controller {

  private $layout;
  private $data;

  private $model = null;
  private $view = null;

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
    if ( !isset($this->view) )
    {
      if ( empty( $name ) ) {
        $name = ucfirst( GlobalData::get( 'page' ) );
      }
      $name_view = 'Views\\' . $name . '_View';
      try {
        $view = new $name_view;
      } catch ( ClassException $e ) {
//       нужно создать систему логирования ошибок ))
      }

      if ( empty( $action ) ) {
        $action = ucfirst( GlobalData::get( 'action' ) );
      }
      if ( ! method_exists( $view, $action ) ) {
        header( 'Location: ' . GlobalData::get( 'rootFolder' ) );
      }

      $this->view = $view;

      $this->view->$action(  );
    }

  }

  function set_model( $name = null, $action = null )
  {
    if ( !isset( $this->model ) )
    {
      if ( empty( $name ) ) {
        $name = ucfirst( GlobalData::get( 'page' ) );
      }
      $name_model = 'Models\\' . $name . '_Model';
      try {
        $model = new $name_model;
      } catch ( ClassException $e ) {
        echo 'Can not create instance from model';
      }

      if ( empty( $action ) ) {
        $action = ucfirst( GlobalData::get( 'action' ) );
      }
      if ( ! method_exists( $model, $action ) ) {
        header( 'Location: ' . GlobalData::get( 'rootFolder' ) );
      }

      $this->model = $model;
      $this->model->$action(  );
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
   * @throws \Core\ClassException
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
   * @throws \Core\ClassException
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
   * @throws \Core\ClassException
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