<?php

namespace helpers;

class Loader {
  
  const COMPONENT_CONTROLLER = 'controller';
  const COMPONENT_MODEL = 'model';
  const COMPONENT_VIEW = 'view';

  const FOLDER_VIEWS = 'Views';
  const FOLDER_MODELS = 'Models';
  const FOLDER_CONTROLLER = 'Controllers';

  const ACTION_METHOD_EXTENSION = '';
  
  static public function load_component( $type )
  {
    $name_component = self::get_component( $type );
    try
    {
      $component = new $name_component;
    } catch ( ClassException $e ) {
      print_r ($e);
//       нужно создать систему логирования ошибок ))
    }
    return $component;
  }
  
  static public function load_method( $component, $type )
  {
    if ( ! method_exists( $component, self::get_method( $type ) ) ) {
      header( 'Location: ' . GlobalData::get( Routing::PROJECT_DIR ) );
    } else {
      $name_method = self::get_method( $type );
    }
    return $name_method;
  }
  
  static protected function get_component( $type )
  {
    switch ( $type ) 
    {
      case self::COMPONENT_VIEW:
        return self::FOLDER_VIEWS . '\\' . ucfirst( GlobalData::get( Routing::PAGE ) ) . '_View';
        break;
      case self::COMPONENT_MODEL:
        return self::FOLDER_MODELS . '\\' . ucfirst( GlobalData::get( Routing::PAGE ) ) . '_Model';
        break;
      case self::COMPONENT_CONTROLLER:
        return self::FOLDER_CONTROLLER . '\\' . ucfirst( GlobalData::get( Routing::PAGE ) ) . '_Controller';
        break;
    }
  }
  
  static protected function get_method( $type )
  {
    switch ( $type )
    {
      case self::COMPONENT_VIEW:
        return GlobalData::get( Routing::ACTION ) . self::ACTION_METHOD_EXTENSION;
        break;
      case self::COMPONENT_MODEL:
        return GlobalData::get( Routing::ACTION ) . self::ACTION_METHOD_EXTENSION;
        break;
      case self::COMPONENT_CONTROLLER:
        return GlobalData::get( Routing::ACTION ) . self::ACTION_METHOD_EXTENSION;
        break;
    }
  }

}