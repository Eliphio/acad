<?php
/**
 * Cria o objeto do form indicado
 * @author Elan Martins elan@pbh.gov.br
 * @version 1.0
 *
 */
class App_Helpers_Formulario extends Zend_Controller_Action_Helper_Abstract
{
/**
 * intancia o formulário
 * exemplo para o parametro: $opcoes
 * $opcoes['id'] = para salvar uma edição de dados
 * $opcoes['url'] = url da action
 * @param string  $opcoes
 * @param Array $opcoes
 * @return Object
 */    
    
    public function criar($formulario, array $opcoes = null) {
        
        $id = $opcoes['id'];
        /**
         * gera parametro "id" caso o mesmo seja informado (para URL de editar) 
         */
        if ($id)
            $id = "/id/".$id;
        /**
         * Instancia o formulario informado
         */
        $form = new $formulario(array(
                                       'action'	 => $opcoes['url'].$id,
                                        'method' => 'post',
                                        'id' => $formulario,),
                                $opcoes);
        return $form;                                                                      
    }
    
}
?>