<?php

namespace helpers;

class Loader {
  
  const COMPONENT_CONTROLLER = 'controller';
  const COMPONENT_MODEL = 'model';
  const COMPONENT_VIEW = 'view';
  
  static public function load_component( $type )
  {
    $name_component = self::get_component( $type );
    try
    {
      $component = new $name_component;
    } catch ( ClassException $e ) {
//       нужно создать систему логирования ошибок ))
    }
    return $component;
  }
  
  static public function load_method( $component, $type )
  {
    if ( ! method_exists( $component, self::get_method( $type ) ) ) {
      header( 'Location: ' . GlobalData::get( 'rootFolder' ) );
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
        return 'Views\\' . ucfirst( GlobalData::get( 'page' ) ) . '_View';
        break;
      case self::COMPONENT_MODEL:
        return 'Models\\' . ucfirst( GlobalData::get( 'page' ) ) . '_Model';
        break;
      case self::COMPONENT_CONTROLLER:
        return 'Controllers\\' . ucfirst( GlobalData::get( 'page' ) ) . '_Controller';
        break;
    }
  }
  
  static protected function get_method( $type )
  {
    switch ( $type )
    {
      case self::COMPONENT_VIEW:
        return GlobalData::get( 'action' );
        break;
      case self::COMPONENT_MODEL:
        return GlobalData::get( 'action' );
        break;
      case self::COMPONENT_CONTROLLER:
        return GlobalData::get( 'action' ) . '_Action';
        break;
    }
  }

}