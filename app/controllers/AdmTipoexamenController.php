<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class AdmTipoexamenController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for adm_tipoExamen
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'AdmTipoexamen', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "idTipoExamen";

        $adm_tipoExamen = AdmTipoexamen::find($parameters);
        if (count($adm_tipoExamen) == 0) {
            $this->flash->notice("The search did not find any adm_tipoExamen");

            $this->dispatcher->forward([
                "controller" => "adm_tipoExamen",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $adm_tipoExamen,
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
     * Edits a adm_tipoExamen
     *
     * @param string $idTipoExamen
     */
    public function editAction($idTipoExamen)
    {
        if (!$this->request->isPost()) {

            $adm_tipoExamen = AdmTipoexamen::findFirstByidTipoExamen($idTipoExamen);
            if (!$adm_tipoExamen) {
                $this->flash->error("adm_tipoExamen was not found");

                $this->dispatcher->forward([
                    'controller' => "adm_tipoExamen",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->idTipoExamen = $adm_tipoExamen->idTipoExamen;

            $this->tag->setDefault("idTipoExamen", $adm_tipoExamen->idTipoExamen);
            $this->tag->setDefault("nombreExamen", $adm_tipoExamen->nombreExamen);
            $this->tag->setDefault("descTipoExamen", $adm_tipoExamen->descTipoExamen);
            
        }
    }

    /**
     * Creates a new adm_tipoExamen
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "adm_tipoExamen",
                'action' => 'index'
            ]);

            return;
        }

        $adm_tipoExamen = new AdmTipoexamen();
        $adm_tipoExamen->nombreExamen = $this->request->getPost("nombreExamen");
        $adm_tipoExamen->descTipoExamen = $this->request->getPost("descTipoExamen");
        

        if (!$adm_tipoExamen->save()) {
            foreach ($adm_tipoExamen->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "adm_tipoExamen",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("adm_tipoExamen was created successfully");

        $this->dispatcher->forward([
            'controller' => "adm_tipoExamen",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a adm_tipoExamen edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "adm_tipoExamen",
                'action' => 'index'
            ]);

            return;
        }

        $idTipoExamen = $this->request->getPost("idTipoExamen");
        $adm_tipoExamen = AdmTipoexamen::findFirstByidTipoExamen($idTipoExamen);

        if (!$adm_tipoExamen) {
            $this->flash->error("adm_tipoExamen does not exist " . $idTipoExamen);

            $this->dispatcher->forward([
                'controller' => "adm_tipoExamen",
                'action' => 'index'
            ]);

            return;
        }

        $adm_tipoExamen->nombreExamen = $this->request->getPost("nombreExamen");
        $adm_tipoExamen->descTipoExamen = $this->request->getPost("descTipoExamen");
        

        if (!$adm_tipoExamen->save()) {

            foreach ($adm_tipoExamen->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "adm_tipoExamen",
                'action' => 'edit',
                'params' => [$adm_tipoExamen->idTipoExamen]
            ]);

            return;
        }

        $this->flash->success("adm_tipoExamen was updated successfully");

        $this->dispatcher->forward([
            'controller' => "adm_tipoExamen",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a adm_tipoExamen
     *
     * @param string $idTipoExamen
     */
    public function deleteAction($idTipoExamen)
    {
        $adm_tipoExamen = AdmTipoexamen::findFirstByidTipoExamen($idTipoExamen);
        if (!$adm_tipoExamen) {
            $this->flash->error("adm_tipoExamen was not found");

            $this->dispatcher->forward([
                'controller' => "adm_tipoExamen",
                'action' => 'index'
            ]);

            return;
        }

        if (!$adm_tipoExamen->delete()) {

            foreach ($adm_tipoExamen->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "adm_tipoExamen",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("adm_tipoExamen was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "adm_tipoExamen",
            'action' => "index"
        ]);
    }

}
