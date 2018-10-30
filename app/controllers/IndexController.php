<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        //$this->assets
        //->collection('headercss')
        //->addCss('libs/StarBoostrap/css/sb-admin.css');

        $this->assets
        ->collection('headerjs')	
        ->addJs('libs/StarBoostrap/vendor/chart.js/Chart.min.js')
        ->addJs('libs/StarBoostrap/vendor/datatables/jquery.dataTables.js')
        ->addJs('libs/StarBoostrap/vendor/datatables/dataTables.bootstrap4.js')
        ->addJs('libs/StarBoostrap/js/demo/datatables-demo.js')
        ->addJs('libs/StarBoostrap/js/demo/chart-area-demo.js');
    }

}

