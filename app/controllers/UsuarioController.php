<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class UsuarioController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
        $this->dispatcher->forward([
            "controller" => "usuario",
            "action" => "search"
        ]);

        return;
    }

  /**
     * Searches for usuario
     */
    public function searchAction()
    {
        
        $numberPage = 1;
        
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Usuario', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "idUsuario";

        $usuario = Usuario::find($parameters);
        if (count($usuario) == 0) {
            $this->flash->notice("The search did not find any usuario");

            $this->dispatcher->forward([
                "controller" => "usuario",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $usuario,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a usuario
     *
     * @param string $idUsuario
     */
    public function editAction($idUsuario)
    {
        if (!$this->request->isPost()) {

            $usuario = Usuario::findFirstByidUsuario($idUsuario);
            if (!$usuario) {
                $this->flash->error("usuario was not found");

                $this->dispatcher->forward([
                    'controller' => "usuario",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->idUsuario = $usuario->idUsuario;

            $this->tag->setDefault("idUsuario", $usuario->idUsuario);
            $this->tag->setDefault("tipoDocumento", $usuario->tipoDocumento);
            $this->tag->setDefault("documento", $usuario->documento);
            $this->tag->setDefault("primerNombre", $usuario->primerNombre);
            $this->tag->setDefault("segundoNombre", $usuario->segundoNombre);
            $this->tag->setDefault("primerApellido", $usuario->primerApellido);
            $this->tag->setDefault("segundoApellido", $usuario->segundoApellido);
            $this->tag->setDefault("direccion", $usuario->direccion);
            $this->tag->setDefault("genero", $usuario->genero);
            $this->tag->setDefault("correo", $usuario->correo);
            $this->tag->setDefault("telefono", $usuario->telefono);
            $this->tag->setDefault("contrasena", $usuario->contrasena);
            $this->tag->setDefault("fechaNacimiento", $usuario->fechaNacimiento);
            $this->tag->setDefault("estado", $usuario->estado);
            $this->tag->setDefault("perfil", $usuario->perfil);
            $this->tag->setDefault("fechaCreacion", $usuario->fechaCreacion);
            
        }
    }

    /**
     * Creates a new usuario
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "usuario",
                'action' => 'index'
            ]);

            return;
        }
  
        $usuario = new Usuario();
        $usuario->tipoDocumento = $this->request->getPost("tipoDocumento");
        $usuario->documento = $this->request->getPost("documento");
        $usuario->primerNombre = $this->request->getPost("primerNombre");
        $usuario->segundoNombre = $this->request->getPost("segundoNombre");
        $usuario->primerApellido = $this->request->getPost("primerApellido");
        $usuario->segundoApellido = $this->request->getPost("segundoApellido");
        $usuario->direccion = $this->request->getPost("direccion");
        $usuario->genero = $this->request->getPost("genero");
        $usuario->correo = $this->request->getPost("correo");
        $usuario->telefono = $this->request->getPost("telefono");
        $usuario->contrasena = sha1($this->request->getPost("contrasena"));
        $usuario->fechaNacimiento = $this->request->getPost("fechaNacimiento");
        $usuario->estado = 2;
        $usuario->perfil = $this->request->getPost("perfil");
        $usuario->fechaCreacion = date('Y-m-d H:m:i');   
       
        if (!$usuario->save()) {
            
            $this->flash->error("Error al guardar el usuario.");
            

            $this->dispatcher->forward([
                'controller' => "usuario",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("Usuario creado correctamente");

        $this->dispatcher->forward([
            'controller' => "usuario",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a usuario edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "usuario",
                'action' => 'index'
            ]);

            return;
        }

        $idUsuario = $this->request->getPost("idUsuario");
        $usuario = Usuario::findFirstByidUsuario($idUsuario);

        if (!$usuario) {
            $this->flash->error("usuario does not exist " . $idUsuario);

            $this->dispatcher->forward([
                'controller' => "usuario",
                'action' => 'index'
            ]);

            return;
        }

        $usuario->tipoDocumento = $this->request->getPost("tipoDocumento");
        $usuario->documento = $this->request->getPost("documento");
        $usuario->primerNombre = $this->request->getPost("primerNombre");
        $usuario->segundoNombre = $this->request->getPost("segundoNombre");
        $usuario->primerApellido = $this->request->getPost("primerApellido");
        $usuario->segundoApellido = $this->request->getPost("segundoApellido");
        $usuario->direccion = $this->request->getPost("direccion");
        $usuario->genero = $this->request->getPost("genero");
        $usuario->correo = $this->request->getPost("correo");
        $usuario->telefono = $this->request->getPost("telefono");
        $usuario->contrasena = $this->request->getPost("contrasena");
        $usuario->fechaNacimiento = $this->request->getPost("fechaNacimiento");
        $usuario->estado = $this->request->getPost("estado");
        $usuario->perfil = $this->request->getPost("perfil");
        $usuario->fechaCreacion = $this->request->getPost("fechaCreacion");
        

        if (!$usuario->save()) {

            foreach ($usuario->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "usuario",
                'action' => 'edit',
                'params' => [$usuario->idUsuario]
            ]);

            return;
        }

        $this->flash->success("Usuario editado correctamente");

        $this->dispatcher->forward([
            'controller' => "usuario",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a usuario
     *
     * @param string $idUsuario
     */
    public function deleteAction($idUsuario)
    {
        $usuario = Usuario::findFirstByidUsuario($idUsuario);
        if (!$usuario) {
            $this->flash->error("usuario was not found");

            $this->dispatcher->forward([
                'controller' => "usuario",
                'action' => 'index'
            ]);

            return;
        }

        if (!$usuario->delete()) {

            foreach ($usuario->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "usuario",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("Usuario eliminado correctamente");

        $this->dispatcher->forward([
            'controller' => "usuario",
            'action' => "index"
        ]);
    }

}
