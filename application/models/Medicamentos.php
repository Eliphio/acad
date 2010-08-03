<?php

/**
 * Medicamentos
 * 
 * @author Elan
 * @version 
 */

class Model_Medicamentos extends Model_PadraoModelos {
	/**
	 * The default table name 
	 */
	protected $_name = 'medicamentos';
	protected $_primary = 'cod_medic';
	
	
	public function listarMedicamentos() 
	{
		return $this->retornafetchAll($this->fetchAll(null,'cod_fami_medic')->toArray());;
	}
	
	public function getMedicamento($cod_medic = 0) {
        $cod_medic = (int) $cod_medic;
        $row = $this->fetchRow('cod_medic = ' . $cod_medic);
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

		$cod_medic = $data['cod_medic'];
        unset($data['cod_medic']);
        $where = array('cod_medic = ?' => $cod_medic); 
		return (parent::update($data,$where));
		
	}
}

