<?php

namespace Views;

use Core\Base_View;
use helpers\GlobalData;

class Home_View extends Base_View {

  function index() {
    GlobalData::append( GlobalData::CONTENT_DATA, [
      'content' => '<a href="#">Lorem ipsum!</a>'
    ] );
    GlobalData::append( GlobalData::CONTENT_DATA, [
      'content_h1' => 'Hello, world!'
    ] );
  }

}