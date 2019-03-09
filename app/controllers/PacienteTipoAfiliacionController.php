<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class PacienteTipoAfiliacionController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for paciente_tipo_afiliacion
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'PacienteTipoAfiliacion', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "idTipoAfiliacion";

        $paciente_tipo_afiliacion = PacienteTipoAfiliacion::find($parameters);
        if (count($paciente_tipo_afiliacion) == 0) {
            $this->flash->notice("The search did not find any paciente_tipo_afiliacion");

            $this->dispatcher->forward([
                "controller" => "paciente_tipo_afiliacion",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $paciente_tipo_afiliacion,
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
     * Edits a paciente_tipo_afiliacion
     *
     * @param string $idTipoAfiliacion
     */
    public function editAction($idTipoAfiliacion)
    {
        if (!$this->request->isPost()) {

            $paciente_tipo_afiliacion = PacienteTipoAfiliacion::findFirstByidTipoAfiliacion($idTipoAfiliacion);
            if (!$paciente_tipo_afiliacion) {
                $this->flash->error("paciente_tipo_afiliacion was not found");

                $this->dispatcher->forward([
                    'controller' => "paciente_tipo_afiliacion",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->idTipoAfiliacion = $paciente_tipo_afiliacion->idTipoAfiliacion;

            $this->tag->setDefault("idTipoAfiliacion", $paciente_tipo_afiliacion->idTipoAfiliacion);
            $this->tag->setDefault("nombreTipoAfiliacion", $paciente_tipo_afiliacion->nombreTipoAfiliacion);
            
        }
    }

    /**
     * Creates a new paciente_tipo_afiliacion
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "paciente_tipo_afiliacion",
                'action' => 'index'
            ]);

            return;
        }

        $paciente_tipo_afiliacion = new PacienteTipoAfiliacion();
        $paciente_tipo_afiliacion->nombreTipoAfiliacion = $this->request->getPost("nombreTipoAfiliacion");
        

        if (!$paciente_tipo_afiliacion->save()) {
            foreach ($paciente_tipo_afiliacion->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "paciente_tipo_afiliacion",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("paciente_tipo_afiliacion was created successfully");

        $this->dispatcher->forward([
            'controller' => "paciente_tipo_afiliacion",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a paciente_tipo_afiliacion edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "paciente_tipo_afiliacion",
                'action' => 'index'
            ]);

            return;
        }

        $idTipoAfiliacion = $this->request->getPost("idTipoAfiliacion");
        $paciente_tipo_afiliacion = PacienteTipoAfiliacion::findFirstByidTipoAfiliacion($idTipoAfiliacion);

        if (!$paciente_tipo_afiliacion) {
            $this->flash->error("paciente_tipo_afiliacion does not exist " . $idTipoAfiliacion);

            $this->dispatcher->forward([
                'controller' => "paciente_tipo_afiliacion",
                'action' => 'index'
            ]);

            return;
        }

        $paciente_tipo_afiliacion->nombreTipoAfiliacion = $this->request->getPost("nombreTipoAfiliacion");
        

        if (!$paciente_tipo_afiliacion->save()) {

            foreach ($paciente_tipo_afiliacion->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "paciente_tipo_afiliacion",
                'action' => 'edit',
                'params' => [$paciente_tipo_afiliacion->idTipoAfiliacion]
            ]);

            return;
        }

        $this->flash->success("paciente_tipo_afiliacion was updated successfully");

        $this->dispatcher->forward([
            'controller' => "paciente_tipo_afiliacion",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a paciente_tipo_afiliacion
     *
     * @param string $idTipoAfiliacion
     */
    public function deleteAction($idTipoAfiliacion)
    {
        $paciente_tipo_afiliacion = PacienteTipoAfiliacion::findFirstByidTipoAfiliacion($idTipoAfiliacion);
        if (!$paciente_tipo_afiliacion) {
            $this->flash->error("paciente_tipo_afiliacion was not found");

            $this->dispatcher->forward([
                'controller' => "paciente_tipo_afiliacion",
                'action' => 'index'
            ]);

            return;
        }

        if (!$paciente_tipo_afiliacion->delete()) {

            foreach ($paciente_tipo_afiliacion->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "paciente_tipo_afiliacion",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("paciente_tipo_afiliacion was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "paciente_tipo_afiliacion",
            'action' => "index"
        ]);
    }

}
