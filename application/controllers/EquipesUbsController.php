<?php

class EquipesUbsController extends Zend_Controller_Action
{
	protected $_form = null;
	public function init()
	{
		$ajaxContext = $this->_helper->ajaxContext;
        $ajaxContext->addActionContext('addbyajax', 'json');
	}
	
	public function getForm($id = false) {
		if (null === $this->_form) {
			$this->_form = new Form_EquipesUbs ( array ('action' => 'add', 'method' => 'post', 'id' => 'fEquipe' ) );
		}
		return $this->_form;
	}
	
	public function indexAction() {
		$mEquipe = new Model_EquipesUbs();
		
		$equipe = $mEquipe->listarEquipes();
		
		if ($equipe) {
			$paginator = Zend_Paginator::factory ( $equipe );
			$paginator->setItemCountPerPage ( 10 );
			$paginator->setCurrentPageNumber ( $this->_request->getParam ( 'pagina' ) );
			$this->view->paginator = $paginator;
		
		} 
	}
	
	public function addAction() {
		$render = $this->_getParam('render',0);
		if ($render>0)
			$this->_helper->layout->disableLayout();
		
        $this->view->title = "Inserir Equipe";
     	$this->view->headTitle ( $this->view->title, 'PREPEND' );
        $form = $this->getForm ();
        $form->submit->setLabel('Inserir');
        if ($this->getRequest()->isPost()){
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		try {
					$equipes = new Model_EquipesUbs();
					if ($equipes->insert ($formData )) {
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
        $this->view->title = "Editar Equipe";
     	$this->view->headTitle ( $this->view->title, 'PREPEND' );
        $form = $this->getForm ();
        $form->addElement('hidden', 'cod_eqp_ubs');
        $form->submit->setLabel('Salvar');
        if ($this->getRequest()->isPost()){
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		try {
					$equipes = new Model_EquipesUbs();
					if ($equipes->update($formData )) {
        				$this->_helper->FlashMessenger(array('mensagemsucesso' => Mensagem::getMensagem('MSG-02')));
						$this->_helper->redirector('index');                   	
                    	
        			}
        		} catch ( Exception $e ) {
       				$form->populate($formData);
	        		$this->_helper->FlashMessenger(array('mensagemerro' => Mensagem::getMensagem('MSG-10')));
        		}
        	}
        } else {
        	$cod_eqp_ubs = $this->_getParam('cod_eqp_ubs',0);
        	$equipes = new Model_EquipesUbs();
        	$equipe = $equipes->getEquipe($cod_eqp_ubs);
        	if ($equipe) {
				$form->populate($equipe);        		
        		
        	} else {
        		$this->_helper->FlashMessenger(array('mensagemerro' => Mensagem::getMensagem('MSG-09')));
				$this->_helper->redirector('add');                   	
        	}
        	
        }
        $this->view->form = $form;
		
	}
	public function addbyajaxAction() {
		$cod_unsa = array('cod_unsa' => $this->_getParam('cod_unsa',0));
        $form = new Form_EquipesUbs ( array ('action' => Zend_Controller_Front::getInstance()->getBaseUrl().'/Equipes-Ubs/addbyajax', 'method' => 'post', 'id' => 'fEquipe' ,'byAjax'=> true));
        $form->submit->setLabel('Inserir');
        if ($cod_unsa > 0) {
        	$form->populate($cod_unsa);
        } 
        if ($this->getRequest()->isPost()){
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		try {
					$equipes = new Model_EquipesUbs();
					if ($equipes->insert ($formData )) {
						$return = array('msg' => Mensagem::getMensagem('MSG-01'), 'eqp' => $equipes->getAdapter ()->lastInsertId ());
					}
        		} catch ( Exception $e ) {
        				$form->populate($formData);
						$return =  Mensagem::getMensagem('MSG-10');        		
        		}
        	} else {
        		$return = $form->getMessages();
        	}
        }else{
        	$this->_helper->layout()->disableLayout();
	        $this->_helper->viewRenderer->setNoRender(true);
        	
        	echo $form;
        	return false;
        }
        
        
		if ($this->_request->isXmlHttpRequest()) {
			$return = Zend_Json_Encoder::encode($return);
	        $this->_helper->layout()->disableLayout();
	        $this->_helper->viewRenderer->setNoRender(true);
	        echo $return;
    	}
	}
	
}





