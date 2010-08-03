<?php
class Model_DiasSemana extends Model_PadraoModelos
{
    protected $_name = 'dias_semana';
    protected $_primary = array('cod_usua','dias_sem');
    protected $_referenceMap = array(array(	'refTableClass'  => 'Model_DadosCadastrais',
                                            	'refColumns'     => array('cod_usua'),
                                            	'columns'        => array('cod_usua')));   

    
}
