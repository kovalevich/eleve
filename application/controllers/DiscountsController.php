<?php

class DiscountsController extends Zend_Controller_Action
{

    public function init()
    {
        $mapper_categories = new Models_Categories_Mapper();
        $this->view->categories = $mapper_categories->getCategories('discounts');
    }

    public function indexAction()
    {

    }

    public function categoryAction()
    {
        $id = $this->_request->getParam('id', null);

        if($id){
            $mapper = new Models_Discounts_Mapper();
            $this->view->companies = $mapper->getCompanies($id);
        }
    }


}



