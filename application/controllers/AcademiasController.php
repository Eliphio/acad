<?php
/**
 * 
 * @author Elan
 *
 */
class AcademiasController extends Zend_Controller_Action 
{
	
	protected $_form = null;

	
	public function getForm($id = false) {
		if (null === $this->_form) {
			$this->_form = new Form_Academias ( array ('action' => 'add', 'method' => 'post', 'id' => 'fAcademias' ) );
		}
		return $this->_form;
	}
	
	public function indexAction() {
		$mAcademias = new Model_Academias ();
		
		$academias = $mAcademias->listarAcademias ();
		
		if ($academias) {
			$paginator = Zend_Paginator::factory ( $academias );
			$paginator->setItemCountPerPage ( 10 );
			$paginator->setCurrentPageNumber ( $this->_request->getParam ( 'pagina' ) );
			$this->view->paginator = $paginator;
		
		} 
	}
	
	public function addAction() {
        $this->view->title = "Inserir Academia";
     	$this->view->headTitle ( $this->view->title, 'PREPEND' );
        $form = $this->getForm ();
        $form->submit->setLabel('Inserir');
        if ($this->getRequest()->isPost()){
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		try {
					$academias = new Model_Academias();
					if ($academias->insert ($formData )) {
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
        $this->view->title = "Editar Academia";
     	$this->view->headTitle ( $this->view->title, 'PREPEND' );
        $form = $this->getForm ();
        $form->addElement('hidden', 'cod_acad');
        $form->submit->setLabel('Salvar');
        if ($this->getRequest()->isPost()){
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		try {
					$academias = new Model_Academias();
					if ($academias->update($formData )) {
        				$this->_helper->FlashMessenger(array('mensagemsucesso' => Mensagem::getMensagem('MSG-02')));
						$this->_helper->redirector('index');                   	
                    	
        			}
        		} catch ( Exception $e ) {
       				$form->populate($formData);
	        		$this->_helper->FlashMessenger(array('mensagemerro' => Mensagem::getMensagem('MSG-10')));
        		}
        	}
        } else {
        	$cod_acad = $this->_getParam('cod_acad',0);
        	$academias = new Model_Academias();
        	$academia = $academias->getAcademia($cod_acad);
        	if ($academia) {
				$form->populate($academia);        		
        		
        	} else {
        		$this->_helper->FlashMessenger(array('mensagemerro' => Mensagem::getMensagem('MSG-09')));
				$this->_helper->redirector('add');                   	
        	}
        	
        }
        $this->view->form = $form;
		
	}

}