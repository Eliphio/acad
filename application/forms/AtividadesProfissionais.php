<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_AtividadesProfissionais extends Form_PadraoForm 
{
	
	public function __construct($options = null) {
        $this->addElement('text', 'desc_ativ', array(
            'label'      => 'Descrição da Atividade Profissional',
        	'size' 	=> 60,
        	'required' => true
        
        ));
        
        $this->addGroup('gAtividade', 'Atividade Profissional');
        
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