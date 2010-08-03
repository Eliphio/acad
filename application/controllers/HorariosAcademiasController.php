<?php

class HorariosAcademiasController extends Zend_Controller_Action
{
	
	protected $_form;
	
	public function getForm($id = false) {
		if (null === $this->_form) {
			$this->_form = new Form_HorariosAcademias ( array ('action' => 'add', 'method' => 'post', 'id' => 'fHorario' ) );
		}
		return $this->_form;
	}
	
	public function indexAction() {
		$mHorario = new Model_HorariosAcademias ();
		
		$horario = $mHorario->listarHorarios();
		
		if ($horario) {
			$paginator = Zend_Paginator::factory ( $horario );
			$paginator->setItemCountPerPage ( 10 );
			$paginator->setCurrentPageNumber ( $this->_request->getParam ( 'pagina' ) );
			$this->view->paginator = $paginator;
		
		} 
	}
	
	public function addAction() {
        $this->view->title = "Inserir Horário de Funcionamento";
     	$this->view->headTitle ( $this->view->title, 'PREPEND' );
        $form = $this->getForm ();
        $form->submit->setLabel('Inserir');
        if ($this->getRequest()->isPost()){
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		try {
					$horarios = new Model_HorariosAcademias();
					if ($horarios->insert ($formData )) {
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
        $this->view->title = "Editar Horário de Funcionamento";
     	$this->view->headTitle ( $this->view->title, 'PREPEND' );
        $form = $this->getForm ();
        $form->addElement('hidden', 'cod_hor');
        $form->submit->setLabel('Salvar');
        if ($this->getRequest()->isPost()){
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		try {
					$horarios = new Model_HorariosAcademias();
					if ($horarios->update($formData )) {
        				$this->_helper->FlashMessenger(array('mensagemsucesso' => Mensagem::getMensagem('MSG-02')));
						$this->_helper->redirector('index');                   	
                    	
        			}
        		} catch ( Exception $e ) {
       				$form->populate($formData);
	        		$this->_helper->FlashMessenger(array('mensagemerro' => Mensagem::getMensagem('MSG-10')));
        		}
        	}
        } else {
        	$cod_hor = $this->_getParam('cod_hor',0);
        	$horarios = new Model_HorariosAcademias();
        	$horario = $horarios->getHorario($cod_hor);
        	if ($horario) {
				$form->populate($horario);        		
        		
        	} else {
        		$this->_helper->FlashMessenger(array('mensagemerro' => Mensagem::getMensagem('MSG-09')));
				$this->_helper->redirector('add');                   	
        	}
        	
        }
        $this->view->form = $form;
		
	}

}	