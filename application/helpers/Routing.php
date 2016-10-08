<?php

namespace helpers;

class Routing {

  private $url;
  private $uriPath;
  private $controller;
  private $action;
  private $data;
  private $rootFolder;

  function __construct()
  {
    $this->url = $_SERVER['REQUEST_URI'];
    $this->cutRootDirectory();
    $this->parseURL();
  }

  function parseURL()
  {
    $arr = explode('/', trim( $this->uriPath, '/' ) );

    $controller = 'Home';
    if ( !empty( $arr[0] ) )
    {
      $controller = $arr[0];
    }
    $this->setController( $controller );

    $action = "index";
    if ( isset( $arr[1] ) )
    {
      $action = $arr[1];
    }
    $this->setAction( $action );

    if ( isset( $arr[2] ) )
    {
      $this->setData( $arr[2] );
    }

  }

  function cutRootDirectory()
  {
    $current_project = pathinfo($_SERVER['PHP_SELF']);
    $this->rootFolder = $current_project['dirname'];
    $this->uriPath = str_replace($current_project['dirname'],'',$this->url);
  }

  function setController($attr)
  {
    $this->controller = $attr;
  }

  function getController()
  {
    return $this->controller;
  }

  function setAction($attr)
  {
    $this->action = $attr;
  }

  function getAction()
  {
    return $this->action;
  }

  function setData($attr)
  {
    $this->data = $attr;
  }

  function getData()
  {
    return $this->data;
  }

  function getRootFolder()
  {
    return $this->rootFolder;
  }

}