<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->assets
        ->collection('headercss')
        ->addCss('css/index/style.css')
        ->addCss('css/index/style.css');
    }

}

