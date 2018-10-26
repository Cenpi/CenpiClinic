<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {

        $this->assets
        ->collection('headercss')
        ->addCss('vendor/bootstrap/css/bootstrap.min.css')
        ->addCss('vendor/metisMenu/metisMenu.min.css')
        ->addCss('dist/css/sb-admin-2.css')
        ->addCss('vendor/morrisjs/morris.css')
        ->addCss('vendor/font-awesome/css/font-awesome.min.css');
        
        $this->assets
        ->collection('headerjs')	
        ->addJs('vendor/jquery/jquery.min.js')
        ->addJs('vendor/bootstrap/js/bootstrap.min.js')
        ->addJs('vendor/metisMenu/metisMenu.min.js')
        ->addJs('vendor/raphael/raphael.min.js')
        ->addJs('vendor/morrisjs/morris.min.js')
        ->addJs('data/morris-data.js')
        ->addJs('dist/js/sb-admin-2.js');


    }
    
}
