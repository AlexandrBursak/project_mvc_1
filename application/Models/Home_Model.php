<?php
namespace Models;
use \Core\Base_Model;
use helpers\GlobalData as GlobalData;


class Home_Model extends Base_Model
{
  function index( $data = null )
  {
    GlobalData::append( GlobalData::META_DATA, [ 
      'title' => 'Hello world!'
    ] );

    GlobalData::set( GlobalData::TEMPLATE_HEADER, 'header_second' );
  }
}