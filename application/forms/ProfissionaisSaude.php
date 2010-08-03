<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_ProfissionaisSaude extends Form_PadraoForm 
{
	
	public function __construct($options = null) {
 		
 		$regionais = new Model_Regionais();
        $optRegionais = $regionais->_getToSelect('cod_regi','desc_regi');
 		
        $atividades = new Model_AtividadesProfissionais();
        $optAtividades = $atividades->_getToSelect('cod_ativ','desc_ativ');
        
        $equipes = new Model_EquipesUbs();
        $optEquipes = $equipes->_getToSelect('cod_eqp_ubs', 'desc_eqp_ubs');
 		
        $unidade = new Model_Unidades();
        $optUBS = $unidade->_getToSelect('cod_unsa','desc_unsa');
         
        $this->addElement('text', 'nom_profis', array(
            'label'		=> 'Nome',
        	'size'		=> 60,
        	'required' 	=> true
        ));
        
        $this->addElement('select', 'cod_ativ', array(
            'label'      	=> 'Atividade',
        	'multiOptions' 	=> $optAtividades,
        	'required' 		=> true
        ));
        
        $this->addElement('select', 'cod_regi', array(
            'label'			=> 'Regional',
        	'multiOptions' 	=> $optRegionais,
        	'required'		=> true
        ));

        $this->addElement('select', 'cod_ubs', array(
            'label'			=> 'UBS',
        	'multiOptions'	=> $optUBS,
        ));
        
        $this->addElement('select', 'cod_eqp_ubs', array(
            'label'			=> 'Equipe',
        	'multiOptions'	=> $optEquipes,
        ));
        
        
        $this->addGroup('gProfissional', 'Profissional Saúde');
        
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