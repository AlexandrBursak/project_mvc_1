<?php

namespace Controllers;
use Core\Base_Controller;
use helpers\GlobalData;

class Home_Controller extends Base_Controller {

  function index( $args = null )
  {

    GlobalData::view();
//    $this->set_model( 'contact', 'index' );
//    $this->set_view( 'contact', 'index' );
  }

}