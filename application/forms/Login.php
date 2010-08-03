<?php

class Form_Login extends Form_PadraoForm {


	public function __construct($options = null){
        $this->clearDecorators();
        $this->addDecorator('FormElements')
	         ->addDecorator('Form');
        
        $this->setElementDecorators(array(
            array('ViewHelper'),
            array('Errors'),
            array('Description'),
            array('Label', array('separator'=>': ')),
        ));

        $view = $this->getView();		
		$this->setMethod('post');
		$this->setName('frmLgn');
        $this->setAction($view->url(array('controller' => 'index', 'action' => 'login'), 'default', 'true'));
				
        $this->addElement('text', 'login', array(
            'label'      => 'Usuário',
        	'size' 	=> 30,
        	'required' => true
        ));
        $this->addElement('password', 'senha', array(
            'label'      => 'Senha',
        	'size' 	=> 31,
        	'required' => true
        ));
        
        $campo = $this->createElement('submit','enviar');
		$campo->setRequired(false)
			  ->setIgnore(true)
			  ->setDecorators(array(
	            array('ViewHelper'),
	            array('Description')
	        ));			  
		$this->addElement($campo);
	}
}