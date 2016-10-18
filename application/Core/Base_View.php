<?php

namespace Core;
use helpers\GlobalData;


class Base_View {

  protected $data = [];
  protected $meta_data = [];

  private $content;

  const ROOT_FOLDER = APP_PATH;
  const TEMPLATE_FOLDER = '/templates';
  const COMPONENT_FOLDER = '/components';

  const TEMPLATE_EXTENSION = '.php';
  const DEFAULT_HEADER = 'header';
  const DEFAULT_FOOTER = 'footer';
  const DEFAULT_LAYOUT = 'layout';
  const DEFAULT_MAIN = 'index';
  
  const TEMPLATE_KEY = 'template';
  const COMPONENT_KEY = 'component';
  
  private static $default_parts = [ 'header', 'main', 'footer', 'layout' ];

  function __construct()
  {

  }

  function parse_layout()
  {
    $this->set_meta_date( GlobalData::get( GlobalData::META_DATA ) );
    $this->set_date( GlobalData::get( GlobalData::CONTENT_DATA ) );
    $this->parse_content();
    $this->show();
  }

  function parse_content()
  {

    $data = $this->get_data();
    $meta_data = $this->get_meta_data();
    $permalink = GlobalData::get( 'rootPath' );
    $navigation = GlobalData::get( 'navigation' );

    $content = [];
    foreach ( self::$default_parts as $key => $part )
    {
      ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS);

      $name_part = 'get_default_'.$part;
      require_once( $this->$name_part() );
      $content[$part] = ob_get_contents();

      ob_end_clean();

    }

    $this->set_content( $content['layout'] );

  }
  
  private function get_full_path( $deep=null )
  {
    switch( $deep ) {
      case self::COMPONENT_KEY:
        return $this->get_full_path( self::TEMPLATE_KEY ) . self::COMPONENT_FOLDER;
        break;
      case self::TEMPLATE_KEY:
      default:
        return self::ROOT_FOLDER . self::TEMPLATE_FOLDER;
    }
  }

  function get_default_header()
  {
      return $this->get_full_path( self::COMPONENT_KEY ) . '/' . self::DEFAULT_HEADER . self::TEMPLATE_EXTENSION;
  }

  function get_default_footer()
  {
    return $this->get_full_path( self::COMPONENT_KEY ) . '/' . self::DEFAULT_FOOTER . self::TEMPLATE_EXTENSION;
  }

  function get_default_layout()
  {
    return $this->get_full_path( self::COMPONENT_KEY ) . '/' . self::DEFAULT_LAYOUT . self::TEMPLATE_EXTENSION;
  }

  function get_default_main()
  {
    $template = GlobalData::get( 'template' ) ?: self::DEFAULT_MAIN;
    return $this->get_full_path( self::TEMPLATE_KEY ) . '/' . $template . self::TEMPLATE_EXTENSION;
  }

  function set_content($attr)
  {
    $this->content = $attr;
  }

  function get_content()
  {
    return $this->content;
  }

  function set_date( $data )
  {
    $this->data = $data;
  }

  function get_data()
  {
    return $this->data;
  }

  function set_meta_date( $data )
  {
    $this->meta_data = $data;
  }

  function get_meta_data()
  {
    return $this->meta_data;
  }

  function show()
  {
    echo $this->get_content();
  }

}