<?php
class App_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract {
	
	protected $_acl = null;
	protected $_auth = null;
		
	public function __construct(Zend_Auth $auth, Zend_Acl $acl) {
		$this->_auth = $auth;
		$this->_acl = $acl;
	}
	
	public function preDispatch(Zend_Controller_Request_Abstract $request) {
 
		if (!$this->_auth->hasIdentity()) {
				$request->setModuleName('default');				
				$request->setControllerName('index');
				$request->setActionName('login');
				
		} else {
				Zend_Registry::set ( 'role', 'admin' );
/*				$request->setModuleName('default');				
				$request->setControllerName('index');
				$request->setActionName('error');*/
			
		}		
	}
	
	
}
