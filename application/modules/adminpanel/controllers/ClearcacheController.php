<?php

class Adminpanel_ClearcacheController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function indexAction()
    {
        Classes_Cache::clear();
    }


}

