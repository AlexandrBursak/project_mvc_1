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
  const DEFAULT_HEADER = '/header.php';
  const DEFAULT_FOOTER = '/footer.php';
  const DEFAULT_LAYOUT = '/layout.php';
  const DEFAULT_MAIN = '/index.php';
  
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
    $this->concat_content();
    $this->show();
  }

  function concat_content()
  {

    $data = $this->get_data();
    $meta_data = $this->get_meta_data();

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
      return $this->get_full_path( self::COMPONENT_KEY )  . self::DEFAULT_HEADER;
  }

  function get_default_footer()
  {
    return $this->get_full_path( self::COMPONENT_KEY )  . self::DEFAULT_FOOTER;
  }

  function get_default_layout()
  {
    return $this->get_full_path( self::COMPONENT_KEY )  . self::DEFAULT_LAYOUT;
  }

  function get_default_main()
  {
    return $this->get_full_path( self::TEMPLATE_KEY )  . self::DEFAULT_MAIN;
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