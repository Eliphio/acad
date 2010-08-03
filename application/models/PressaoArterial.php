<?php

/**
 * PressaoArterial
 * 
 * @author PS00287
 * @version 
 */

class Model_PressaoArterial extends Model_PadraoModelos {
	/**
	 * The default table name 
	 */
	protected $_name = 'pressao_arterial';
	protected $_primary = 'cod_prss_art';
	
	
	public function listarClassificacoes() {
		return $this->retornafetchAll($this->fetchAll()->toArray());;
	}
	
	public function getClassificacao($cod_prss_art) {
		
		$cod_prss_art = (int) $cod_prss_art;
        $row = $this->fetchRow('cod_prss_art = ' . $cod_prss_art);
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

		$cod_prss_art = $data['cod_prss_art'];
        unset($data['cod_prss_art']);
        $where = array('cod_prss_art = ?' => $cod_prss_art); 
		return (parent::update($data,$where));
		
	}
	
	
}
    