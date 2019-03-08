<?php

class SesionController extends ControllerBase
{

    public function indexAction()
    {
        $this->assets
        ->collection('headercss')
        ->addCss('css/login.css');
    }

    private function registerSession($usuario)
    {
        $this->session->set('auth', array(
            'id' => $usuario->idUsuario,
            'correo' => $usuario->correo,
            'rol' => $usuario->AdmPerfil->nombrePerfil
        ));
    }

    public function sesionAction()
    {

        if ($this->request->isPost()) {

               //Se reciben los datos ingresados por el usuario
               $correo = $this->request->getPost('email');
               $contrasena = $this->request->getPost('contrasena');
               $contrasena = sha1($contrasena);



               //Se busca el usuario en la base de datos
               $usuario = Usuario::findFirst(array(
                   "correo = :correo: AND contrasena = :contrasena:",
                   "bind" => array('correo' => $correo, 'contrasena' => $contrasena)
               ));

               if ($usuario != false) {

                    $usuario->estado = 1 ;
                    $usuario->save();
                   $this->registerSession($usuario);

                   $this->flash->success('Welcome ' . $usuario->correo);
                   //Redireccionar la ejecución si el usuario es valido
                   return $this->dispatcher->forward(array(
                       'controller' => 'index',
                       'action' => 'index'

                   ));

               };

               $this->flash->error('Correo/contrasena incorrectos');


                //Redireccionar al login nuevamente
                    return $this->dispatcher->forward(array(
                   'controller' => 'sesion',
                   'action' => 'index'
           ));

        }

    }


    public function logoutAction(){
    	$this->session->remove('auth');
    	return $this->dispatcher->forward(
    			array(
    					'controller' => 'sesion',
    					'action'     => 'index'
    			)
    		);

    }
}
