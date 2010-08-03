<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_Imc extends Form_PadraoForm 
{
	
	public function __construct($options = null) {
        $this->addElement('radio', 'cod_sex', array(
            'label'     	=> 'Sexo',
        	'multiOptions' 	=> array(0 => 'Feminino', 1 => 'Masculino'),
        	'required' 		=> true
        ));

        $this->addElement('text', 'idade', array(
            'label' 		=> 'Idade',
        	'size'			=>	10,
        	'required' 		=> true
        ));
        
        $this->addElement('text', 'est_nut1', array(
            'label' 		=> 'Estado Nutricional 1',
        	'size'			=>	10,
        	'required' 		=> true
        ));
        
        $this->addElement('text', 'est_nut2', array(
            'label' 		=> 'Estado Nutricional 2',
        	'size'			=>	10,
        	'required' 		=> true
        ));
        
        $this->addElement('text', 'est_nut3', array(
            'label' 		=> 'Estado Nutricional 3',
        	'size'			=>	10,
        	'required' 		=> true
        ));
        
        $this->addElement('text', 'est_nut4', array(
            'label' 		=> 'Estado Nutricional 4',
        	'size'			=>	10,
        	'required' 		=> true
        ));
        
        $this->addElement('text', 'est_nut5', array(
            'label' 		=> 'Estado Nutricional 5',
        	'size'			=>	10,
        	'required' 		=> true
        ));
        
        $this->addGroup('gImc', 'Índice de Massa Corpórea');
		$this->addElement('Submit','submit',array(
		     'required'   => false,
		     'ignore'     => true,
		));
		parent::__construct($options);
	}
}