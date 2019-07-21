<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class PacienteController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for paciente
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Paciente', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "idPaciente";

        $paciente = Paciente::find($parameters);
        if (count($paciente) == 0) {
            $this->flash->notice("The search did not find any paciente");

            $this->dispatcher->forward([
                "controller" => "paciente",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $paciente,
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
     * Edits a paciente
     *
     * @param string $idPaciente
     */
    public function editAction($idPaciente)
    {
        if (!$this->request->isPost()) {

            $paciente = Paciente::findFirstByidPaciente($idPaciente);
            if (!$paciente) {
                $this->flash->error("paciente was not found");

                $this->dispatcher->forward([
                    'controller' => "paciente",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->idPaciente = $paciente->idPaciente;

            $this->tag->setDefault("idPaciente", $paciente->idPaciente);
            $this->tag->setDefault("tipoDocumento", $paciente->tipoDocumento);
            $this->tag->setDefault("fechaNacimiento", $paciente->fechaNacimiento);
            $this->tag->setDefault("documento", $paciente->documento);
            $this->tag->setDefault("primerNombre", $paciente->primerNombre);
            $this->tag->setDefault("segundoNombre", $paciente->segundoNombre);
            $this->tag->setDefault("primerApellido", $paciente->primerApellido);
            $this->tag->setDefault("segundoApellido", $paciente->segundoApellido);
            $this->tag->setDefault("genero", $paciente->genero);
            $this->tag->setDefault("direccion", $paciente->direccion);
            $this->tag->setDefault("email", $paciente->email);
            $this->tag->setDefault("telefono", $paciente->telefono);
            $this->tag->setDefault("celular", $paciente->celular);
            $this->tag->setDefault("eps", $paciente->eps);
            $this->tag->setDefault("municipio", $paciente->municipio);
            $this->tag->setDefault("zona", $paciente->zona);
            $this->tag->setDefault("regimen", $paciente->regimen);
            $this->tag->setDefault("tipoAfiliacion", $paciente->tipoAfiliacion);
            $this->tag->setDefault("parentezco", $paciente->parentezco);
            $this->tag->setDefault("rangoSalarial", $paciente->rangoSalarial);
            $this->tag->setDefault("fechaIngreso", $paciente->fechaIngreso);
            
        }
    }

    /**
     * Creates a new paciente
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "paciente",
                'action' => 'index'
            ]);

            return;
        }

        $paciente = new Paciente();
        $paciente->tipoDocumento = $this->request->getPost("tipoDocumento");
        $paciente->fechaNacimiento = $this->request->getPost("fechaNacimiento");
        $paciente->documento = $this->request->getPost("documento");
        $paciente->primerNombre = $this->request->getPost("primerNombre");
        $paciente->segundoNombre = $this->request->getPost("segundoNombre");
        $paciente->primerApellido = $this->request->getPost("primerApellido");
        $paciente->segundoApellido = $this->request->getPost("segundoApellido");
        $paciente->genero = $this->request->getPost("genero");
        $paciente->direccion = $this->request->getPost("direccion");
        $paciente->email = $this->request->getPost("email", "email");
        $paciente->telefono = $this->request->getPost("telefono");
        $paciente->celular = $this->request->getPost("celular");
        $paciente->eps = $this->request->getPost("eps");
        $paciente->municipio = $this->request->getPost("municipio");
        $paciente->zona = $this->request->getPost("zona");
        $paciente->regimen = $this->request->getPost("regimen");
        $paciente->tipoAfiliacion = $this->request->getPost("tipoAfiliacion");
        $paciente->parentezco = $this->request->getPost("parentezco");
        $paciente->rangoSalarial = $this->request->getPost("rangoSalarial");
        $paciente->fechaIngreso = date('Y-m-d H:m:i'); 
        

        if (!$paciente->save()) {
            foreach ($paciente->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "paciente",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("paciente creado correctamente");

        $this->dispatcher->forward([
            'controller' => "paciente",
            'action' => 'search'
        ]);
    }

    /**
     * Saves a paciente edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "paciente",
                'action' => 'index'
            ]);

            return;
        }

        $idPaciente = $this->request->getPost("idPaciente");
        $paciente = Paciente::findFirstByidPaciente($idPaciente);

        if (!$paciente) {
            $this->flash->error("paciente does not exist " . $idPaciente);

            $this->dispatcher->forward([
                'controller' => "paciente",
                'action' => 'index'
            ]);

            return;
        }

        $paciente->tipoDocumento = $this->request->getPost("tipoDocumento");
        $paciente->fechaNacimiento = $this->request->getPost("fechaNacimiento");
        $paciente->documento = $this->request->getPost("documento");
        $paciente->primerNombre = $this->request->getPost("primerNombre");
        $paciente->segundoNombre = $this->request->getPost("segundoNombre");
        $paciente->primerApellido = $this->request->getPost("primerApellido");
        $paciente->segundoApellido = $this->request->getPost("segundoApellido");
        $paciente->genero = $this->request->getPost("genero");
        $paciente->direccion = $this->request->getPost("direccion");
        $paciente->email = $this->request->getPost("email", "email");
        $paciente->telefono = $this->request->getPost("telefono");
        $paciente->celular = $this->request->getPost("celular");
        $paciente->eps = $this->request->getPost("eps");
        $paciente->municipio = $this->request->getPost("municipio");
        $paciente->zona = $this->request->getPost("zona");
        $paciente->regimen = $this->request->getPost("regimen");
        $paciente->tipoAfiliacion = $this->request->getPost("tipoAfiliacion");
        $paciente->parentezco = $this->request->getPost("parentezco");
        $paciente->rangoSalarial = $this->request->getPost("rangoSalarial");
        $paciente->fechaIngreso = $this->request->getPost("fechaIngreso");
        

        if (!$paciente->save()) {

            foreach ($paciente->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "paciente",
                'action' => 'edit',
                'params' => [$paciente->idPaciente]
            ]);

            return;
        }

        $this->flash->success("paciente was updated successfully");

        $this->dispatcher->forward([
            'controller' => "paciente",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a paciente
     *
     * @param string $idPaciente
     */
    public function deleteAction($idPaciente)
    {
        $paciente = Paciente::findFirstByidPaciente($idPaciente);
        if (!$paciente) {
            $this->flash->error("paciente was not found");

            $this->dispatcher->forward([
                'controller' => "paciente",
                'action' => 'index'
            ]);

            return;
        }

        if (!$paciente->delete()) {

            foreach ($paciente->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "paciente",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("paciente was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "paciente",
            'action' => "index"
        ]);
    }

}
