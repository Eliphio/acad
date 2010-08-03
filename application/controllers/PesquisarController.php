<?php

class PesquisarController extends Zend_Controller_Action
{
    protected $_dados;
    protected $_controller;
    protected $_action;
    protected $_form;
    
    public function init() {
        $session = new Zend_Session_Namespace('redir');
        $this->_controller = $session->request['controller'];
        $this->_action = $session->request['action'];        
        
    }
    
    public function getForm ($id = false)
    {
        if (null === $this->_form) {
            $this->_form = new Form_Pesquisa(array('action' => 'pesquisar' , 'method' => 'post' , 'id' => 'fPesquisar' ,'onsubmit' => "return(validateForm('fPesquisar'))"));
        }
        return $this->_form;
    }
    
    
    
    public function indexAction()
    {
    	if ($this->_request->isPost())
    	{       $nome = $this->_request->getPost('nome');		
    			if (strlen($nome) > 0)
    			{
	        		$request = clone $this->getRequest();
	        		$request->setActionName('pesquisar');//Define a action a ser acessada
					$request->setParams(array('nome'=> $nome));
	        		$this->_helper->actionStack($request);//Chama a action definida no controller definido
    			}
    		
    	} else {
	    	$form = $this->getForm();
	    	$this->view->form = $form;         
    	}
    	
        
    }

    public function pesquisarAction()
    {
    	$dados = new Model_DadosCadastrais();
        $this->_dados = $dados->pesquisaNome($this->_request->getParam('nome'));
        $this->view->dados = $this->_dados;
        $this->view->reqController = $this->_controller; 
        $this->view->reqAction = $this->_action;
    }


}



