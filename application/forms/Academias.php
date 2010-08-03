<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_Academias extends Form_PadraoForm 
{
	
	public function __construct($options = null) {

        $regionais = new Model_Regionais();
        $optRegionais = $regionais->_getToSelect('cod_regi','desc_regi');

        $profis = new Model_ProfissionaisSaude();
        $optProfis = $profis->_getToSelect('cod_profis','nom_profis');
 		
		$optTurno = array(1 => 'MANHÃ', 2 => 'TARDE', 3 => 'NOITE');	
        
        $this->addElement('text', 'nom_acad', array(
            'label'      => 'Nome da Academia',
        	'size' 	=> 70,
        	'required' => true
        ));

        $this->addElement('select', 'reg_acad', array(
            'label'      => 'Regional',
        	'multiOptions'=> $optRegionais,
        	'required' => true
        ));
        $this->addElement('radio', 'tur_acad', array(
            'label'      => 'Turno de funcionamento',
        	'required' => true,
        	'multiOptions' => $optTurno
        ));
        $this->addElement('select', 'tip_logr', array(
            'label'      => 'Tipo de Logradouro',
        	'multiOptions'=>array(1 => 'Rua'),
        	'required' => true
        ));
        $this->addElement('text', 'nom_logr', array(
            'label'      => 'Logradouro',
        	'size' 	=> 70,
        	'required' => true
        ));
        $this->addElement('text', 'num_imov', array(
            'label'      => 'Número',
        	'size' 	=> 10,
        	'required' => true
        
        ));
        $this->addElement('text', 'cmpl_endr', array(
            'label'      => 'Complemento',
        	'size' 	=> 40,
        	'required' => true
        
        ));
        $this->addElement('text', 'nom_bair', array(
            'label'      => 'Bairro',
        	'size' 	=> 70,
        	'required' => true
        
        ));
        $this->addElement('text', 'fone_acad', array(
            'label'      => 'Telefone',
        	'size' 	=> 15,
        	'required' => true
        
        ));
        $this->addElement('select', 'prof_resp', array(
            'label'      => 'Professor Responsável',
        	'multiOptions'=>$optProfis,
        	'required' => true
        
        ));
        $this->addElement('textarea', 'obs_gerais', array(
            'label' 	=> 'Observações',
        	'rows' 		=> 5,
        	'required' 	=> true
        
        ));
        
        $this->addGroup('gAcademia', 'Academia');
		$this->addElement('Submit','submit',array(
		     'required'   => false,
		     'ignore'     => true,
		));
		
 		parent::__construct($options); 
	}
}