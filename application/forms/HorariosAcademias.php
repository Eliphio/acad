<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_HorariosAcademias extends Form_PadraoForm 
{
	
	public function __construct($options = null) {
 		
		$academias = new Model_Academias();
		$optAcademias = $academias->_getToSelect('cod_acad','nom_acad');
		
		$this->addElement('select', 'cod_acad', array(
            'label' 		=> 'Academia',
        	'multioptions'	=>	$optAcademias,
        	'required' 		=> true
        ));

        $this->addElement('text', 'desc_hor', array(
            'label' 		=> 'Horário',
        	'size'			=>	15,
        	'required' 		=> true
        ));
        
        
        $this->addElement('text', 'vagas_turma_a', array(
            'label' 		=> 'Vagas Turma A',
        	'size'			=>	10,
        	'required' 		=> true
        ));
        
        $this->addElement('text', 'vagas_turma_b', array(
            'label' 		=> 'Vagas Turma B',
        	'size'			=>	10,
        	'required' 		=> true
        ));
        
        $this->addGroup('gHorário', 'Horário de Funcionamento');
		$this->addElement('Submit','submit',array(
		     'required'   => false,
		     'ignore'     => true,
		));
		parent::__construct($options);		
	}
}