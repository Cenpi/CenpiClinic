<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class AdmTipoDocumentoController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for adm_tipo_documento
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'AdmTipoDocumento', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "idTipoDocumento";

        $adm_tipo_documento = AdmTipoDocumento::find($parameters);
        if (count($adm_tipo_documento) == 0) {
            $this->flash->notice("The search did not find any adm_tipo_documento");

            $this->dispatcher->forward([
                "controller" => "adm_tipo_documento",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $adm_tipo_documento,
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
     * Edits a adm_tipo_documento
     *
     * @param string $idTipoDocumento
     */
    public function editAction($idTipoDocumento)
    {
        if (!$this->request->isPost()) {

            $adm_tipo_documento = AdmTipoDocumento::findFirstByidTipoDocumento($idTipoDocumento);
            if (!$adm_tipo_documento) {
                $this->flash->error("adm_tipo_documento was not found");

                $this->dispatcher->forward([
                    'controller' => "adm_tipo_documento",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->idTipoDocumento = $adm_tipo_documento->idTipoDocumento;

            $this->tag->setDefault("idTipoDocumento", $adm_tipo_documento->idTipoDocumento);
            $this->tag->setDefault("nombreTipoDocumento", $adm_tipo_documento->nombreTipoDocumento);
            $this->tag->setDefault("iniciales", $adm_tipo_documento->iniciales);
            
        }
    }

    /**
     * Creates a new adm_tipo_documento
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "adm_tipo_documento",
                'action' => 'index'
            ]);

            return;
        }

        $adm_tipo_documento = new AdmTipoDocumento();
        $adm_tipo_documento->nombreTipoDocumento = $this->request->getPost("nombreTipoDocumento");
        $adm_tipo_documento->iniciales = $this->request->getPost("iniciales");
        

        if (!$adm_tipo_documento->save()) {
            foreach ($adm_tipo_documento->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "adm_tipo_documento",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("adm_tipo_documento was created successfully");

        $this->dispatcher->forward([
            'controller' => "adm_tipo_documento",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a adm_tipo_documento edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "adm_tipo_documento",
                'action' => 'index'
            ]);

            return;
        }

        $idTipoDocumento = $this->request->getPost("idTipoDocumento");
        $adm_tipo_documento = AdmTipoDocumento::findFirstByidTipoDocumento($idTipoDocumento);

        if (!$adm_tipo_documento) {
            $this->flash->error("adm_tipo_documento does not exist " . $idTipoDocumento);

            $this->dispatcher->forward([
                'controller' => "adm_tipo_documento",
                'action' => 'index'
            ]);

            return;
        }

        $adm_tipo_documento->nombreTipoDocumento = $this->request->getPost("nombreTipoDocumento");
        $adm_tipo_documento->iniciales = $this->request->getPost("iniciales");
        

        if (!$adm_tipo_documento->save()) {

            foreach ($adm_tipo_documento->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "adm_tipo_documento",
                'action' => 'edit',
                'params' => [$adm_tipo_documento->idTipoDocumento]
            ]);

            return;
        }

        $this->flash->success("adm_tipo_documento was updated successfully");

        $this->dispatcher->forward([
            'controller' => "adm_tipo_documento",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a adm_tipo_documento
     *
     * @param string $idTipoDocumento
     */
    public function deleteAction($idTipoDocumento)
    {
        $adm_tipo_documento = AdmTipoDocumento::findFirstByidTipoDocumento($idTipoDocumento);
        if (!$adm_tipo_documento) {
            $this->flash->error("adm_tipo_documento was not found");

            $this->dispatcher->forward([
                'controller' => "adm_tipo_documento",
                'action' => 'index'
            ]);

            return;
        }

        if (!$adm_tipo_documento->delete()) {

            foreach ($adm_tipo_documento->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "adm_tipo_documento",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("adm_tipo_documento was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "adm_tipo_documento",
            'action' => "index"
        ]);
    }

}
