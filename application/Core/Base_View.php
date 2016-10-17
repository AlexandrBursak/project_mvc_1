<?php

namespace Core;


class Base_View {

  protected $data = [];

  private $content;

  private $default_header = APP_PATH.'templates/components/header.php';
  private $default_footer = APP_PATH.'templates/components/footer.php';
  private $default_layout = APP_PATH.'templates/components/layout.php';
  private $default_main = APP_PATH.'templates/index.php';

  function __construct()
  {

  }

  function parse_layout()
  {
    $this->concat_content();
    $this->show();
  }

  function concat_content()
  {

    $data = $this->get_data();

    $content = [];
    foreach ( ['header', 'main', 'footer', 'layout'] as $key => $part )
    {
      ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS);

      $name_part = 'get_default_'.$part;
      require_once( $this->$name_part() );
      $content[$part] = ob_get_contents();

      ob_end_clean();

    }

    $this->set_content( $content['layout'] );

  }

  function get_default_header()
  {
      return $this->default_header;
  }

  function get_default_footer()
  {
      return $this->default_footer;
  }

  function get_default_layout()
  {
      return $this->default_layout;
  }

  function get_default_main()
  {
    return $this->default_main;
  }

  function set_content($attr)
  {
    $this->content = $attr;
  }

  function get_content()
  {
    return $this->content;
  }

  function set_date( $data )
  {
    $this->data = $data;
  }

  function get_data()
  {
    return $this->data;
  }

  function show()
  {
    echo $this->get_content();
  }

}