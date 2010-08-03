<?php
/**
 * 	[cod_unsa] [int] NOT NULL ,
	[cod_regi] [int] NOT NULL ,
	[desc_unsa] [varchar] (70) COLLATE Latin1_General_CI_AS NOT NULL ,

 * @author PS00287
 *
 */
class Form_Unidades extends Form_PadraoForm {
	public function __construct($options = null) {

		$regionais = new Model_Regionais();
        $optRegionais = $regionais->_getToSelect('cod_regi','desc_regi');

        $this->addElement('text', 'cod_unsa', array(
            'label'      => 'Código da Unidade',
        	'size' 	=> 15,
        	'required' => true
        ));

        $this->addElement('select', 'cod_regi', array(
            'label'      => 'Regional',
        	'multiOptions'=> $optRegionais,
        	'required' => true
        ));
        $this->addElement('text', 'desc_unsa', array(
            'label'      => 'Nome da Unidade',
        	'size' 	=> 70,
        	'required' => true
        
        ));
        
        $this->addGroup('gUnidades', 'Unidade Básica de Saúde');
		$this->addElement('Submit','submit',array(
		     'required'   => false,
		     'ignore'     => true,
		));
		parent::__construct($options);
	}
}