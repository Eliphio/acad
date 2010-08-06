<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_EquipesUbs extends Form_PadraoForm 
{
	
	public function __construct($options = null) {
        $unidades = new Model_Unidades();
        $optUnidades = $unidades->_getToSelect('cod_unsa','desc_unsa');
 		
 		
        $this->addElement('select', 'cod_unsa', array(
            'label'     	=> 'Unidade de Saúde',
        	'multiOptions' 	=> $optUnidades,
        	'required' 		=> true
        ));

        $this->addElement('text', 'desc_eqp_ubs', array(
            'label' 		=> 'Descritivo Equipe',
        	'size'			=>	60,
        	'required' 		=> true
        ));
        
		if (!isset($options['byAjax'])){
        	$this->addGroup('gEquipe', 'Equipe');
		}
		$this->addElement('Submit','submit',array(
		     'required'   => false,
		     'ignore'     => true,
		));

		parent::__construct($options);
	}
}