<?php

class CircunferenciaCinturaController extends Zend_Controller_Action
{
	protected $_form = null;

	
	public function getForm($id = false) {
		if (null === $this->_form) {
			$this->_form = new Form_CircunferenciaCintura ( array ('action' => 'add', 'method' => 'post', 'id' => 'fCintura' ) );
		}
		return $this->_form;
	}
	
	public function indexAction() {
		$mCinturas = new Model_CircunferenciaCintura ();
		
		$cinturas = $mCinturas->listarClassificacoes();
		
		if ($cinturas) {
			$paginator = Zend_Paginator::factory ( $cinturas );
			$paginator->setItemCountPerPage ( 10 );
			$paginator->setCurrentPageNumber ( $this->_request->getParam ( 'pagina' ) );
			$this->view->paginator = $paginator;
		
		} 
	}
	
	public function addAction() {
        $this->view->title = "Inserir Classificação da Circunferência da Cintura";
     	$this->view->headTitle ( $this->view->title, 'PREPEND' );
        $form = $this->getForm ();
        $form->submit->setLabel('Inserir');
        if ($this->getRequest()->isPost()){
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		try {
					$cinturas = new Model_CircunferenciaCintura ();
					if ($cinturas->insert ($formData )) {
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
        $this->view->title = "Editar Classificação da Circunferência da Cintura";
     	$this->view->headTitle ( $this->view->title, 'PREPEND' );
        $form = $this->getForm ();
        $form->addElement('hidden', 'cod_class');
        $form->submit->setLabel('Salvar');
        if ($this->getRequest()->isPost()){
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		try {
					$cinturas = new Model_CircunferenciaCintura ();
					if ($cinturas->update($formData )) {
        				$this->_helper->FlashMessenger(array('mensagemsucesso' => Mensagem::getMensagem('MSG-02')));
						$this->_helper->redirector('index');                   	
                    	
        			}
        		} catch ( Exception $e ) {
       				$form->populate($formData);
	        		$this->_helper->FlashMessenger(array('mensagemerro' => Mensagem::getMensagem('MSG-10')));
        		}
        	}
        } else {
        	$cod_class = $this->_getParam('cod_class',0);
        	$cinturas = new Model_CircunferenciaCintura ();
        	$cintura = $cinturas->getClassificacao($cod_class);
        	if ($cintura) {
				$form->populate($cintura);        		
        		
        	} else {
        		$this->_helper->FlashMessenger(array('mensagemerro' => Mensagem::getMensagem('MSG-09')));
				$this->_helper->redirector('add');                   	
        	}
        	
        }
        $this->view->form = $form;
		
	}

}