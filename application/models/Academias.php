<?php

/**
 * Academias
 * 
 * @author Elan
 * @version 
 */


class Model_Academias extends Model_PadraoModelos {
	/**
	 * The default table name 
	 */
	protected $_name = 'academias';
	protected $_primary = 'cod_acad';
	protected $_dependentTables = array('Model_HorariosAcademias');
    protected $_referenceMap = array
    (
    	array(
    		'refTableClass' => 'Model_ProfissionaisSaude',
    		'refColumns'	=> 'cod_profis',
    		'columns'		=> 'prof_resp',
    	),
    	
    );
	
	

	
	public function listarAcademias() {
		return $this->fetchAll();
	}
	
	public function getAcademia($cod_acad = 0) {
        $cod_acad = (int) $cod_acad;
        $row = $this->fetchRow('cod_acad = ' . $cod_acad);
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

		$cod_acad = $data['cod_acad'];
        unset($data['cod_acad']);
        $where = array('cod_acad = ?' => $cod_acad); 
		return (parent::update($data,$where));
		
	}
	
	
}

