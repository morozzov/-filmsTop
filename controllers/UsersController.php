<?php

require_once './models/DbManager.php';
require_once './views/View.php';

class UsersController
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

    public function signinAction()
    {
        if ($this->isAutorized()) {
            $this->view->redirect("films/getall");
        } else {
            $this->view->render("sign", "users/signin");
        }
    }

    public function signupAction()
    {
        if ($this->isAutorized()) {
            $this->view->redirect("films/getall");
        } else {
            $this->view->render("sign", "users/signup");
        }
    }

    public function authAction($post)
    {
        $login = $post["login"];
        $password = $post["password"];
        $user = $this->dbManager->Users->auth($login, $password);

        if ($user != null) {
            $this->view->redirect("films/getall");
        } else {
            $this->view->redirect("users/signin");
        }
    }

    public function addNewAction($post)
    {
        $login = $post["login"];
        $password = $post["password1"];
        $name = $post["name"];
        $user = $this->dbManager->Users->addNew($login, $password, $name);

        if (isset($user)) {
            $this->view->redirect("films/getall");
        } else {
            $this->view->redirect("users/signup");
        }
    }

    public function logOutAction()
    {
        $_SESSION = array();
        $this->view->redirect("users/signin");
    }

}
