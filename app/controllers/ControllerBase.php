<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {

        header('Content-Type: text/html; charset=utf-8');
        
        if($this->session->get('auth')){

       }else{            
            $actual_link = "$_SERVER[REQUEST_URI]";
        
            $server = "http://$_SERVER[HTTP_HOST]/";		
            
           
			if($server === "http://localhost/")
                $server = "http://localhost/CenpiClinic/sesion/";
                
            
            if($actual_link == "/CenpiClinic" || $actual_link == "/CenpiClinic/sesion" || $actual_link == "/CenpiClinic/sesion/"  || $actual_link == "/CenpiClinic/sesion/sesion"
              || $actual_link == "" || $actual_link == "/sesion" || $actual_link == "/sesion/sesion"){
            }else{
                header("Location: ".$server);
				die();
            }
				
        }

        $this->assets
        ->collection('headercss')
        ->addCss('libs/Bootstrap_4.1.3/css/bootstrap.min.css')
        ->addCss('libs/Fontawesome-free-5.4.2/css/all.min.css')
        ->addCss('libs/StarBoostrap/css/sb-admin.css');
        
        $this->assets
        ->collection('headerjs')	
        ->addJs('libs/Jquery/jquery.min.js')
        ->addJs('libs/Popper.js/popper.js')
        ->addJs('libs/Bootstrap_4.1.3/js/bootstrap.min.js')
        ->addJS('libs/Fontawesome-free-5.4.2/js/all.min.js')
        ->addJs('libs/StarBoostrap/js/sb-admin.js');
    }
    
}
