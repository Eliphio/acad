<?php

/**
 * Anamnese
 * 
 * @author Elan
 * @version 
 */

class Model_Regionais extends Model_PadraoModelos {
	/**
	 * The default table name 
	 */
	protected $_name = 'regionais';
	protected $_primary = 'cod_regi';
	protected $_dependentTables = array('Model_Unidades');	
	
	public function listarRegionais() {
		return $this->retornafetchAll($this->fetchAll()->toArray());;
	}
	
	public function getRegional($cod_regi = 0) {
        $cod_regi = (int) $cod_regi;
        $row = $this->fetchRow('cod_regi = ' . $cod_regi);
        if (!$row) {
            throw new Exception("Registro não encontrado: $cod_regi");
        }
        return $this->retornafetchRow($row->toArray());
	}
	
	public function update(array $data) {
        $data = $this->preparaDados($data);

		if (!isset($data['cod_usua_alt'])) {
			$data['cod_usua_alt'] = $this->_usuario_sistema;
			$data['dat_alt'] = @date('Y-m-d H:i:s');
		} 
        $cod_regi = $data['cod_regi'];
        unset($data['cod_regi']);
        $where = array('cod_regi = ?' => $cod_regi); 
		return (parent::update($data,$where));
		
	}

}

