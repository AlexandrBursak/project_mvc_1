<?php

namespace Views;

use Core\Base_View;
use helpers\GlobalData;

class Contact_View extends Base_View {

  function index() {
    GlobalData::set( 'main_template', 'index_contact' );

    GlobalData::append( GlobalData::CONTENT_DATA, [
      'content' => 'Some form',
      'content_h1' => 'Contact Us'
    ] );
  }

}