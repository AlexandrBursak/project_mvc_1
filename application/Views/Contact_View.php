<?php

namespace Views;

use Core\Base_View;
use helpers\GlobalData;
use helpers\Routing;

class Contact_View extends Base_View {

  function index() {
    GlobalData::set( 'main_template', 'index_contact' );

    GlobalData::append( GlobalData::CONTENT_DATA, [
      'content' => 'Some form',
      'content_h1' => 'Contact Us'
    ] );
  }

  function send( $args = null )
  {
    // go to index
//    print_r($_POST);
//    print_r($_GET);
//    exit;
//    echo GlobalData::get( Routing::PROJECT_DIR ) . '/contact';
    header( 'Location: ' . GlobalData::get( Routing::PROJECT_DIR ) . '/contact' );
  }

}