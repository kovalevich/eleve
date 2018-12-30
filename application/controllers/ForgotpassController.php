<?php

class ForgotpassController extends Zend_Controller_Action
{
    protected $config = null;

    public function init()
    {
    	$this->config = Zend_Registry::get('config')->my;
    }

    public function indexAction()
    {
        $this->view->headTitle('Забыли пароль?', 'PREPEND');
        
        $form = new Application_Form_Forgot();
        
        if ($this->_request->isPost() && $form->isValid($this->_request->getPost())) {
        	$model = new Models_Users_Mapper();
        	$user = $model->getSearchEmail($this->_request->getParam('email'));
        	if ($user->id) {
        		$pass = Classes_IdGenerator::generatePassword(7);
        		$user->password = md5(md5($pass).md5($this->config->salt));
    		    $user->save();
    		    
    		    $user1 = $user->getUser();
    		    $user1->password = $pass;
    		    
    		    $mail = new Classes_MailManager();
    		    $mail->sentTemplateMail($user1->email, 'Смена пароля', 'forgot', $user1);
    		    
    		    $this->view->mess = 'Новый пароль выслан на ваш email';
        	}
        	else {
        	    $this->view->mess = 'Пользователь с таким email не найден!';
        	    $this->view->form = $form;
        	}
        }
        else
            $this->view->form = $form;
    }


}

