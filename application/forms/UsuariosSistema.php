<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_UsuariosSistema extends Form_PadraoForm 
{
	
	public function __construct($options = null) {
 
        $profissionais = new Model_ProfissionaisSaude();
        $optProfis = $profissionais->_getToSelect('cod_profis','nom_profis');
 		
 		
        $this->addElement('select', 'cod_profis', array(
            'label'			=> 'Nome Profissional',
        	'required'		=> true,
        	'multiOptions'	=> $optProfis,
        ));
 		 		
 		
        $html = new App_Htmlform ('teste');
        $url = new Zend_View_Helper_BaseUrl;
		$html->setValue("<a href=\"".$url->getBaseUrl()."/Profissionais-saude/add\">Novo Profissional</a>"); 
		$this->addElement($html);
		
		
        $this->addElement('text', 'log_usua', array(
            'label'      => 'Login',
        	'size' 	=> 15,
        	'style'=> 'width: 40%',
        	'required' => true
        
        ));
        $this->addElement('password', 'sen_usua', array(
            'label'      => 'Senha',
        	'size' 	=> 15,
        	'style'=> 'width: 40%',
        	'required' => true,
        ));
        
        $this->addGroup('gUsuaSist', 'Usuarios do Sistema');
        
		$this->addElement('Submit','submit',array(
		     'required'   => false,
		     'ignore'     => true,
		));
		parent::__construct($options);

	}
}