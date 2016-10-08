<?php

namespace Core;
use helpers\Routing;

class Core
{

  function __construct()
  {

  }

  function run()
  {
    $route = new Routing();

    $name_controller = 'Controllers\\' . ucfirst( $route->getController() ) . '_Controller';
    try {
      $controller = new $name_controller;
    } catch ( ClassException $e ) {
      // нужно создать систему логирования ошибок ))
    }

    if ( !method_exists( $controller, $route->getAction() . '_Action' ) ) {
      header( 'Location: ' . $route->getRootFolder() );
    }
  }

}