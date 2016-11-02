<?php
namespace Views;
use Core\Base_View;
use helpers\GlobalData;
class About_View extends Base_View {
    function index() {
        GlobalData::set( 'main_template', 'index_about' );
        GlobalData::append( GlobalData::CONTENT_DATA, [
            'content' => 'Some paragraph',
            'content_h1' => 'About Us'
        ] );
    }
}