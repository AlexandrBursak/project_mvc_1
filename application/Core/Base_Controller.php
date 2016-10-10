<?php

namespace Core;


class Base_Controller {

  private $layout;
  private $data;

  function __construct()
  {
//    echo 'Hello from our controller';
  }

  function render()
  {
    $data = $this->get_data();
    $layout = $this->get_layout();


  }

  function set_layout( $name )
  {
    $this->layout = $name;
  }

  function get_layout()
  {
    return $this->layout;
  }

  function set_data( $attr )
  {
    $this->data = $attr;
  }

  function get_data()
  {
    return $this->data;
  }

}