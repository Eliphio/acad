<?php

//require_once ('Zend\Dojo\Form\Element\DijitMulti.php');

class App_Multicheckbox extends Zend_Dojo_Form_Element_DijitMulti {

    /**
     * Is the checkbox checked?
     * @var bool
     */
   	
    public $helper = 'FormMultiCheckbox';

	protected $_registerInArrayValidator = false;
	
    
}