<?php

/**
 * AtividadesProfissionais
 * 
 * @author Elan
 * @version 
 */


class Model_AtividadesProfissionais extends Model_PadraoModelos {
	/**
	 * The default table name 
	 */
	protected $_name = 'atividades_profissionais';

	
	public function listarAtividades() {
		return $this->retornafetchAll($this->fetchAll()->toArray());;
	}
	
	public function getAtividade($cod_ativ = 0) {
        $cod_ativ = (int) $cod_ativ;
        $row = $this->fetchRow('cod_ativ = ' . $cod_ativ);
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

		$cod_ativ = $data['cod_ativ'];
        unset($data['cod_ativ']);
        $where = array('cod_ativ = ?' => $cod_ativ); 
		return (parent::update($data,$where));
		
	}
	
	
}

