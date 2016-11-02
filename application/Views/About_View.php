<?php

namespace Views;
use Core\Base_View;
use helpers\GlobalData;
use helpers\Routing;

class About_View extends Base_View
{
    function index() {
        GlobalData::set( 'main_template', 'index_about' );

        GlobalData::append( GlobalData::CONTENT_DATA, [
            'content' => "This is Roma's page \"About us\"",
            'content_h1' => 'About Us',
            'my_own_content' => ''
        ] );
    }

}