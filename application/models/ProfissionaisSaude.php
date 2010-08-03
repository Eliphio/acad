<?php
/**
 * Profissionaissaude
 *  
 * @author PS00287
 * @version 
 */
class Model_ProfissionaisSaude extends Model_PadraoModelos
{
    /**
     * The default table name 
     */
    protected $_name = 'profissionais_saude';
    protected $_primary = 'cod_profis';
    protected $_dependentTables = array('Model_UsuariosSistema');

    
	public function listarProfissionais() {
		return $this->retornafetchAll($this->fetchAll()->toArray());;
	}
	
	public function getProfissional($cod_profis = 0) {
        $cod_profis = (int) $cod_profis;
        $row = $this->fetchRow('cod_profis = ' . $cod_profis);
        if ($row) {
            return $this->retornafetchRow($row->toArray());
        } else {
        	return false;
        }
       
	}
	
	public function getProfisionais($where = null) {
		return $this->fetchAll($where);;
	}
	
	
	public function update(array $data) {
        $data = $this->preparaDados($data);

        if (!isset($data['cod_usua_alt'])) {
			$data['cod_usua_alt'] = $this->_usuario_sistema;
			$data['dat_alt'] = @date('Y-m-d H:i:s');
		} 

		$cod_profis = $data['cod_profis'];
        unset($data['cod_profis']);
        $where = array('cod_profis = ?' => $cod_profis); 
		return (parent::update($data,$where));
		
	}
	
	
}
    