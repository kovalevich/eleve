<?php

class Adminpanel_UsersController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function indexAction()
    {
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls_articles.phtml');
        $model = new Models_Users_Mapper();

        if($this->getParam('activate')) {
            $model->getRow($this->getParam('activate'));
            $model->account_status = 1;
            $model->save();
        }
        if($this->getParam('deactivate')) {
            $model->getRow($this->getParam('deactivate'));
            $model->account_status = 0;
            $model->save();
        }
    	$paginator = $model->getPage($this->getParam('page', 1));
    	
    	$this->view->entries = $model->convertRows($paginator);
    	$this->view->paginator = $paginator;
    }

    public function deleteAction()
    {
        if ($this->_request->getParam('id', FALSE)) {
        	$model = new Models_Users_Mapper($this->_request->getParam('id', FALSE));
        	$model->delete($this->_request->getParam('id', FALSE));
        	$this->_helper->redirector('index', 'users', 'adminpanel');
        }

    }

    public function editAction()
    {
        $this->view->title = $this->view->translate('editpage');
        $this->view->headTitle($this->view->title, 'PREPEND');
        $form = new Application_Form_Edituser();
        $model = new Models_Users_Mapper($this->_request->getParam('id'));
        $form->populate($model->getArray());
        $this->view->entry = $model->getUser();
        $this->view->entry->files = $model->getFiles();
        
        $model_projects = new Models_Projects_Mapper();
        $this->view->projects = $model_projects->getUserProjects($model->id);
        
        $model_orders = new Models_Orders_Mapper();
        $this->view->orders = $model_orders->getAuthorsOrders($model->id);
        
        $this->view->user_themes = $model->getThemes();
        
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
        	if ($form->isValid($this->getRequest()->getPost())) {
        	    $model->fill($form->getValues());
                if ($model->status == 3) {
                    $model->email .= 'block';
                }
        	    $model->modified = date('Y-m-d H:i:s');
        	    $model->save();
        	    $this->_helper->redirector('index', 'users', 'adminpanel');
        	}
        }
    }
}