<?php

class Application_Plugin_CheckLogin extends Zend_Controller_Plugin_Abstract
{
    protected $_userModel;
    
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request){
        if (Zend_Auth::getInstance()->hasIdentity()) {
        	$auth = Zend_Auth::getInstance();
        	$user = $auth->getIdentity();
        	$model = $this->_getUserModel($user->id);
            //var_dump($user->id);
        	$auth->getStorage()->write($model->getUser($user->id));
        }
    
    }
    
    public function _getUserModel($id){
    	if (null === $this->_userModel) {
    		require_once APPLICATION_PATH . '/models/Users/Mapper.php';
    		$this->_userModel = new Models_Users_Mapper();
    	}
    	return $this->_userModel;
    }
}

?>