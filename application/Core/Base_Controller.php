<?php

namespace Core;

use helpers\ClassException;
use helpers\Routing;
use helpers\Loader;
use helpers\GlobalData;
use helpers\traits\MagicMethod;


class Base_Controller {
  use MagicMethod;

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
      if ( !empty($name) )
      {
        GlobalData::set( Routing::PAGE, $name );
      }
      $this->view = Loader::load_component( Loader::COMPONENT_VIEW );
      $name_method = Loader::load_method( $this->view, Loader::COMPONENT_VIEW );

      $this->view->$name_method( );
    }

  }

  function set_model( $name = null, $action = null )
  {
    if ( empty( $this->model ) )
    {
      if ( !empty($name) )
      {
        GlobalData::set( Routing::PAGE, $name );
      }
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

}