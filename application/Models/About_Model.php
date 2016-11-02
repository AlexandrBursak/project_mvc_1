<?php

namespace Models;
use Core\Base_Model;
use helpers\GlobalData as GlobalData;

class About_Model extends Base_Model
{
    function index( $data = null )
    {
        GlobalData::append( GlobalData::META_DATA, [
            'title' => 'About Roma Slobodeniuk',
        ] );
        GlobalData::set( GlobalData::TEMPLATE_HEADER, 'header_second' );

    }
}