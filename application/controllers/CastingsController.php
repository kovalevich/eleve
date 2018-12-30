<?php

class CastingsController extends Zend_Controller_Action
{

    private $_user, $_config;

    public function init()
    {
        $this->_user = Zend_Registry::get('user');
        $this->_config = Zend_Registry::get('_config')->my;
    }

    public function indexAction()
    {
        $model = new Models_Castings_Mapper();
        if($this->getParam('check') && $this->_user->id) {
            $model->Subscribe($this->_user->id, $this->getParam('check'));
            $this->_helper->redirector('index' ,'castings');
        }
        $paginator = $model->getPage(null, $this->getParam('page'));

        $this->view->castings = $model->convertRows($paginator);
        $this->view->paginator = $paginator;
        $this->view->user = $this->_user ? $this->_user->id : false;

        $form = new Application_Form_Castingsimple();
        if($this->_request->isPost()){
            if($form->isValid($this->_request->getPost())){
                $mail = new Classes_MailManager();
                $mail->sentTemplateMail($this->_config->contact_email, 'Добавлен кастинг', 'casting', $form->getValues());
                $this->redirect('/castings');
            }
        }
        $this->view->form = $form;
        $this->view->errors = $form->getErrors();

        $this->view->user1 = $this->_user;
    }

}