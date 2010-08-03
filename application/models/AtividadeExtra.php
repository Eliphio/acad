<?php
class Model_AtividadeExtra extends Model_PadraoModelos
{
    protected $_name = 'atividade_extra';
    protected $_primary = array('cod_usua','ativ_freq');
    protected $_referenceMap = array(array(	'refTableClass'  => 'Model_DadosCadastrais',
                                            	'refColumns'     => array('cod_usua'),
                                            	'columns'        => array('cod_usua')));   

    
}
