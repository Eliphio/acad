<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_PorcentagemGordura extends Form_PadraoForm 
{
	
	public function __construct($options = null) {

		$this->addElement('radio', 'cod_sex', array(
            'label'     	=> 'Sexo',
        	'multiOptions' 	=> array(0 => 'Feminino', 1 => 'Masculino'),
        	'required' 		=> true
        ));

        $this->addElement('text', 'lim_inf', array(
            'label' 		=> 'Limte Inferior',
        	'size'			=>	10,
        	'required' 		=> true
        ));
        
        $this->addElement('text', 'lim_sup', array(
            'label' 		=> 'Limite Superior',
        	'size'			=>	10,
        	'required' 		=> true
        ));
        
        $this->addElement('text', 'desc_clss', array(
            'label' 		=> 'Classificação',
        	'size'			=>	60,
        	'required' 		=> true
        ));
        
        
        $this->addGroup('gPrcGord', 'Classificação da Porcentagem de Gordura');
		$this->addElement('Submit','submit',array(
		     'required'   => false,
		     'ignore'     => true,
		));
		parent::__construct($options);
	}
	
} 