<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class AdmPerfilController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for adm_perfil
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'AdmPerfil', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "idPerfil";

        $adm_perfil = AdmPerfil::find($parameters);
        if (count($adm_perfil) == 0) {
            $this->flash->notice("The search did not find any adm_perfil");

            $this->dispatcher->forward([
                "controller" => "adm_perfil",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $adm_perfil,
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
     * Edits a adm_perfil
     *
     * @param string $idPerfil
     */
    public function editAction($idPerfil)
    {
        if (!$this->request->isPost()) {

            $adm_perfil = AdmPerfil::findFirstByidPerfil($idPerfil);
            if (!$adm_perfil) {
                $this->flash->error("adm_perfil was not found");

                $this->dispatcher->forward([
                    'controller' => "adm_perfil",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->idPerfil = $adm_perfil->idPerfil;

            $this->tag->setDefault("idPerfil", $adm_perfil->idPerfil);
            $this->tag->setDefault("nombrePerfil", $adm_perfil->nombrePerfil);
            $this->tag->setDefault("descPerfil", $adm_perfil->descPerfil);
            
        }
    }

    /**
     * Creates a new adm_perfil
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "adm_perfil",
                'action' => 'index'
            ]);

            return;
        }

        $adm_perfil = new AdmPerfil();
        $adm_perfil->nombrePerfil = $this->request->getPost("nombrePerfil");
        $adm_perfil->descPerfil = $this->request->getPost("descPerfil");
        

        if (!$adm_perfil->save()) {
            foreach ($adm_perfil->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "adm_perfil",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("adm_perfil was created successfully");

        $this->dispatcher->forward([
            'controller' => "adm_perfil",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a adm_perfil edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "adm_perfil",
                'action' => 'index'
            ]);

            return;
        }

        $idPerfil = $this->request->getPost("idPerfil");
        $adm_perfil = AdmPerfil::findFirstByidPerfil($idPerfil);

        if (!$adm_perfil) {
            $this->flash->error("adm_perfil does not exist " . $idPerfil);

            $this->dispatcher->forward([
                'controller' => "adm_perfil",
                'action' => 'index'
            ]);

            return;
        }

        $adm_perfil->nombrePerfil = $this->request->getPost("nombrePerfil");
        $adm_perfil->descPerfil = $this->request->getPost("descPerfil");
        

        if (!$adm_perfil->save()) {

            foreach ($adm_perfil->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "adm_perfil",
                'action' => 'edit',
                'params' => [$adm_perfil->idPerfil]
            ]);

            return;
        }

        $this->flash->success("adm_perfil was updated successfully");

        $this->dispatcher->forward([
            'controller' => "adm_perfil",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a adm_perfil
     *
     * @param string $idPerfil
     */
    public function deleteAction($idPerfil)
    {
        $adm_perfil = AdmPerfil::findFirstByidPerfil($idPerfil);
        if (!$adm_perfil) {
            $this->flash->error("adm_perfil was not found");

            $this->dispatcher->forward([
                'controller' => "adm_perfil",
                'action' => 'index'
            ]);

            return;
        }

        if (!$adm_perfil->delete()) {

            foreach ($adm_perfil->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "adm_perfil",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("adm_perfil was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "adm_perfil",
            'action' => "index"
        ]);
    }

}
