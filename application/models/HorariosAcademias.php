<?php
/**
 * HorariosAcademia
 *  
 * @author PS00287
 * @version 
 */
class Model_HorariosAcademias extends Model_PadraoModelos
{
    /**
     * The default table name 
     */
    protected $_name = 'horarios_academias';
    protected $_primary = 'cod_hor';
    protected $_referenceMap = array
    (
    	array(
    		'refTableClass' => 'Model_Academias',
    		'refColumns'	=> 'cod_acad',
    		'columns'		=> 'cod_acad',
    	),
    	
    );
    
    
	public function listarHorarios() {
		return $this->fetchAll();
	}
	
	public function getHorario($cod_hor) {
		
		$cod_hor = (int) $cod_hor;
        $row = $this->fetchRow('cod_hor = ' . $cod_hor);
        if ($row) {
            return $this->retornafetchRow($row->toArray());
        } else {
        	return false;
        }
       
	}
	
	public function update(array $data) {
        $data = $this->preparaDados($data);

        if (!isset($data['cod_usua_alt'])) {
			$data['cod_usua_alt'] = $this->_usuario_sistema;
			$data['dat_alt'] = @date('Y-m-d H:i:s');
		} 

		$cod_hor = $data['cod_hor'];
        unset($data['cod_hor']);
        $where = array('cod_hor = ?' => $cod_hor); 
		return (parent::update($data,$where));
		
	}
	
    
    
}

