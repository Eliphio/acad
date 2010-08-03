<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_Rcq extends Form_PadraoForm 
{
	
	
	public function __construct($options = null) {

        $this->addElement('text', 'desc_class', array(
            'label' 		=> 'Classificação',
        	'size'			=>	60,
        	'required' 		=> true
        ));
 		
        $this->addElement('radio', 'cod_sexo', array(
            'label' 		=> 'Sexo',
        	'size'			=>	10,
        	'multiOptions'	=> array(0 => 'Feminino', 1 => 'Masculino'),
        	'required' 		=> true
        ));
        
        $this->addElement('text', 'vlr_medi', array(
            'label' 		=> 'Valor Medido',
        	'size'			=>	10,
        	'required' 		=> true
        ));
        
        $this->addGroup('gRcq', 'RCQ (CM cintura/CM quadril)');
		$this->addElement('Submit','submit',array(
		     'required'   => false,
		     'ignore'     => true,
		));
		parent::__construct($options);		
	}
	
} 