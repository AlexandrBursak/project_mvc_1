<?php
namespace Models;
use Core\Base_Model;
use helpers\GlobalData as GlobalData;


class Contact_Model extends Base_Model
{
  function index( $data = null )
  {
    GlobalData::append( GlobalData::META_DATA, [ 
      'title' => 'Hello world'
    ] );
  }
}