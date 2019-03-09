<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class AdmMunicipioController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for adm_municipio
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'AdmMunicipio', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "idMunicipio";

        $adm_municipio = AdmMunicipio::find($parameters);
        if (count($adm_municipio) == 0) {
            $this->flash->notice("The search did not find any adm_municipio");

            $this->dispatcher->forward([
                "controller" => "adm_municipio",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $adm_municipio,
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
     * Edits a adm_municipio
     *
     * @param string $idMunicipio
     */
    public function editAction($idMunicipio)
    {
        if (!$this->request->isPost()) {

            $adm_municipio = AdmMunicipio::findFirstByidMunicipio($idMunicipio);
            if (!$adm_municipio) {
                $this->flash->error("adm_municipio was not found");

                $this->dispatcher->forward([
                    'controller' => "adm_municipio",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->idMunicipio = $adm_municipio->idMunicipio;

            $this->tag->setDefault("idMunicipio", $adm_municipio->idMunicipio);
            $this->tag->setDefault("nombreMunicipio", $adm_municipio->nombreMunicipio);
            $this->tag->setDefault("provincia", $adm_municipio->provincia);
            
        }
    }

    /**
     * Creates a new adm_municipio
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "adm_municipio",
                'action' => 'index'
            ]);

            return;
        }

        $adm_municipio = new AdmMunicipio();
        $adm_municipio->nombreMunicipio = $this->request->getPost("nombreMunicipio");
        $adm_municipio->provincia = $this->request->getPost("provincia");
        

        if (!$adm_municipio->save()) {
            foreach ($adm_municipio->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "adm_municipio",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("adm_municipio was created successfully");

        $this->dispatcher->forward([
            'controller' => "adm_municipio",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a adm_municipio edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "adm_municipio",
                'action' => 'index'
            ]);

            return;
        }

        $idMunicipio = $this->request->getPost("idMunicipio");
        $adm_municipio = AdmMunicipio::findFirstByidMunicipio($idMunicipio);

        if (!$adm_municipio) {
            $this->flash->error("adm_municipio does not exist " . $idMunicipio);

            $this->dispatcher->forward([
                'controller' => "adm_municipio",
                'action' => 'index'
            ]);

            return;
        }

        $adm_municipio->nombreMunicipio = $this->request->getPost("nombreMunicipio");
        $adm_municipio->provincia = $this->request->getPost("provincia");
        

        if (!$adm_municipio->save()) {

            foreach ($adm_municipio->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "adm_municipio",
                'action' => 'edit',
                'params' => [$adm_municipio->idMunicipio]
            ]);

            return;
        }

        $this->flash->success("adm_municipio was updated successfully");

        $this->dispatcher->forward([
            'controller' => "adm_municipio",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a adm_municipio
     *
     * @param string $idMunicipio
     */
    public function deleteAction($idMunicipio)
    {
        $adm_municipio = AdmMunicipio::findFirstByidMunicipio($idMunicipio);
        if (!$adm_municipio) {
            $this->flash->error("adm_municipio was not found");

            $this->dispatcher->forward([
                'controller' => "adm_municipio",
                'action' => 'index'
            ]);

            return;
        }

        if (!$adm_municipio->delete()) {

            foreach ($adm_municipio->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "adm_municipio",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("adm_municipio was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "adm_municipio",
            'action' => "index"
        ]);
    }

}
