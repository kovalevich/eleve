<?php

class CatalogController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function indexAction()
    {
        $mapper = new Models_Users_Mapper();
        $this->view->page = $mapper->getPage(1);
        $profiles = $mapper->convertRows($this->view->page);
        $mapper_images = new Models_Images_Mapper();
        foreach($profiles as $profile) {
            $profile->photos = $mapper_images->getImages($profile->id);
        }
        $this->view->profiles = $profiles;
    }
    
    public function inAction () {
    	$id = $this->_request->getParam('id');
    	if($id) {
    		$mapper = new Models_Users_Mapper();
    		$profile = $mapper->getUser($id);
    		$mapper_images = new Models_Images_Mapper();
         $profile->photos = $mapper_images->getImages($profile->id); 		
    		$this->view->user = $profile;
    	}
    }

}









