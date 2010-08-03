<?php
require_once('Zend/Controller/Action.php');
class AnamneseController extends App_Controller_PadraoController
{

    protected $_form;
    protected $_dados;
    public function getForm ($id = false)
    {
        if (null === $this->_form) {
            $this->_form = new Form_Anamnese(array('action' => 'add' , 'method' => 'post' , 'id' => 'fAnamnese' ,'onsubmit' => "return(validateForm('fAnamnese'))"));
        }
		
        return $this->_form;
    }
	
    public function addAction()
    {
    	
        $this->view->title = "Anamese";
        $this->view->headTitle($this->view->title, 'PREPEND');
        $this->getForm();
        $this->_form->addElement('hidden','cod_usua',array('value'=>$this->_request->getParam('cod_usua')));
		$this->_form->addElement('hidden','ind_reav',array('value'=>$this->_request->getParam('ind_reav')));        
        $form = $this->_form; 
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $this->_dados = $this->getRequest()->getPost();
	        if ($form->isValid($this->_dados)) {
	            $anamnese = new Model_Anamnese();
	   	        try {
	        		if ($anamnese->insert($this->_dados)){
	    				$msg = new Mensagem();
	    				$this->view->mensagem = $msg->getMensagem('MSG-01');
	    				$this->view->estiloMsg = "mensagemsucesso";
	    				$this->view->form->reset();
	        		}
	            } catch (Exception $e) {
	                $this->view->form->populate($this->_dados);
	                $this->view->mensagem = $e->getMessage();
	                $this->view->estiloMsg = "mensagemerro";
	            }            	
            }
        }
    }

    public function editAction()
    {
        // action body
    }


}





