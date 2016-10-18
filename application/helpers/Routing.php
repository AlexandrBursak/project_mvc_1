<?php

namespace helpers;

class Routing {

  static private $url;

  static function parse()
  {
    static::$url = $_SERVER['REQUEST_URI'];
    self::cutRootDirectory();
    self::setToGlobalRootPath();
    self::parseURL();
  }

  /**
   * Parse current URL
   *
   * example.com/page/action/another/data
   */
  static function parseURL()
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

  static function cutRootDirectory()
  {
    $current_project = pathinfo($_SERVER['PHP_SELF']);
    GlobalData::set( 'rootFolder', $current_project['dirname'] );
    GlobalData::set( 'uriPath', str_replace($current_project['dirname'],'',self::$url) );
  }

  static function setToGlobalRootPath()
  {
    $root_path = rtrim( '//' . $_SERVER['HTTP_HOST'] . GlobalData::get( 'rootFolder' ), '/' ) . '/';
    GlobalData::set( 'rootPath', $root_path );
  }

}