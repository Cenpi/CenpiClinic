<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class AdmEpsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for adm_eps
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'AdmEps', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "idEps";

        $adm_eps = AdmEps::find($parameters);
        if (count($adm_eps) == 0) {
            $this->flash->notice("The search did not find any adm_eps");

            $this->dispatcher->forward([
                "controller" => "adm_eps",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $adm_eps,
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
     * Edits a adm_eps
     *
     * @param string $idEps
     */
    public function editAction($idEps)
    {
        if (!$this->request->isPost()) {

            $adm_eps = AdmEps::findFirstByidEps($idEps);
            if (!$adm_eps) {
                $this->flash->error("adm_eps was not found");

                $this->dispatcher->forward([
                    'controller' => "adm_eps",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $adm_eps->idEps;

            $this->tag->setDefault("idEps", $adm_eps->idEps);
            $this->tag->setDefault("nitEps", $adm_eps->nitEps);
            $this->tag->setDefault("nombreEps", $adm_eps->nombreEps);
            
        }
    }

    /**
     * Creates a new adm_ep
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "adm_eps",
                'action' => 'index'
            ]);

            return;
        }

        $adm_ep = new AdmEps();
        $adm_ep->nitEps = $this->request->getPost("nitEps");
        $adm_ep->nombreEps = $this->request->getPost("nombreEps");
        

        if (!$adm_ep->save()) {
            foreach ($adm_ep->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "adm_eps",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("adm_ep was created successfully");

        $this->dispatcher->forward([
            'controller' => "adm_eps",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a adm_ep edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "adm_eps",
                'action' => 'index'
            ]);

            return;
        }

        $idEps = $this->request->getPost("idEps");
        $adm_ep = AdmEps::findFirstByidEps($idEps);

        if (!$adm_ep) {
            $this->flash->error("adm_ep does not exist " . $idEps);

            $this->dispatcher->forward([
                'controller' => "adm_eps",
                'action' => 'index'
            ]);

            return;
        }

        $adm_ep->nitEps = $this->request->getPost("nitEps");
        $adm_ep->nombreEps = $this->request->getPost("nombreEps");
        

        if (!$adm_ep->save()) {

            foreach ($adm_ep->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "adm_eps",
                'action' => 'edit',
                'params' => [$adm_ep->idEps]
            ]);

            return;
        }

        $this->flash->success("adm_ep was updated successfully");

        $this->dispatcher->forward([
            'controller' => "adm_eps",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a adm_ep
     *
     * @param string $idEps
     */
    public function deleteAction($idEps)
    {
        $adm_ep = AdmEps::findFirstByidEps($idEps);
        if (!$adm_ep) {
            $this->flash->error("adm_ep was not found");

            $this->dispatcher->forward([
                'controller' => "adm_eps",
                'action' => 'index'
            ]);

            return;
        }

        if (!$adm_ep->delete()) {

            foreach ($adm_ep->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "adm_eps",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("adm_ep was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "adm_eps",
            'action' => "index"
        ]);
    }

}
