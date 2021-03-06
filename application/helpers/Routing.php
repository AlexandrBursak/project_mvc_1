<?php

namespace helpers;

class Routing {

  static private $url;
  const PROJECT_DIR = 'rootDir';
  const PROJECT_PATH = 'rootPath';
  const URI_PATH = 'uriPath';

  const PAGE = 'page';
  const ACTION = 'action';
  const DATA = 'data';

  const DEFAULT_PAGE = 'Home';
  const DEFAULT_ACTION = 'index';

  const DENIED_URI = [ 'index.php', 'load.php' ];

  static function parse()
  {
    $parts_link = explode( '?', $_SERVER['REQUEST_URI'] );
    static::$url = $parts_link[0];
    if ( isset($parts_link[1]) )
    {
      $get_data = $parts_link[1]; // this part we should parse additional
    }
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
    if ( in_array( trim( GlobalData::get( self::URI_PATH ) , '/' ), self::DENIED_URI ) )
    {
      header( 'Location: ' . GlobalData::get( self::PROJECT_DIR ) );
    }
    $arr = explode('/', trim( GlobalData::get( self::URI_PATH ), '/' ), 3 );

    $page = self::DEFAULT_PAGE;
    if ( !empty( $arr[0] ) )
    {
      $page = $arr[0];
    }
    GlobalData::set( self::PAGE, $page );

    $action = self::DEFAULT_ACTION;
    if ( isset( $arr[1] ) )
    {
      $action = $arr[1];
    }
    GlobalData::set( self::ACTION, $action );

    if ( is_array( $arr ) && isset( $arr[2] ) )
    {
      $arr_args = explode('/', trim( $arr[2], '/' ) );
      GlobalData::set( self::DATA, $arr_args );
    }

  }

  static function cutRootDirectory()
  {
    $project = pathinfo($_SERVER['PHP_SELF']);
    GlobalData::set( self::PROJECT_DIR, $project['dirname'] );
    GlobalData::set( self::URI_PATH, str_replace( $project['dirname'], '', self::$url ) );
  }

  static function setToGlobalRootPath()
  {
    $root_path = rtrim( '//' . $_SERVER['HTTP_HOST'] . GlobalData::get( self::PROJECT_DIR ), '/' ) . '/';
    GlobalData::set( self::PROJECT_PATH, $root_path );
  }

}