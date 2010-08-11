<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_Pesquisa extends  Form_PadraoForm
{
	
	public function __construct($options = null) {
		$this->addElement('Text', 'nome',array(
            'label'      => 'Digite o nome para pesquisar:',
        	'style'=> 'width: 90%',
			'required' => true));
		
		$this->addElement(
		    'submit',
		    'submit',
		    array(
		        'required'   => false,
		        'ignore'     => true,
		        'label'      => 'Salvar',
		    )
		);     
        
        $this->addGroup('gPsq', 'Pesquisar');
        parent::__construct($options);
        
	}
}