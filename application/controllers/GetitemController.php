<?php

class GetitemController extends Zend_Controller_Action
{
    protected $config = null;

    public function init()
    {
        $this->config = Zend_Registry::get('config')->my;
        header('Content-Type: application/json; charset=utf-8');
    }

    public function preDispatch()
    {
    	$this->_helper->layout()->disableLayout();
    }

    public function indexAction()
    {
        // action body
    }

    public function orderAction()
    {
        $id = $this->_request->getParam('id', FALSE);
    }
    
    public function themesAction()
    {
    	$id = $this->_request->getParam('id', FALSE);
    	$model = new Models_Themes_Mapper();
    	$this->view->json = Zend_Json::encode($model->getAll($id));
    }

    public function typeAction()
    {
        $id = $this->_request->getParam('id', FALSE);
        $model = new Models_Types_Mapper($id);
        $this->view->json = Zend_Json::encode($model->getType());
    }

    public function usersAction()
    {
        $type = $this->_request->getParam('type', 'user');
        $model = new Models_Users_Mapper();
        $users = $model->getSearchUsers($this->_request->getParam('query', null), $type);

        $res = array(
            'query'=>$this->_request->getParam('query', null),
            'suggestions'=>array(       
            )
        );
        foreach ($users as $user) {
            $res['suggestions'][] = array('value' => $user->name .' ('. $user->email .')', 
                                          'data'=>$user->id);
        }
        $this->view->json = Zend_Json::encode($res);
    }
    
    public function isloginAction()
    {
        $user = Zend_Registry::get('user');
        $res = $user ? array('islogin'=>true) : array('islogin'=>false);
        $this->view->json = Zend_Json::encode($res);
    }

    public function getconfAction()
    {
        //$this->view->items = var_dump(Zend_Registry::get('config'));
    }
    
    public function goregistrationAction()
    {
        $form = new Application_Form_Registrationsimple();
        
        if ($this->_request->isPost()) {
        	if ($form->isValid($this->_request->getPost())) {
        
        		$user = new Models_Users_Mapper();
        		$user->getRow();
        		$user->fill($form->getValues());
        		$user->created = date('Y-m-d H:i:s');
        		$user->last_visit = date('Y-m-d H:i:s');
        		$user->id = Classes_IdGenerator::generate();
        		$pass = Classes_IdGenerator::generatePassword(7);
        		$user->password = md5(md5($pass).md5($this->config->salt));
        		$user->role = 'user';
        		$user->save();

        		$mail = new Classes_MailManager();
        		$mail->sendPasswordEmail($user, $pass);
        
        		$this->_request->setPost(array(
        				'password' => $pass,
        				'login' => $user->email,
        		));
        		$this->_forward('login', 'auth');
        	}
        	else {
        		$emailmess = $form->getElement('email')->getMessages();
        		$namemess = $form->getElement('name')->getMessages();
        		$phonemess = $form->getElement('phone')->getMessages();
        		$citymess = $form->getElement('city')->getMessages();
        	
        		$ret = '';
        		
        		foreach ($emailmess as $mess){
        		    $ret .= '<b>email:</b><p>' . $mess . '</p>';
        		}
        		foreach ($namemess as $mess){
        			$ret .= '<b>ФИО:</b><p>' . $mess . '</p>';
        		}
        		foreach ($phonemess as $mess){
        			$ret .= '<b>Телефон:</b><p>' . $mess . '</p>';
        		}
        		foreach ($citymess as $mess){
        			$ret .= '<b>Город:</b><p>' . $mess . '</p>';
        		}
        		
        		$this->view->json = $ret;
        	}
        }
    }


}







