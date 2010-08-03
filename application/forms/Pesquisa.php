<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_Pesquisa extends  Form_PadraoForm
{
	
	public function __construct($options = null) {
		$this->addElement('ValidationTextBox', 'nome',array(
            'label'      => 'Digite o nome para pesquisar:',
        	'style'=> 'width: 90%',
			'required' => true));
		
		$this->addElement('SubmitButton','foo',array(
		    'required'   => false,
		    'ignore'     => true,
		    'label'      => 'Pesquisar',
		    ));        
        
        $this->addGroup('gPsq', 'Pesquisar');
        parent::__construct($options);
        
	}
}