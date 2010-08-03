<?php

class App_Controller_PadraoController extends Zend_Controller_Action
{

    public function init()
    {
        $session = new Zend_Session_Namespace('redir');
        $session->request = $this->_request->getUserParams(); 
        if (!$this->_request->getParam('cod_usua'))
    	{
    		$this->_helper->Redirector->direct('index','Pesquisar');
    	}   
        
    }


}

