<?php

class RegionaisController extends Zend_Controller_Action {
	
	protected $_form = null;
	
	public function getForm($id = false) {
		if (null === $this->_form) {
			$this->_form = new Form_Regionais ( array ('action' => 'add', 'method' => 'post', 'id' => 'fRegionais' ) );
		}
		
		return $this->_form;
	}
	
	public function init() {
		/* Initialize action controller here */
	}
	
	public function indexAction() {
		
		$mRegionais = new Model_Regionais ();
		
		$regionais = $mRegionais->listarRegionais ();
		
		if ($regionais) {
			$paginator = Zend_Paginator::factory ( $regionais );
			$paginator->setItemCountPerPage ( 10 );
			$paginator->setCurrentPageNumber ( $this->_request->getParam ( 'pagina' ) );
			$this->view->paginator = $paginator;
		
		}
	}
	
	public function addAction() {
		$this->view->title = "Inserir Regional";
		$this->view->headTitle ( $this->view->title, 'PREPEND' );
		$form = $this->getForm ();
		$form->submit->setLabel ( 'Inserir' );
		if ($this->getRequest ()->isPost ()) {
			$formData = $this->getRequest ()->getPost ();
			if ($form->isValid ( $formData )) {
				try {
					$regionais = new Model_Regionais ();
					if ($regionais->insert ( $formData )) {
						$this->_helper->FlashMessenger ( array ('mensagemsucesso' => Mensagem::getMensagem ( 'MSG-01' ) ) );
						$this->_helper->redirector ( 'index' );
					}
				} catch ( Exception $e ) {
					$form->populate ( $formData );
					$this->_helper->FlashMessenger ( array ('mensagemerro' => Mensagem::getMensagem ( 'MSG-10' ) ) );
				}
			}
		}
		$this->view->form = $form;
	
	}
	
	public function editAction() {
		$this->view->title = "Editar Regional";
		$this->view->headTitle ( $this->view->title, 'PREPEND' );
		$form = $this->getForm ();
		$form->submit->setLabel ( 'Salvar' );
		if ($this->getRequest ()->isPost ()) {
			$formData = $this->getRequest ()->getPost ();
			if ($form->isValid ( $formData )) {
				try {
					$regionais = new Model_Regionais ();
					if ($regionais->update ( $formData )) {
						$this->_helper->FlashMessenger ( array ('mensagemsucesso' => Mensagem::getMensagem ( 'MSG-01' ) ) );
						$this->_helper->redirector ( 'index' );
					}
				} catch ( Exception $e ) {
					$form->populate ( $formData );
					$this->_helper->FlashMessenger ( array ('mensagemerro' => Mensagem::getMensagem ( 'MSG-10' ) ) );
				}
			}
		} else {
			$cod_regi = $this->_getParam ( 'cod_regi', 0 );
			$regionais = new Model_Regionais ();
			$regional = $regionais->getRegional($cod_regi);
        	if ($regional) {
				$form->populate($regional);        		
        		
        	} else {
        		$this->_helper->FlashMessenger(array('mensagemerro' => Mensagem::getMensagem('MSG-09')));
				$this->_helper->redirector('add');                   	
        	}
		}
		$this->view->form = $form;
	
	}
	public function deleteAction() {
		throw new Exception ( 'Exclusão não autorizada' );
	}

}





