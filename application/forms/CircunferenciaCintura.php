<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_CircunferenciaCintura extends Form_PadraoForm 
{
	
	public function __construct($options = null) {
 		
        $this->addElement('text', 'desc_class', array(
            'label'      => 'Descrição da Classificação',
        	'size' 	=> 80,
        	'required' => true
        ));

        $this->addElement('radio', 'cod_sexo', array(
            'label'      => 'Sexo',
        	'multiOptions' => array(0 => 'Feminino', 1 => 'Masculino'),
        	'required' => true
        ));
        
        $this->addElement('text', 'vlr_medi', array(
            'label'      => 'Valor Medido',
        	'size' 	=> 10,
        	'required' => true
        ));

        $this->addGroup('gCintura', 'Classificação da Circunferencia da Cintura');
		$this->addElement('Submit','submit',array(
		     'required'   => false,
		     'ignore'     => true,
		));
		parent::__construct($options);
	}
}