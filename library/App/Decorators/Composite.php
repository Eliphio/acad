<?php

require_once ('Zend\Form\Decorator\Marker\File\Interface.php');
require_once ('Zend\Form\Decorator\Abstract.php');

class App_Decorators_Composite extends Zend_Form_Decorator_Abstract implements Zend_Form_Decorator_Marker_File_Interface {

    public function buildLabel()
    {
        $element = $this->getElement();
        $label = $element->getLabel();
        if ($translator = $element->getTranslator()) {
            $label = $translator->translate($label);
        }

        /* Se o elemento for requerido, será adicionado um "*" após o seu nome */
        if ($element->isRequired()) {
            $label .= ' *';
        }
        $label .= ':';
        return $element->getView()
                       ->formLabel($element->getName(), $label);
    }

    public function buildInput()
    {
        $element = $this->getElement();
        $helper  = $element->helper;
        return $element->getView()->$helper(
            $element->getName(),
            $element->getValue(),
            $element->getAttribs(),
            $element->options
        );
    }

    public function buildErrors()
    {
        $element  = $this->getElement();
        $messages = $element->getMessages();
        if (empty($messages)) {
            return '';
        }
        return '
<div class="errors">' .
               $element->getView()->formErrors($messages) . '</div>
';
    }

    public function buildDescription()
    {
        $element = $this->getElement();
        $desc    = $element->getDescription();
        if (empty($desc)) {
            return '';
        }
        return '
<div class="description">' . $desc . '</div>
';
    }

    public function render($content)
    {
        $element = $this->getElement();
        if (!$element instanceof Zend_Form_Element) {
            return $content;
        }
        if (null === $element->getView()) {
            return $content;
        }

        /* Gera todos os códigos */
        $separator = $this->getSeparator();
        $placement = $this->getPlacement();
        $label     = $this->buildLabel();
        $input     = $this->buildInput();
        $errors    = $this->buildErrors();
        $desc      = $this->buildDescription();

        /* Cria o elemento usando div */
        $output = //'<div class="form element">'. 
        		$label
                . $input
                . $errors
                . $desc;
                //. '</div>';

        switch ($placement) {
            case (self::PREPEND):
                return $output . $separator . $content;
            case (self::APPEND):
            default:
                return $content . $separator . $output;
        }
    }
}
