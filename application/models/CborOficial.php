<?php
/**
 * CborOficial
 *  
 * @author PS00287
 * @version 
 */
class Model_CborOficial extends Model_PadraoModelos
{
    /**
     * The default table name 
     */
    protected $_name = 'cbor_oficial';
    protected $_primary = 'cod_sgrp_cbo';
    
    
	public function listarOcupacoes() {
		return $this->fetchAll();
	}
	
	public function getOcupacao($cod_sgrp_cbo) {
        $row = $this->fetchRow('cod_sgrp_cbo = \'' . $cod_sgrp_cbo.'\'');
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

		$cod_sgrp_cbo = $data['cod_sgrp_cbo'];
        unset($data['cod_sgrp_cbo']);
        $where = array('cod_sgrp_cbo = ?' => $cod_sgrp_cbo); 
		return (parent::update($data,$where));
		
	}
	
	
}
    