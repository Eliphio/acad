<?php

class ClassificacaoFlexibilidadeController extends Zend_Controller_Action
{

	protected $_form = null;

	
	public function getForm($id = false) {
		if (null === $this->_form) {
			$this->_form = new Form_ClassificacaoFlexibilidade ( array ('action' => 'add', 'method' => 'post', 'id' => 'fFlex' ) );
		}
		return $this->_form;
	}
	
	public function indexAction() {
		$mFlexibilidade = new Model_ClassificacaoFlexibilidade ();
		
		$flexibilidade = $mFlexibilidade->listarClassificacoes();
		
		if ($flexibilidade) {
			$paginator = Zend_Paginator::factory ( $flexibilidade );
			$paginator->setItemCountPerPage ( 10 );
			$paginator->setCurrentPageNumber ( $this->_request->getParam ( 'pagina' ) );
			$this->view->paginator = $paginator;
		
		} 
	}
	
	public function addAction() {
        $this->view->title = "Inserir Classificação da Flexibilidade";
     	$this->view->headTitle ( $this->view->title, 'PREPEND' );
        $form = $this->getForm ();
        $form->submit->setLabel('Inserir');
        if ($this->getRequest()->isPost()){
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		try {
					$flexibilidades = new Model_ClassificacaoFlexibilidade ();
					if ($flexibilidades->insert ($formData )) {
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
        $this->view->title = "Editar Classificação da Flexibilidade";
     	$this->view->headTitle ( $this->view->title, 'PREPEND' );
        $form = $this->getForm ();
        $form->addElement('hidden', 'cod_flex');
        $form->submit->setLabel('Salvar');
        if ($this->getRequest()->isPost()){
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		try {
					$flexibilidades = new Model_ClassificacaoFlexibilidade ();
					if ($flexibilidades->update($formData )) {
        				$this->_helper->FlashMessenger(array('mensagemsucesso' => Mensagem::getMensagem('MSG-02')));
						$this->_helper->redirector('index');                   	
                    	
        			}
        		} catch ( Exception $e ) {
       				$form->populate($formData);
	        		$this->_helper->FlashMessenger(array('mensagemerro' => Mensagem::getMensagem('MSG-10')));
        		}
        	}
        } else {
        	$cod_flex = $this->_getParam('cod_flex',0);
        	$flexibilidades = new Model_ClassificacaoFlexibilidade ();
        	$flexibilidade = $flexibilidades->getClassificacao($cod_flex);
        	if ($flexibilidade) {
				$form->populate($flexibilidade);        		
        		
        	} else {
        		$this->_helper->FlashMessenger(array('mensagemerro' => Mensagem::getMensagem('MSG-09')));
				$this->_helper->redirector('add');                   	
        	}
        	
        }
        $this->view->form = $form;
		
	}

}	