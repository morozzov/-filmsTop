<?php

require_once './models/DbManager.php';
require_once './views/View.php';

class FilmsController
{
    private $dbManager;
    private $view;

    public function __construct()
    {
        $this->dbManager = new DbManager();
        $this->view = new View();
    }

    public function isAutorized()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllAction()
    {
        if ($this->isAutorized()) {
            $films = $this->dbManager->Films->getAll();
            $this->view->render("main", "films/getAll", $films);
        } else {
            $this->view->redirect("users/signin");
        }
    }

    public function addNewAction($post)
    {
        $name = $post["name"];
        $year = $post["year"];
        //$film =
            $this->dbManager->Films->addNew($name, $year);

//        if (isset($user)) {
            $this->view->redirect("films/getall");
//        } else {
//            $this->view->redirect("users/signup");
//        }
    }
}