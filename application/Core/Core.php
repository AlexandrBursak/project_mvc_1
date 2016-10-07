<?php

namespace application\Core;

use application\helpers\Routing;

class Core
{

  function __construct()
  {

  }

  function run()
  {
    $route = new Routing();

    $name_controller = 'application\Controllers\\' . ucfirst( $route->getController() ) . '_Controller';
    try {
      $controller = new $name_controller;
    } catch ( ClassException $e ) {
//      echo '==============' . "<br>";
//      print_r( $e );
    }

    if ( !method_exists( $controller, $route->getAction() . '_Action' ) ) {
      header( 'Location: ' . $route->getRootFolder() );
    }
  }

}