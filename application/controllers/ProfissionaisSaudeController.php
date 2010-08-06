<?php

class ProfissionaisSaudeController extends Zend_Controller_Action
{
	
	protected $_form = null;

	
	public function getForm($id = false) {
		if (null === $this->_form) {
			$this->_form = new Form_ProfissionaisSaude ( array ('action' => 'add', 'method' => 'post', 'id' => 'fProfissional' ) );
		}
		return $this->_form;
	}
	
	public function indexAction() {
		$mProfissionais = new Model_ProfissionaisSaude();
		
		$profissionais = $mProfissionais->listarProfissionais();
		
		if ($profissionais) {
			$paginator = Zend_Paginator::factory ( $profissionais );
			$paginator->setItemCountPerPage ( 10 );
			$paginator->setCurrentPageNumber ( $this->_request->getParam ( 'pagina' ) );
			$this->view->paginator = $paginator;
		
		} 
	}
	
	public function addAction() {
        $this->view->title = "Inserir Profissional";
     	$this->view->headTitle ( $this->view->title, 'PREPEND' );
        $form = $this->getForm ();
        $form->submit->setLabel('Inserir');
        if ($this->getRequest()->isPost()){
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		try {
					$profissionais = new Model_ProfissionaisSaude();
					if ($profissionais->insert ($formData )) {
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
        $this->view->title = "Editar Profissionais";
     	$this->view->headTitle ( $this->view->title, 'PREPEND' );
        $form = $this->getForm ();
        $form->addElement('hidden', 'cod_profis');
        $form->submit->setLabel('Salvar');
        if ($this->getRequest()->isPost()){
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		try {
					$profissionais = new Model_ProfissionaisSaude();
					if ($profissionais->update($formData )) {
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
        	$profissionais = new Model_ProfissionaisSaude();
        	$profissional = $profissionais->getProfissional($cod_profis);
        	if ($profissional) {
				$form->populate($profissional);        		
        		
        	} else {
        		$this->_helper->FlashMessenger(array('mensagemerro' => Mensagem::getMensagem('MSG-09')));
				$this->_helper->redirector('add');                   	
        	}
        	
        }
        $this->view->form = $form;
		
	}
	
	public function addbyajaxAction() {
		$dados = array('cod_ubs' => $this->_getParam('cod_unsa',0), 'cod_eqp_ubs' => $this->_getParam('cod_eqp_ubs',0));
        $form = new Form_ProfissionaisSaude ( array ('action' => Zend_Controller_Front::getInstance()->getBaseUrl(). '/Profissionais-saude/addbyajax', 'method' => 'post', 'id' => 'fProfissional' ,'byAjax'=> true) );
		$form->populate($dados);
        $form->submit->setLabel('Inserir');
        if ($this->getRequest()->isPost()){
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		try {
					$profissionais = new Model_ProfissionaisSaude();
					if ($profissionais->insert ($formData )) {
        				$return = array('msg' => Mensagem::getMensagem('MSG-01'), 'profis' => $profissionais->getAdapter ()->lastInsertId ());
											}
        		} catch ( Exception $e ) {
        			$form->populate($formData);
					$return=  Mensagem::getMensagem('MSG-10');        		
        		}
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