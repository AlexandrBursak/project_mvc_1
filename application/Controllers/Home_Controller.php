<?php

namespace Controllers;
use Core\Base_Controller;

class Home_Controller extends Base_Controller {

  function index_Action( $args = null )
  {
      $id = $args[0];

      if ( !empty($args[2]) )
      {
        $this->set_layout($args[2]);
      }

      $this->set_data( [ 'id' => $id ] );

  }

}