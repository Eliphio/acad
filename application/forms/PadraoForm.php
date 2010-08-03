<?php

class Form_PadraoForm extends Zend_Form {
	public function __construct($options = null) {
 		parent::__construct($options); 
		$translate = Zend_Registry::get('translate');
        $this->setTranslator($translate);
        

 		
        $this->setElementDecorators(array(
		    array('ViewHelper'),
		    array('Errors'),
			array('Description', array('tag' => '','escape' => (bool) FALSE)),			
			array('HtmlTag', array('tag' => 'dd')),
			array('Label', array('tag' => 'dt')),   
	    	)
		);

        // buttons do not need labels
        $this->submit->setDecorators(array(
            array('ViewHelper'),
            array('Description'),
            array('HtmlTag', array('tag' => 'div', 'class'=>'submit-group')),
        ));
        
        
	}
    public function _getSN() {
    	$options = Array(0 => 'Não', 1 => 'Sim') ;
    	return $options;
    }

    public function addGroup($nome = false, $legend = false) {
    	if (!$nome)
    		return false;
    	else {
	    	$groups = array_keys($this->getDisplayGroups());
	        $elementos = array_keys($this->getElements());
	        foreach ($groups as $grupo) {
	        	$elem = array_keys($this->getDisplayGroup($grupo)->getElements());
	        	$elementos = array_diff($elementos, $elem);
	        }
	        if (!$legend)
	        	$legend = $nome;
	        $this->addDisplayGroup($elementos, $nome, array('legend'=>$legend));
    	}
    	
    }
    
}
