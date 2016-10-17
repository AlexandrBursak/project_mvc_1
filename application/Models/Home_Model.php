<?php
namespace Models;
use \Core\Base_Model;
use helpers\GlobalData as GlobalData;


class Home_Model extends Base_Model
{
  function index( $data = null )
  {
    GlobalData::set( 'site_data', [ 'title' => 'Hello world' ] );
  }
}