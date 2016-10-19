<?php
namespace Core;
use helpers\GlobalData;
use helpers\traits\MagicMethod;

class Base_Model {
  use MagicMethod;

  function __construct() {
    $this->do_navigation();
  }

  function get_navigation()
  {
    $navigation = [
      [
        'title' => 'Home',
        'url'   => 'home/'
      ],
      [
        'title' => 'Contact',
        'url'   => 'contact/'
      ],
    ];
    foreach($navigation as &$nav)
    {
      $nav['active'] = ( explode( '/', $nav['url'] )[0] == GlobalData::get( 'page' ) ) ? 'active' : '';
    }
    return $navigation;
  }

  function do_navigation()
  {
    GlobalData::set( 'navigation', $this->get_navigation() );
  }

}