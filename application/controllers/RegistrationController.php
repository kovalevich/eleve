<?php

class RegistrationController extends Zend_Controller_Action
{
    protected $config = null;
    
    public function init()
    {
    	$this->config = Zend_Registry::get('_config')->my;
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
    		    $pass = Classes_IdGenerator::generatePassword(7);
    		    $user->password = md5(md5($pass).md5($this->config->salt));
    		    $user->role = $this->getParam('role', 'user');
    		    $user->save();

       		    //$mail = new Classes_MailManager();
   	    	    //$mail->sendPasswordEmail($user, $pass);
    		    
    		    
    		    $this->_request->setPost(array(
    		    		'password' => $pass,
    		    		'login' => $user->email,
    		    ));
    		    $this->_forward('login', 'auth');
    		}
            else{
                var_dump($form->getErrors());
            }
    	}
    }


}

