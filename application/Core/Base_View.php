<?php

namespace Core;
use helpers\GlobalData;
use helpers\ClassException;
use helpers\Routing;


class Base_View {

  protected $data = [];
  protected $meta_data = [];

  private $content;

  const ROOT_FOLDER = APP_PATH;
  const TEMPLATE_FOLDER = '/templates';
  const COMPONENT_FOLDER = '/components';

  const TEMPLATE_EXTENSION = '.php';
  const DEFAULT_HEADER = 'header'; // templates/component/header.php
  const DEFAULT_FOOTER = 'footer'; // templates/component/footer.php
  const DEFAULT_LAYOUT = 'layout'; // templates/component/layout.php
  const DEFAULT_MAIN = 'index'; // templates/index.php
  
  const TEMPLATE_KEY = 'template';
  const COMPONENT_KEY = 'component';
  
  private static $default_parts = [ 'header', 'footer', 'main', 'layout' ];

  function __construct()
  {

  }

  function parse_layout()
  {
    $this->set_meta_data( GlobalData::get( GlobalData::META_DATA ) );
    $this->set_data( GlobalData::get( GlobalData::CONTENT_DATA ) );
    $this->parse_content();
    $this->show();
  }

  function parse_content()
  {

    $data = $this->get_data();
    $meta_data = $this->get_meta_data();
    $permalink = GlobalData::get( Routing::PROJECT_PATH );
    $navigation = GlobalData::get( 'navigation' );

    $content = [];
    foreach ( self::$default_parts as $key => $part )
    {
      ob_start();
      $name_part = 'get_default_'.$part;
      require_once( $this->$name_part() );
      $content[$part] = ob_get_clean();
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
    $template = GlobalData::get( GlobalData::TEMPLATE_HEADER ) ?: self::DEFAULT_HEADER;
    return $this->get_full_path( self::COMPONENT_KEY ) . '/' . $template . self::TEMPLATE_EXTENSION;
  }

  function get_default_footer()
  {
    $template = GlobalData::get( 'footer_template' ) ?: self::DEFAULT_FOOTER;
    return $this->get_full_path( self::COMPONENT_KEY ) . '/' . $template . self::TEMPLATE_EXTENSION;
  }

  function get_default_layout()
  {
    $template = GlobalData::get( 'layout_template' ) ?: self::DEFAULT_LAYOUT;
    return $this->get_full_path( self::COMPONENT_KEY ) . '/' . $template . self::TEMPLATE_EXTENSION;
  }

  function get_default_main()
  {
    $template = GlobalData::get( 'main_template' ) ?: self::DEFAULT_MAIN;
    return $this->get_full_path( self::TEMPLATE_KEY ) . '/' . $template . self::TEMPLATE_EXTENSION;
  }


  function show()
  {
    echo $this->get_content();
  }

  /**
   * @param $property
   * @param $value
   *
   * @throws \helpers\ClassException
   */
  function __set( $property, $value )
  {
    if ( property_exists( __CLASS__, $property ) )
    {
      $this->$property = $value;
    }
    else
    {
      throw new ClassException( 'Property ' . $property . ' is absent' );
    }
  }

  /**
   * @param $property
   *
   * @return mixed
   * @throws \helpers\ClassException
   */
  function __get( $property )
  {
    if ( property_exists( $this, $property ) )
    {
      return $this->$property;
    }
    else
    {
      throw new ClassException( 'Property ' . $property . ' is absent' );
    }
  }

  /**
   * @param $method
   * @param $values
   *
   * @return mixed
   * @throws \helpers\ClassException
   */
  function __call( $method, $values )
  {
    if ( strpos( $method, 'get' ) === 0 )
    {
      $method_orr = str_replace( 'get_', '', $method );
      return $this->$method_orr;
    }
    else if ( strpos( $method, 'set' ) === 0 )
    {
      $method_orr = str_replace( 'set_', '', $method );
      $this->$method_orr = $values[0];
    }
    else if ( method_exists( $this, $method ) )
    {
      $this->$method( $values );
    }
    else
    {
      throw new ClassException( 'Method ' . $method . ' is absent' );
    }
  }

}