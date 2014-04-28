<?php

class Adminpanel_IndexController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function indexAction()
    {
        $mapper = new Models_Articles_Mapper();
        $this->view->articles = $mapper->getArticles();

        $mapper_users = new Models_Users_Mapper();
        $this->view->users = $mapper_users->getUsers();
    }

}

