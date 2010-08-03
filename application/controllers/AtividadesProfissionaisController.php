<?php

class AtividadesProfissionaisController extends Zend_Controller_Action 
{
	protected $_form = null;

	
	public function getForm($id = false) {
		if (null === $this->_form) {
			$this->_form = new Form_AtividadesProfissionais ( array ('action' => 'add', 'method' => 'post', 'id' => 'fAcademias' ) );
		}
		return $this->_form;
	}
	
	public function indexAction() {
		$mAtividades = new Model_AtividadesProfissionais();
		
		$atividades = $mAtividades->listarAtividades ();
		
		if ($atividades) {
			$paginator = Zend_Paginator::factory ( $atividades );
			$paginator->setItemCountPerPage ( 10 );
			$paginator->setCurrentPageNumber ( $this->_request->getParam ( 'pagina' ) );
			$this->view->paginator = $paginator;
		
		} 
	}
	
	public function addAction() {
        $this->view->title = "Inserir Atividade";
     	$this->view->headTitle ( $this->view->title, 'PREPEND' );
        $form = $this->getForm ();
        $form->submit->setLabel('Inserir');
        if ($this->getRequest()->isPost()){
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		try {
					$atividades = new Model_AtividadesProfissionais();
					if ($atividades->insert ($formData )) {
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
        $this->view->title = "Editar Atividade";
     	$this->view->headTitle ( $this->view->title, 'PREPEND' );
        $form = $this->getForm ();
        $form->addElement('hidden', 'cod_ativ');
        $form->submit->setLabel('Salvar');
        if ($this->getRequest()->isPost()){
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		try {
					$atividades = new Model_AtividadesProfissionais();
					if ($atividades->update($formData )) {
        				$this->_helper->FlashMessenger(array('mensagemsucesso' => Mensagem::getMensagem('MSG-02')));
						$this->_helper->redirector('index');                   	
                    	
        			}
        		} catch ( Exception $e ) {
       				$form->populate($formData);
	        		$this->_helper->FlashMessenger(array('mensagemerro' => Mensagem::getMensagem('MSG-10')));
        		}
        	}
        } else {
        	$cod_ativ = $this->_getParam('cod_ativ',0);
        	$atividades = new Model_AtividadesProfissionais();
        	$atividade = $atividades->getAtividade($cod_ativ);
        	if ($atividade) {
				$form->populate($atividade);        		
        		
        	} else {
        		$this->_helper->FlashMessenger(array('mensagemerro' => Mensagem::getMensagem('MSG-09')));
				$this->_helper->redirector('add');                   	
        	}
        	
        }
        $this->view->form = $form;
		
	}

}
	