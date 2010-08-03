<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_PressaoArterial extends Form_PadraoForm 
{
	
	
	public function __construct($options = null) {

		$this->addElement('text', 'situa_categ', array(
            'label' 		=> 'Categoria',
        	'size'			=>	60,
        	'required' 		=> true
        ));
 		
        $this->addElement('text', 'pres_sisto_inf', array(
            'label' 		=> 'Limte Inferior - Sistólica',
        	'size'			=>	10,
        	'required' 		=> true
        ));
        
        $this->addElement('text', 'pres_sisto_sup', array(
            'label' 		=> 'Limite Superior - Sistólica',
        	'size'			=>	10,
        	'required' 		=> true
        ));
        
        $this->addElement('text', 'pres_diast_inf', array(
            'label' 		=> 'Limte Inferior - Diastólica',
        	'size'			=>	10,
        	'required' 		=> true
        ));
        
        $this->addElement('text', 'pres_diast_sup', array(
            'label' 		=> 'Limite Superior - Diastólica',
        	'size'			=>	10,
        	'required' 		=> true
        ));
        
        $this->addElement('text', 'situa_profis_edc_fis', array(
            'label' 		=> 'Área de trabalho do Profissional de Educação Física',
        	'size'			=>	60,
        	'required' 		=> true
        ));
        
        $this->addGroup('gPrssArt', 'CLASSIFICAÇÃO DA PRESSÃO ARTERIAL DE ADULTOS COM 18 ANOS EM REPOUSO');
		$this->addElement('Submit','submit',array(
		     'required'   => false,
		     'ignore'     => true,
		));
		parent::__construct($options);		
	}
	
} 