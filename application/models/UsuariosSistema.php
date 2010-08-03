<?php

/**
 * UsuariosSistema
 * 
 * @author PS00287
 * @version 
 */

class Model_UsuariosSistema extends Model_PadraoModelos {
	/**
	 * The default table name 
	 */
	protected $_name = 'usuarios_sistema';
	protected $_primary = 'cod_profis';
    protected $_referenceMap = array
    (
    	array(
    		'refTableClass' => 'Model_ProfissionaisSaude',
    		'refColumns'	=> 'cod_profis',
    		'columns'		=> 'cod_profis',
    	),
    	
    );	
	public function listarUsuarios() {
		return $this->fetchAll(null,'cod_profis');
	}
	
	public function getUsuario($cod_profis) {
		
		$cod_profis = (int) $cod_profis;
        $row = $this->fetchRow('cod_profis = ' . $cod_profis);
        if ($row) {
            return $this->retornafetchRow($row->toArray());
        } else {
        	return false;
        }
       
	}
	
	public function update(array $data) {
        $data = $this->preparaDados($data);
        $data['sen_usua'] = sha1($data['sen_usua']);

        if (!isset($data['cod_usua_alt'])) {
			$data['cod_usua_alt'] = $this->_usuario_sistema;
			$data['dat_alt'] = @date('Y-m-d H:i:s');
		} 

		$cod_profis = $data['cod_profis'];
        unset($data['cod_profis']);
        $where = array('cod_profis = ?' => $cod_profis); 
		return (parent::update($data,$where));
		
	}
	
    public function insert(array $data) {
		//$data['cod_acad'] = $this->_academia;    	
       	$this->preparaDados($data);
       	$this->_data['sen_usua'] = sha1($this->_data['sen_usua']);
		if (!isset($this->_data['cod_usua_cad'])) {
			$this->_data['cod_usua_cad'] = $this->_usuario_sistema;
			$this->_data['dat_cad'] = @date('Y-m-d');
		} 
		return Zend_Db_Table_Abstract::insert($this->_data);
    }
	
	
	
}
    