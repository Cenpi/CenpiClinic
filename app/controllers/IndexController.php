<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->assets
        ->collection('headercss')
        ->addCss('libs/StarBoostrap/css/sb-admin.css');

        $this->assets
        ->collection('headerjs')	
        ->addJs('libs/StarBoostrap/js/sb-admin.js');
    }

}

