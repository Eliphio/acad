<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_Regionais extends Form_PadraoForm 
{
	
	public function __construct($options = null) {
        
        $this->addElement('text', 'cod_regi', array(
            'label'      => 'Código da Reginal',
        	'size' 	=> 15,
        	'required' => true
        
        ));
        $this->addElement('text', 'desc_regi', array(
            'label'      => 'Descrição',
        	'size' 	=> 60,
        	'required' => true
        
        ));

        $this->addGroup('gRegional', 'Regional');
        
		$this->addElement(
		    'Submit',
		    'submit',
		    array(
		        'required'   => false,
		        'ignore'     => true,
		    )
		);
		parent::__construct($options);
	}
}