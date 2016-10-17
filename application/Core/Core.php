<?php

namespace Core;
use helpers\GlobalData;
use helpers\Routing;
use Core\ClassException;

class Core {

  function __construct() {
    $route = new Routing();
  }

  function run() {
    $args = null;

    $name_controller = 'Controllers\\' . ucfirst( GlobalData::get( 'page' ) ) . '_Controller';
    try {
      $controller = new $name_controller;
    } catch ( ClassException $e ) {
//       нужно создать систему логирования ошибок ))
    }

    if ( ! method_exists( $controller, GlobalData::get( 'action' ) . '_Action' ) ) {
      header( 'Location: ' . GlobalData::get( 'rootFolder' ) );
    } else {
      $name_method_controller = GlobalData::get( 'action' ) . '_Action';
    }

    if ( GlobalData::get( 'data' ) ) {
      $args = GlobalData::get( 'data' );
    }

    /**
     * Run action in controller
     */
    $controller->$name_method_controller( $args );
    $controller->render( );


  }

}