<?php

class App_Acl extends Zend_Acl {
	
	public function __construct(Zend_Auth $auth) {
		/**
		Resources - Recursos
		Role - Papel
		Allow - Privilégio
		Site
		- Páginas (Páginas de conteúdo em geral)
		- Galeria de Imagens
		- Fórum
		- FAQ 
		Recursos
		 *
		 */
		// Papéis
		$this->addRole ( new Zend_Acl_Role ( 'visitante' ) );
		$this->addRole ( new Zend_Acl_Role ( 'professor' ), 'visitante' );
		$this->addRole ( new Zend_Acl_Role ( 'administrador' ), 'professor' );
		//Recursos
		$this->add ( new Zend_Acl_Resource ( 'inicio' ) );
		$this->add ( new Zend_Acl_Resource ( 'incluir' ) );
		$this->add ( new Zend_Acl_Resource ( 'administrar' ) );
		
		// Privilegios
		$this->allow ( 'visitante', 'inicio' );
		$this->allow ( 'professor', 'incluir' );
		$this->allow ( 'administrador', 'administrar' );
	}
}
/*
class MyAcl extends Zend_Acl {
	
	private $_db;
	
	public $_getUserRoleName = null;
	
	public $_getUserRoleId = null;
	
	public $_user = null;
	
	public function __construct($user) {
		$this->_user = $user ? $user : '0';
		
		$this->_db = Zend_Registry::get ( 'database' );
		self::roleResource ();
		
		$getUserRole = $this->_db->fetchRow ( $this->_db->select ()->from ( 'acl_roles' )
																	->from ( 'acl_users' )
																	->where ( 'acl_users.cod_usua = "' . $this->_user . '"' )
																	->where ( 'acl_users.role_id = acl_roles.role_id' ) );
		
		$this->_getUserRoleId = $getUserRole ['role_id'] ? $getUserRole ['role_id'] : 4;
		$this->_getUserRoleName = $getUserRole ['role_name'] ? $getUserRole ['role_name'] : 'User';
		
		$this->addRole ( new Zend_Acl_Role ( $this->_user ), $this->_getUserRoleName );
	
	}
	
	private function initRoles() {
		$roles = $this->_db->fetchAll ( $this->_db->select ()
												  ->from ( 'acl_roles' )
												  ->order ( array ('role_id DESC' ) ) );
		
		$this->addRole ( new Zend_Acl_Role ( $roles [0] ['role_name'] ) );
		
		for($i = 1; $i < count ( $roles ); $i ++) {
			$this->addRole ( new Zend_Acl_Role ( $roles [$i] ['role_name'] ), $roles [$i - 1] ['role_name'] );
		}
	}
	
	private function initResources() {
		self::initRoles ();
		
		$resources = $this->_db->fetchAll ( $this->_db->select ()->from ( 'acl_resources' ) );
		
		foreach ( $resources as $key => $value ) {
			if (! $this->has ( $value ['resource'] )) {
				$this->add ( new Zend_Acl_Resource ( $value ['resource'] ) );
			}
		}
	}
	
	private function roleResource() {
		self::initResources ();
		
		$acl = $this->_db->fetchAll ( $this->_db->select ()
												->from ( 'acl_roles' )
												->from ( 'acl_resources' )
												->from ( 'acl_permissions' )
												->where ( 'acl_roles.role_id = acl_permissions.role_id' )
												->where ( 'acl_resources.id = acl_permissions.resource_id' ));
		
		foreach ( $acl as $key => $value ) {
			$this->allow ( $value ['role_name'], $value ['resource'], $value ['permission'] );
		}
	}
	
	public function listRoles() {
		return $this->_db->fetchAll ( $this->_db->select ()->from ( 'acl_roles' ) );
	}
	
	public function getRoleId($roleName) {
		return $this->_db->fetchRow ( $this->_db->select ()->from ( 'acl_roles', 'role_id' )->where ( 'acl_roles.role_name = "' . $roleName . '"' ) );
	}
	
	public function insertAclUser() {
		$data = array ('role_id' => $this->_getUserRoleId, 'user_name' => $this->_user );
		
		return $this->_db->insert ( 'acl_users', $data );
	}
	
	public function listResources() {
		return $this->_db->fetchAll ( $this->_db->select ()->from ( 'acl_resources' )->from ( 'acl_permissions' )->where ( 'resource_id = id' ) );
	}
	
	public function listResourcesByGroup($group) {
		$result = null;
		$group = $this->_db->fetchAll ( $this->_db->select ()->from ( 'acl_resources' )->from ( 'acl_permissions' )->where ( 'acl_resources.resource = "' . $group . '"' )->where ( 'id = resource_id' ) );
		
		foreach ( $group as $key => $value ) {
			if ($this->isAllowed ( $this->_user, $value ['resource'], $value ['permission'] )) {
				$result [] = $value ['permission'];
			}
		}
		
		return $result;
	}
	
	public function isUserAllowed($resource, $permission) {
		return ($this->isAllowed ( $this->_user, $resource, $permission ));
	}
}  
*/