<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_Cbor extends Form_PadraoForm 
{
	
	public function __construct($options = null) {
        
        $this->addElement('text', 'cod_sgrp_cbo', array(
            'label'      => 'Código Subgrupo',
        	'size' 	=> 10,
        	'required' => true
        ));

        $this->addElement('text', 'desc_sgrp_cbo', array(
            'label'      => 'Descrição Subgrupo',
        	'size' => 80,
        	'required' => true
        ));
        
        $this->addElement('text', 'cod_grupo_cbo', array(
            'label'      => 'Código Grupo',
        	'size' 	=> 10,
        	'required' => true
        ));

        $this->addElement('text', 'desc_reduzida_sgrp_cbo', array(
            'label'      => 'Descrição Grupo',
        	'size' => 80,
        	'required' => true
        ));
        
        $this->addElement('text', 'cod_sgrp_cbo_2002', array(
            'label'      => 'Código Subgrupo 2002',
        	'size' 	=> 10,
        	//'required' => true
        ));

        $this->addGroup('gCbor', 'Ocupação');
		$this->addElement('Submit','submit',array(
		     'required'   => false,
		     'ignore'     => true,
		));
		parent::__construct($options);
	}
}