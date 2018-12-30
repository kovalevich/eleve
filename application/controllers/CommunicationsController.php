<?php

class CommunicationsController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function indexAction()
    {
        $model = new Models_Communications_Mapper();
        $communication = $model->getCommunications(null, 10);

        $this->view->communications = $communication;

    }

}