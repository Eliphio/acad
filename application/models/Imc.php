<?php

/**
 * Imc
 * 
 * @author PS00287
 * @version 
 */

class Model_Imc extends Model_PadraoModelos {
	/**
	 * The default table name 
	 */
	protected $_name = 'imc';
	protected $_primary = 'cod_imc';
	
	public function listarImc() 
	{
		return $this->retornafetchAll($this->fetchAll()->toArray());;
	}
	
	public function getImc($cod_imc = 0) {
        $cod_imc = (int) $cod_imc;
        $row = $this->fetchRow('cod_imc = ' . $cod_imc);
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

		$cod_imc = $data['cod_imc'];
        unset($data['cod_imc']);
        $where = array('cod_imc = ?' => $cod_imc); 
		return (parent::update($data,$where));
		
	}
	
	
	
}

