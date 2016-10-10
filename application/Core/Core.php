<?php

namespace Core;

use helpers\Routing;

class Core {

  function __construct() {

  }

  function run() {
    $args = null;

    $route = new Routing();

    $name_controller = 'Controllers\\' . ucfirst( $route->getController() ) . '_Controller';
    try {
      $controller = new $name_controller;
    } catch ( \Exception $e ) {
//       нужно создать систему логирования ошибок ))
    }

    if ( ! method_exists( $controller, $route->getAction() . '_Action' ) ) {
      header( 'Location: ' . $route->getRootFolder() );
    } else {
      $name_method_controller = $route->getAction() . '_Action';
    }

    if ( $route->getData() ) {
      $args = $route->getData();
    }

    /**
     * Set default value for template name
     */
    $controller->set_layout( $route->getAction() );
    /**
     * Run action in controller
     */
    $controller->$name_method_controller( $args );
    $data = $controller->get_data();
    $layout_name = $controller->get_layout();


    $name_view = 'Views\\' . ucfirst( $route->getController() ) . '_View';
    try {
      $view = new $name_view;
    } catch ( \Exception $e ) {
//       нужно создать систему логирования ошибок ))
    }

    if ( ! method_exists( $view, $layout_name ) ) {
      header( 'Location: ' . $route->getRootFolder() );
    }
    /**
     * Run parse content in view
     */
    $view->$layout_name( $data );

    $view->show();

  }

}