<?php

namespace Core;
use helpers\Routing;
use helpers\Loader;
//use helpers\ClassException;
use helpers\GlobalData;

class Core {

  function __construct() {
    Routing::parse();
  }

  function run() {
    $args = null;

    $controller = Loader::load_component( Loader::COMPONENT_CONTROLLER );
    $name_method_controller = Loader::load_method( $controller, Loader::COMPONENT_CONTROLLER );

    if ( GlobalData::get( 'data' ) ) {
      $args = GlobalData::get( 'data' );
    }

    /**
     * Run action in controller
     */
    $controller->$name_method_controller( $args );
    /**
     * Render page
     */
    $controller->render( );


  }

}