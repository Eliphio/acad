<?php

class UsuariosSistemaController extends Zend_Controller_Action
{

	protected $_form = null;

	
	public function getForm($id = false) {
		if (null === $this->_form) {
			$this->_form = new Form_UsuariosSistema ( array ('action' => 'add', 'method' => 'post', 'id' => 'fusuario' ) );
		}
		return $this->_form;
	}
	
	public function indexAction() {
		$mUsuarios = new Model_UsuariosSistema ();
		
		$usuarios = $mUsuarios->listarUsuarios ();
		
		if ($usuarios) {
			$paginator = Zend_Paginator::factory ( $usuarios );
			$paginator->setItemCountPerPage ( 10 );
			$paginator->setCurrentPageNumber ( $this->_request->getParam ( 'pagina' ) );
			$this->view->paginator = $paginator;
		
		} 
	}
	
	public function addAction() {
        $this->view->title = "Inserir Usuário do Sistema";
     	$this->view->headTitle ( $this->view->title, 'PREPEND' );
        $form = $this->getForm ();
        $form->submit->setLabel('Inserir');
        if ($this->getRequest()->isPost()){
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		try {
					$usuarios = new Model_UsuariosSistema ();
					if ($usuarios->insert ($formData )) {
        				$this->_helper->FlashMessenger(array('mensagemsucesso' => Mensagem::getMensagem('MSG-01')));
						$this->_helper->redirector('index');                   	
					}
        		} catch ( Exception $e ) {
        				$form->populate($formData);
						$this->_helper->FlashMessenger(array('mensagemerro' => Mensagem::getMensagem('MSG-10')));        		
        		}
        	}
        }
        $this->view->form = $form;
	}
	
	public function editAction() {
        $this->view->title = "Editar Usuário do Sistema";
     	$this->view->headTitle ( $this->view->title, 'PREPEND' );
        $form = $this->getForm ();
        $form->submit->setLabel('Salvar');
        if ($this->getRequest()->isPost()){
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		try {
					$usuarios = new Model_UsuariosSistema ();
					if ($usuarios->update($formData )) {
        				$this->_helper->FlashMessenger(array('mensagemsucesso' => Mensagem::getMensagem('MSG-02')));
						$this->_helper->redirector('index');                   	
                    	
        			}
        		} catch ( Exception $e ) {
       				$form->populate($formData);
	        		$this->_helper->FlashMessenger(array('mensagemerro' => Mensagem::getMensagem('MSG-10')));
        		}
        	}
        } else {
        	$cod_profis = $this->_getParam('cod_profis',0);
        	$usuarios = new Model_UsuariosSistema ();
        	$usuario = $usuarios->getUsuario($cod_profis);
        	if ($usuario) {
				$form->populate($usuario);        		
        		
        	} else {
        		$this->_helper->FlashMessenger(array('mensagemerro' => Mensagem::getMensagem('MSG-09')));
				$this->_helper->redirector('add');                   	
        	}
        	
        }
        $this->view->form = $form;
		
	}

}