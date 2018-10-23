<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class AdmGeneroController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for adm_genero
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'AdmGenero', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "idGenero";

        $adm_genero = AdmGenero::find($parameters);
        if (count($adm_genero) == 0) {
            $this->flash->notice("The search did not find any adm_genero");

            $this->dispatcher->forward([
                "controller" => "adm_genero",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $adm_genero,
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
     * Edits a adm_genero
     *
     * @param string $idGenero
     */
    public function editAction($idGenero)
    {
        if (!$this->request->isPost()) {

            $adm_genero = AdmGenero::findFirstByidGenero($idGenero);
            if (!$adm_genero) {
                $this->flash->error("adm_genero was not found");

                $this->dispatcher->forward([
                    'controller' => "adm_genero",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->idGenero = $adm_genero->idGenero;

            $this->tag->setDefault("idGenero", $adm_genero->idGenero);
            $this->tag->setDefault("nombreGenero", $adm_genero->nombreGenero);
            
        }
    }

    /**
     * Creates a new adm_genero
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "adm_genero",
                'action' => 'index'
            ]);

            return;
        }

        $adm_genero = new AdmGenero();
        $adm_genero->nombreGenero = $this->request->getPost("nombreGenero");
        

        if (!$adm_genero->save()) {
            foreach ($adm_genero->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "adm_genero",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("adm_genero was created successfully");

        $this->dispatcher->forward([
            'controller' => "adm_genero",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a adm_genero edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "adm_genero",
                'action' => 'index'
            ]);

            return;
        }

        $idGenero = $this->request->getPost("idGenero");
        $adm_genero = AdmGenero::findFirstByidGenero($idGenero);

        if (!$adm_genero) {
            $this->flash->error("adm_genero does not exist " . $idGenero);

            $this->dispatcher->forward([
                'controller' => "adm_genero",
                'action' => 'index'
            ]);

            return;
        }

        $adm_genero->nombreGenero = $this->request->getPost("nombreGenero");
        

        if (!$adm_genero->save()) {

            foreach ($adm_genero->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "adm_genero",
                'action' => 'edit',
                'params' => [$adm_genero->idGenero]
            ]);

            return;
        }

        $this->flash->success("adm_genero was updated successfully");

        $this->dispatcher->forward([
            'controller' => "adm_genero",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a adm_genero
     *
     * @param string $idGenero
     */
    public function deleteAction($idGenero)
    {
        $adm_genero = AdmGenero::findFirstByidGenero($idGenero);
        if (!$adm_genero) {
            $this->flash->error("adm_genero was not found");

            $this->dispatcher->forward([
                'controller' => "adm_genero",
                'action' => 'index'
            ]);

            return;
        }

        if (!$adm_genero->delete()) {

            foreach ($adm_genero->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "adm_genero",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("adm_genero was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "adm_genero",
            'action' => "index"
        ]);
    }

}
