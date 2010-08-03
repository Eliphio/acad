<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_Medicamentos extends Form_PadraoForm 
{
	
	public function __construct($options = null) {
 		$familia = array
 		(
 			1 => 'ANTIDEPRESSIVOS E ANSIOLÍTICOS',
 			2 => 'ANALGÉSICOS E ANTINFLAMATÓRIOS',
 			3 => 'CARDIOVASCULARES/ANTIHIPERTENSIVOS',
 			4 => 'ANTIDIABÁTICOS ORAIS/HIPOGLICEMIANTES',
 			5 => 'PARA DISLIPIDEMIAS',
 		);
 		

        $this->addElement('radio', 'cod_fami_medic', array(
            'label' 		=> 'Família',
        	'size'			=>	10,
        	'multiOptions'	=> $familia,
        	'required' 		=> true
        ));
        
        
        $this->addElement('text', 'nom_medic', array(
            'label' 		=> 'Nome',
        	'size'			=>	60,
        	'required' 		=> true
        ));
        
        $this->addElement('text', 'apres_medic', array(
            'label' 		=> 'Apresentação',
        	'size'			=>	60,
        	'required' 		=> true
        ));
        
        $this->addGroup('gMedicamento', 'Medicamento');
		$this->addElement('Submit','submit',array(
		     'required'   => false,
		     'ignore'     => true,
		));
		parent::__construct($options);
	}
}