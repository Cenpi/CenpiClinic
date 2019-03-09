<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class PacienteRangoSalarialController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for paciente_rango_salarial
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'PacienteRangoSalarial', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "idRangoSalarial";

        $paciente_rango_salarial = PacienteRangoSalarial::find($parameters);
        if (count($paciente_rango_salarial) == 0) {
            $this->flash->notice("The search did not find any paciente_rango_salarial");

            $this->dispatcher->forward([
                "controller" => "paciente_rango_salarial",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $paciente_rango_salarial,
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
     * Edits a paciente_rango_salarial
     *
     * @param string $idRangoSalarial
     */
    public function editAction($idRangoSalarial)
    {
        if (!$this->request->isPost()) {

            $paciente_rango_salarial = PacienteRangoSalarial::findFirstByidRangoSalarial($idRangoSalarial);
            if (!$paciente_rango_salarial) {
                $this->flash->error("paciente_rango_salarial was not found");

                $this->dispatcher->forward([
                    'controller' => "paciente_rango_salarial",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->idRangoSalarial = $paciente_rango_salarial->idRangoSalarial;

            $this->tag->setDefault("idRangoSalarial", $paciente_rango_salarial->idRangoSalarial);
            $this->tag->setDefault("nombreRangoSalarial", $paciente_rango_salarial->nombreRangoSalarial);
            $this->tag->setDefault("porcentaje", $paciente_rango_salarial->porcentaje);
            
        }
    }

    /**
     * Creates a new paciente_rango_salarial
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "paciente_rango_salarial",
                'action' => 'index'
            ]);

            return;
        }

        $paciente_rango_salarial = new PacienteRangoSalarial();
        $paciente_rango_salarial->nombreRangoSalarial = $this->request->getPost("nombreRangoSalarial");
        $paciente_rango_salarial->porcentaje = $this->request->getPost("porcentaje");
        

        if (!$paciente_rango_salarial->save()) {
            foreach ($paciente_rango_salarial->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "paciente_rango_salarial",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("paciente_rango_salarial was created successfully");

        $this->dispatcher->forward([
            'controller' => "paciente_rango_salarial",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a paciente_rango_salarial edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "paciente_rango_salarial",
                'action' => 'index'
            ]);

            return;
        }

        $idRangoSalarial = $this->request->getPost("idRangoSalarial");
        $paciente_rango_salarial = PacienteRangoSalarial::findFirstByidRangoSalarial($idRangoSalarial);

        if (!$paciente_rango_salarial) {
            $this->flash->error("paciente_rango_salarial does not exist " . $idRangoSalarial);

            $this->dispatcher->forward([
                'controller' => "paciente_rango_salarial",
                'action' => 'index'
            ]);

            return;
        }

        $paciente_rango_salarial->nombreRangoSalarial = $this->request->getPost("nombreRangoSalarial");
        $paciente_rango_salarial->porcentaje = $this->request->getPost("porcentaje");
        

        if (!$paciente_rango_salarial->save()) {

            foreach ($paciente_rango_salarial->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "paciente_rango_salarial",
                'action' => 'edit',
                'params' => [$paciente_rango_salarial->idRangoSalarial]
            ]);

            return;
        }

        $this->flash->success("paciente_rango_salarial was updated successfully");

        $this->dispatcher->forward([
            'controller' => "paciente_rango_salarial",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a paciente_rango_salarial
     *
     * @param string $idRangoSalarial
     */
    public function deleteAction($idRangoSalarial)
    {
        $paciente_rango_salarial = PacienteRangoSalarial::findFirstByidRangoSalarial($idRangoSalarial);
        if (!$paciente_rango_salarial) {
            $this->flash->error("paciente_rango_salarial was not found");

            $this->dispatcher->forward([
                'controller' => "paciente_rango_salarial",
                'action' => 'index'
            ]);

            return;
        }

        if (!$paciente_rango_salarial->delete()) {

            foreach ($paciente_rango_salarial->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "paciente_rango_salarial",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("paciente_rango_salarial was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "paciente_rango_salarial",
            'action' => "index"
        ]);
    }

}
