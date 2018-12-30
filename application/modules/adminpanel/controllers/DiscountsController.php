<?php

class Adminpanel_DiscountsController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function indexAction()
    {
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls_articles.phtml');

        $categories_mapper = new Models_Categories_Mapper();
        $this->view->categories = $categories_mapper->getCategories('discounts');

        $model = new Models_Discounts_Mapper();
        $category = $this->_request->getParam('category_id', false);
        Zend_Registry::set('category', $category);

        $paginator = $model->getPage($category, $this->getParam('page', 1));
        $this->view->entries = $model->convertRows($paginator);
        $this->view->paginator = $paginator;
    }

    public function addAction()
    {
        $categories_mapper = new Models_Categories_Mapper();
        $this->view->categories = $categories_mapper->getCategories('discounts');

        $form = new Application_Form_Company();
        $model = new Models_Discounts_Mapper();
        if ($this->_request->isPost() && $form->isValid($this->_request->getPost())) {
            $model->getRow();
            $model->fill($form->getValues());
            $model->save();
            $model->created = date('Y-m-d H:i:s');
            $this->_helper->redirector('index', 'discounts', 'adminpanel');
        }
        $this->view->form = $form;
    }

    public function editAction()
    {
        $categories_mapper = new Models_Categories_Mapper();
        $this->view->categories = $categories_mapper->getCategories('discounts');

        $form = new Application_Form_Company();
        $form->removeElement('id');
        $form->addElement(new Zend_Form_Element_Hidden('id'), 'id', array(
            'value'=>$this->_request->getParam('id', FALSE)
        ));
        $form->setAction('/adminpanel/discounts/edit');
        $model = new Models_Discounts_Mapper($this->_request->getParam('id', FALSE));

        if ($this->_request->isPost() && $form->isValid($this->_request->getPost())) {

            $model->fill($form->getValues());
            $model->save();
            $this->_helper->redirector('index', 'discounts', 'adminpanel');
        }

        $form->populate($model->getArray());
        $this->view->form = $form;
    }

    public function deleteAction()
    {
        if ($this->_request->getParam('id', FALSE)) {
            $model = new Models_Discounts_Mapper();
            $model->delete($this->_request->getParam('id', FALSE));
            $this->_helper->redirector('index', 'discounts', 'adminpanel');
        }
    }

}