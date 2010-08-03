<?php

/**
 * PorcentagemGordura
 * 
 * @author Elan
 * @version 
 */

class Model_PorcentagemGordura extends Model_PadraoModelos {
	/**
	 * The default table name 
	 */
	protected $_name = 'porcentagem_gordura';
	protected $_primary = 'cod_prc_gord';
	
		
	
	public function listarClassificacoes() 
	{
		return $this->retornafetchAll($this->fetchAll()->toArray());;
	}
	
	public function getClassificacao($cod_prc_gord = 0) {
        $cod_prc_gord = (int) $cod_prc_gord;
        $row = $this->fetchRow('cod_prc_gord = ' . $cod_prc_gord);
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

		$cod_prc_gord = $data['cod_prc_gord'];
        unset($data['cod_prc_gord']);
        $where = array('cod_prc_gord = ?' => $cod_prc_gord); 
		return (parent::update($data,$where));
		
	}
}

	