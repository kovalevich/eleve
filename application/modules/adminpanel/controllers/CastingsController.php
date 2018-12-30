<?php

class Adminpanel_CastingsController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function indexAction()
    {
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls_articles.phtml');

        $categories_mapper = new Models_Categories_Mapper();
        $this->view->categories = $categories_mapper->getCategories('castings');

        $model = new Models_Castings_Mapper();
        $category = $this->_request->getParam('category_id', false);
        Zend_Registry::set('category', $category);

        $paginator = $model->getPage($category, $this->getParam('page', 1));
        $this->view->entries = $model->convertRows($paginator);
        $this->view->paginator = $paginator;
    }

    public function addAction()
    {
        $categories_mapper = new Models_Categories_Mapper();
        $this->view->categories = $categories_mapper->getCategories('castings');

        $form = new Application_Form_Casting();
        $model = new Models_Castings_Mapper();
        if ($this->_request->isPost() && $form->isValid($this->_request->getPost())) {
            $model->getRow();
            $model->fill($form->getValues());
            $model->created = date('Y-m-d H:i:s');
            $model->save();

            $this->_helper->redirector('index', 'castings', 'adminpanel');
        }
        $this->view->form = $form;
    }

    public function editAction()
    {
        $categories_mapper = new Models_Categories_Mapper();
        $this->view->categories = $categories_mapper->getCategories('castings');

        $form = new Application_Form_Casting();
        $form->removeElement('id');
        $form->addElement(new Zend_Form_Element_Hidden('id'), 'id', array(
            'value'=>$this->_request->getParam('id', FALSE)
        ));

        $model = new Models_Castings_Mapper($this->_request->getParam('id', FALSE));

        if ($this->_request->isPost() && $form->isValid($this->_request->getPost())) {
            $model->fill($form->getValues());
            $model->save();
            $this->_helper->redirector('index', 'castings', 'adminpanel');
        }

        $form->populate($model->getArray());
        $this->view->form = $form;
    }

    public function deleteAction()
    {
            $model = new Models_Castings_Mapper();
            $model->delete($this->_request->getParam('id', FALSE));
            $this->_helper->redirector('index', 'castings', 'adminpanel');
    }

}