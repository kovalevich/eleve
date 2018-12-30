<?php

class CatalogController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function indexAction()
    {
        $targets = $this->getParam('targets');
        if($targets) {
            Zend_Registry::set('filter_targets', $targets);
            $this->view->target = $targets;
        }

        $status = $this->getParam('status');
        if($status) {
            Zend_Registry::set('filter_prof', $status);
            $this->view->status = $status;
        }

        $city = $this->getParam('city');
        if($city) {
            Zend_Registry::set('filter_city', $city);
            $this->view->city = $city;
        }

        $b = $this->getParam('b');
        if($b) {
            Zend_Registry::set('filter_b', $b);
            $this->view->b = $b;
        }

        $growth = $this->getParam('growth');
        if($growth) {
            Zend_Registry::set('filter_growth', $growth);
            $this->view->growth = $growth;
        }

        $sex = $this->getParam('sex');
        if($sex) {
            Zend_Registry::set('filter_sex', $sex);
            $this->view->sex = $sex;
        }


        $mapper = new Models_Users_Mapper();
        $this->view->page = $mapper->getPage($this->getParam('page'), 1, 1);
        $profiles = $mapper->convertRows($this->view->page);
        $mapper_images = new Models_Images_Mapper();
        foreach($profiles as $profile) {
            $profile->photos = $mapper_images->getImages($profile->id);
        }
        $this->view->profiles = $profiles;
        $this->view->params = $this->getAllParams();
    }
    
    public function inAction () {
    	$id = $this->_request->getParam('id');
    	if($id) {
    		$mapper = new Models_Users_Mapper();
    		$profile = $mapper->getAncket($id);
    		$mapper_images = new Models_Images_Mapper();
            $profile->photos = $mapper_images->getImages($profile->id);
    		$this->view->user = $profile;
    	}
    }

}









