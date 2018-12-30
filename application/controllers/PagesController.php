<?php

class PagesController extends Zend_Controller_Action
{

    private $_config;

    public function init()
    {
        $this->_config = Zend_Registry::get('_config')->my;
    }

    public function indexAction()
    {

    }

    public function careerAction()
    {

    }

    public function contactsAction()
    {
        $form = new Application_Form_Contacts();
        if($this->_request->isPost()){
            if($form->isValid($this->_request->getPost())){
                $mail = new Classes_MailManager();
                $mail->sentTemplateMail($this->_config->contact_email, 'Вопрос пользователя eleve', 'q', $form->getValues());
                $this->redirect('/contacts');
            }
        }
        $this->view->form = $form;
        $this->view->errors = $form->getErrors();
    }

    public function activationAction()
    {

    }
}