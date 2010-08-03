<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_ClassificacaoFlexibilidade extends Form_PadraoForm 
{
	
	public function __construct($options = null) {
 		
        $this->addElement('text', 'lim_inf', array(
            'label'     => 'Limite Inferior',
        	'size' 		=> 10,
        	'required' 	=> true
        ));

        $this->addElement('text', 'lim_sup', array(
            'label' 	=> 'Limite Superior',
        	'size'		=>	10,
        	'required' 	=> true
        ));
        
        $this->addElement('text', 'desc_class', array(
            'label'      => 'Descrição da Classificação',
        	'size' 	=> 80,
        	'required' => true
        ));

        $this->addGroup('gFlex', 'Classificação da Flexibilidade');
		$this->addElement('Submit','submit',array(
		     'required'   => false,
		     'ignore'     => true,
		));
		parent::__construct($options);
	}
}