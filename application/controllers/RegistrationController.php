<?php

class RegistrationController extends Zend_Controller_Action
{
    protected $config = null;
    
    public function init()
    {
    	$this->config = Zend_Registry::get('_config')->my;
        $user = Zend_Registry::get('user');
        if ($user) $this->redirect('/news');
    }

    public function indexAction()
    {
        $form = new Application_Form_Registration();
        $this->view->form = $form;
        
    	if ($this->_request->isPost()) {
    		if ($form->isValid($this->_request->getPost())) {
    		    
    		    $user = new Models_Users_Mapper();
    		    $user->getRow();
    		    $user->fill($form->getValues());
    		    $user->created = date('Y-m-d H:i:s');
    		    $user->id = Classes_IdGenerator::generate();
                $user->public_id = $user->id;
                $user->account_type = $this->getParam('account_type', 0);
                $user->account_status = $user->account_type == 1 ? 0 : 1;
                $user->account_type1 = $this->getParam('account_type1', 0);
    		    $pass = Classes_IdGenerator::generatePassword(7);
    		    $user->setPassword($pass);
    		    $user->role = $this->getParam('role', 'user');
    		    $user->save();

       		    $mail = new Classes_MailManager();
                $mail->sentTemplateMail($user->email, $this->view->translate('Password'), 'password', $pass);
    		    
    		    
    		    $this->_request->setPost(array(
    		    		'password' => $pass,
    		    		'login' => $user->email,
    		    ));
    		    $this->_forward('login', 'auth');
    		}
            else{

            }
    	}
    }

    public function forgotpassAction()
    {
        $form = new Application_Form_Email();

        if($this->_request->isPost() && $form->isValid($this->_request->getPost())) {
            $mapper = new Models_Users_Mapper();
            $mapper->findByEmail($form->email->getValue());
            if($mapper->id) {
                $code = Classes_IdGenerator::generate();
                $mapper->forgotpass_code = $code;
                $mapper->save();
                $mail = new Classes_MailManager();
                $mail->sentTemplateMail($mapper->email, $this->view->translate('Password reset'), 'passreset', $mapper);
                $this->_redirect('/changepassword/' . $mapper->id);
            }
            else {
                $this->view->errors = 'user not found';
            }
        }

        $this->view->form = $form;
    }

    public function changepasswordAction()
    {
        $form = new Application_Form_Password();
        $mapper = new Models_Users_Mapper($this->_request->getParam('id'));
        $form->setAction('/changepassword/' . $mapper->id);

        if(!$mapper->id) {
            $this->view->errors = 'user not found';
        }

        if(!$mapper->forgotpass_code) {
            $this->view->errors = 'error';
        }

        if($this->_request->isPost() && $form->isValid($this->_request->getPost())) {
            if($form->code->getValue() == $mapper->forgotpass_code && $mapper->id) {
                $mapper->setPassword($form->password->getValue());
                $mapper->forgotpass_code = '';
                $mapper->save();
                $this->_redirect('/profile');
            }
            else {
                $this->view->errors = 'invalid code';
            }
        }
        $this->view->form = $form;
    }


}

