<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	
    protected  function _initLocale(){

        $locale = new Zend_Locale('pt_BR');
        Zend_Registry::set('Zend_Locale', $locale);
        
    }
    
    
    protected function _initLanguage() {
		require_once 'Languages/pt-br/pt_BR.php';
		$translate = new Zend_Translate ( 'array', $portugues, 'pt_BR' );
		Zend_Registry::set('translate',$translate);
    
    }	
	protected function _initDoctype() {
		$this->bootstrap ( 'view' );
		$view = $this->getResource ( 'view' );
		$view->doctype ( 'XHTML1_STRICT' );
		$view->setEncoding ( 'UTF-8' );
	}
	
	protected function _initHeader() {
		$view = $this->getResource ( 'view' );
		$view->headTitle ()->setSeparator ( ' - ' );
		$view->headTitle ()->append ( $this->getOption ( 'titulo' ) );
		$view->placeholder ( 'title' )->set ( $this->getOption ( 'header' ) );
		$view->placeholder ( 'footer' )->set ( $this->getOption ( 'footer' ) );
		$view->headMeta ()->appendHttpEquiv ( 'Content-Type', 'text/html; charset=utf-8' );
		$view->headMeta ()->appendHttpEquiv ( 'Desenvolvedor', 'Elan Josedeck de Jesus Martins' );
		
	}
	
	protected function _initAutoload() {
		$moduleloader = new Zend_Application_Module_Autoloader ( 
			array ('namespace' => '', 'basePath' => APPLICATION_PATH ) );
		return $moduleloader;
	}

	
	protected function _initAcl() {
		$this->bootstrap ( 'frontController' );
		$frontController = $this->getResource ( 'frontController' );
		$auth = Zend_Auth::getInstance ();
		$acl = new App_Acl ( $auth );
		$frontController->setParams ( array ('auth' => $auth, 'acl' => $acl ) );
		$frontController->registerPlugin ( new App_Controller_Plugin_Acl ( $auth, $acl ) );
	}
	
	protected function _initDatabase() {
		$this->bootstrap('db');
		$db = $this->getResource ( 'db' );
		Zend_Registry::set ( 'database', $db );
		Zend_Db_Table_Abstract::setDefaultAdapter ( $db );
		
	}
	
	protected function _initDbPadrao() {
	    $options = Array(	'host' => 'ipatinga',
                            'username' => 'padrao',
                            'password' => '',
                            'dbname' => 'padrao'
					    );
        $dbPadrao = Zend_Db::factory('PDO_MSSQL', $options);
        Zend_Registry::set('dbPadrao', $dbPadrao);		
	}
	
	
	
	protected function _initMenu() {
	    if (Zend_Auth::getInstance()->hasIdentity()){
    		$this->bootstrap ( 'view' );
    		$view = $this->getResource ( 'view' );
    		$config = new  Zend_Config_Xml ( APPLICATION_PATH . '/configs/navigation.xml', 'nav' );
    		$navigation = new Zend_Navigation ( $config );
    		$view->navigation ( $navigation );
	    }
		
	}
	
    protected function _initViewHelpers(){
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
		$view->addHelperPath('App/Helpers','App_Helpers');
    }

    
}

