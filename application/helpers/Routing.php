<?php

namespace helpers;
use \helpers\GlobalData as GlobalData;

class Routing {

//  private $url;
//  private $uriPath;
//  private $controller;
//  private $action;
//  private $data = null;
//  private $rootFolder;

  function __construct()
  {
    $this->url = $_SERVER['REQUEST_URI'];
    $this->cutRootDirectory();
    $this->parseURL();
//    var_dump( GlobalData::data() );
  }

  function parseURL()
  {
    $arr = explode('/', trim( GlobalData::get( 'uriPath' ), '/' ), 3 );

    $page = 'Home';
    if ( !empty( $arr[0] ) )
    {
      $page = $arr[0];
    }
    GlobalData::set( 'page', $page );

    $action = "index";
    if ( isset( $arr[1] ) )
    {
      $action = $arr[1];
    }
    GlobalData::set( 'action', $action );

    if ( is_array( $arr ) && isset( $arr[2] ) )
    {
      $arr_args = explode('/', trim( $arr[2], '/' ) );
      GlobalData::set( 'data', $arr_args );
    }

  }

  function cutRootDirectory()
  {
    $current_project = pathinfo($_SERVER['PHP_SELF']);
    GlobalData::set( 'rootFolder', $current_project['dirname'] );
    GlobalData::set( 'uriPath', str_replace($current_project['dirname'],'',$this->url) );
  }

}