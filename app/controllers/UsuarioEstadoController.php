<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class UsuarioEstadoController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for usuario_estado
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'UsuarioEstado', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "idEstado";

        $usuario_estado = UsuarioEstado::find($parameters);
        if (count($usuario_estado) == 0) {
            $this->flash->notice("The search did not find any usuario_estado");

            $this->dispatcher->forward([
                "controller" => "usuario_estado",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $usuario_estado,
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
     * Edits a usuario_estado
     *
     * @param string $idEstado
     */
    public function editAction($idEstado)
    {
        if (!$this->request->isPost()) {

            $usuario_estado = UsuarioEstado::findFirstByidEstado($idEstado);
            if (!$usuario_estado) {
                $this->flash->error("usuario_estado was not found");

                $this->dispatcher->forward([
                    'controller' => "usuario_estado",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->idEstado = $usuario_estado->idEstado;

            $this->tag->setDefault("idEstado", $usuario_estado->idEstado);
            $this->tag->setDefault("nombreEstado", $usuario_estado->nombreEstado);
            $this->tag->setDefault("descEstado", $usuario_estado->descEstado);
            
        }
    }

    /**
     * Creates a new usuario_estado
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "usuario_estado",
                'action' => 'index'
            ]);

            return;
        }

        $usuario_estado = new UsuarioEstado();
        $usuario_estado->nombreEstado = $this->request->getPost("nombreEstado");
        $usuario_estado->descEstado = $this->request->getPost("descEstado");
        

        if (!$usuario_estado->save()) {
            foreach ($usuario_estado->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "usuario_estado",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("usuario_estado was created successfully");

        $this->dispatcher->forward([
            'controller' => "usuario_estado",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a usuario_estado edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "usuario_estado",
                'action' => 'index'
            ]);

            return;
        }

        $idEstado = $this->request->getPost("idEstado");
        $usuario_estado = UsuarioEstado::findFirstByidEstado($idEstado);

        if (!$usuario_estado) {
            $this->flash->error("usuario_estado does not exist " . $idEstado);

            $this->dispatcher->forward([
                'controller' => "usuario_estado",
                'action' => 'index'
            ]);

            return;
        }

        $usuario_estado->nombreEstado = $this->request->getPost("nombreEstado");
        $usuario_estado->descEstado = $this->request->getPost("descEstado");
        

        if (!$usuario_estado->save()) {

            foreach ($usuario_estado->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "usuario_estado",
                'action' => 'edit',
                'params' => [$usuario_estado->idEstado]
            ]);

            return;
        }

        $this->flash->success("usuario_estado was updated successfully");

        $this->dispatcher->forward([
            'controller' => "usuario_estado",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a usuario_estado
     *
     * @param string $idEstado
     */
    public function deleteAction($idEstado)
    {
        $usuario_estado = UsuarioEstado::findFirstByidEstado($idEstado);
        if (!$usuario_estado) {
            $this->flash->error("usuario_estado was not found");

            $this->dispatcher->forward([
                'controller' => "usuario_estado",
                'action' => 'index'
            ]);

            return;
        }

        if (!$usuario_estado->delete()) {

            foreach ($usuario_estado->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "usuario_estado",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("usuario_estado was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "usuario_estado",
            'action' => "index"
        ]);
    }

}
