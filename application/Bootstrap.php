<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected $_frontController;
    protected $_config;
    protected $options;

    public function _initAaa() {

        $this->_frontController = Zend_Controller_Front::getInstance();
        $this->_config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/config.ini');
        Zend_Registry::set('_config', $this->_config);

        $this->options = new Zend_Config($this->getOptions());
    }
    
    public function _initAutoLoad()
    {
        $moduleLoader = new Zend_Application_Module_Autoloader(array(
                'namespace'    =>    '',
                'basePath'     =>    APPLICATION_PATH,
        ));
        $moduleLoader->addResourceType('form', 'forms/', 'Forms')
        ->addResourceType('models', 'models/', 'Models')
        ->addResourceType('class', 'classes/', 'Classes');
        
        return $moduleLoader;
    }

    protected function _initView()
    {
    	$view = new Zend_View();
    	$view->doctype('HTML5');
    	
    	$view->headTitle()->setSeparator(' | ');
    	$view->headTitle('evele');
    	 
    	$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper(
    			'ViewRenderer'
    	);
    	$viewRenderer->setView($view);
    	
    	Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls.phtml');
    
    	return $view;
    }
    
    protected function _initDB()
    {
        if ($this->_config->db) {

            // Instantiate the DB factory
            $dbAdapter = Zend_Db::factory($this->_config->db);
            $dbAdapter->query("SET NAMES UTF8");
            // Set the DB Table default adaptor for auto connection in the models
            Zend_Db_Table::setDefaultAdapter($dbAdapter);

            // Add the DB Adaptor to the registry if we need to call it outside of the modules.
            Zend_Registry::set('dbAdapter', $dbAdapter);
        }
    }
    
    protected function _initAcl()
    {
    	$acl = new Zend_Acl();
    
    	/** user */
    	$acl->add(new Zend_Acl_Resource('user'))
    	->add(new Zend_Acl_Resource('default-payment'), 'user')
    	->add(new Zend_Acl_Resource('default-room'), 'user')
    	->add(new Zend_Acl_Resource('default-catalog-add'), 'user');
    	
    	/** author */
    	$acl->add(new Zend_Acl_Resource('author'));
    	
    	
    	/** AdminPanel manager */
    	$acl->add(new Zend_Acl_Resource('manager'))
    	->add(new Zend_Acl_Resource('adminpanel-index'), 'manager')
    	->add(new Zend_Acl_Resource('adminpanel-articles'), 'manager');
    	
    	/** AdminPanel module */
    	$acl->add(new Zend_Acl_Resource('adminpanel'))
    	->add(new Zend_Acl_Resource('adminpanel-categories'), 'adminpanel')
    	->add(new Zend_Acl_Resource('adminpanel-moneyout'), 'adminpanel')
    	->add(new Zend_Acl_Resource('adminpanel-orders'), 'adminpanel')
    	->add(new Zend_Acl_Resource('adminpanel-projects'), 'adminpanel')
    	->add(new Zend_Acl_Resource('adminpanel-shopping'), 'adminpanel')
    	->add(new Zend_Acl_Resource('adminpanel-themes'), 'adminpanel')
    	->add(new Zend_Acl_Resource('adminpanel-types'), 'adminpanel')
    	->add(new Zend_Acl_Resource('adminpanel-users'), 'adminpanel')
    	->add(new Zend_Acl_Resource('adminpanel-catalog'), 'adminpanel');
    
    	$acl->addRole('guest');
    	$acl->addRole('user', 'guest');
    	$acl->addRole('author', 'user');
    	$acl->addRole('manager', 'author');
    	$acl->addRole('admin', 'manager');

    	$acl->allow('user', 'user');
    	$acl->allow('author', 'author');
    	$acl->allow('manager', 'manager');
    	$acl->allow('admin', 'adminpanel');
    
    	$this->_frontController->registerPlugin(new Application_Plugin_AccessCheck($acl, Zend_Auth::getInstance()));
    }
    
    protected function _initTranslate()
    {
        $this->_frontController->registerPlugin(new Application_Plugin_Locale());
    }
    
    protected function _initPlugins()
    {
        //$this->_frontController->registerPlugin(new Application_Plugin_Cache());
        $this->_frontController->registerPlugin(new Application_Plugin_CheckLogin());
        //$this->_frontController->registerPlugin(new Application_Plugin_PreviousPage(Zend_Auth::getInstance()));
    }
    
    protected function _initNavigation(){
    	$this->bootstrap('layout');
    	$layout = $this->getResource('layout');
    	$view = $layout->getView();

        $ini = new Zend_Config_Ini('configs/navigation.ini');
    	$container = new Zend_Navigation($ini->navigation->pages);
    	$view->maincontainer = $container;
    
    }

}

