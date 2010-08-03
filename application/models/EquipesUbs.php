<?php

/**
 * EquipesUbs
 * 
 * @author PS00287
 * @version 
 */

class Model_EquipesUbs extends Model_PadraoModelos
{
	/**
	 * The default table name 
	 */
    protected $_name = 'equipes_ubs';
    protected $_primary = 'cod_eqp_ubs';
    protected $_referenceMap = array
    (
    	array(
    		'refTableClass' => 'Model_Unidades',
    		'refColumns'	=> 'cod_unsa',
    		'columns'		=> 'cod_unsa',
    	),
    	
    );
    
    
	public function listarEquipes() {
		return $this->fetchAll(null,array('cod_unsa','cod_eqp_ubs'));
	}
	
	public function getEquipe($cod_eqp_ubs) {
		
		$cod_eqp_ubs = (int) $cod_eqp_ubs;
        $row = $this->fetchRow('cod_eqp_ubs = ' . $cod_eqp_ubs);
        if ($row) {
            return $this->retornafetchRow($row->toArray());
        } else {
        	return false;
        }
       
	}
	
	public function getEquipes($where) {
        	return $this->fetchAll($where);
	}
	
	public function update(array $data) {
        $data = $this->preparaDados($data);

        if (!isset($data['cod_usua_alt'])) {
			$data['cod_usua_alt'] = $this->_usuario_sistema;
			$data['dat_alt'] = @date('Y-m-d H:i:s');
		} 

		$cod_eqp_ubs = $data['cod_eqp_ubs'];
        unset($data['cod_eqp_ubs']);
        $where = array('cod_eqp_ubs = ?' => $cod_eqp_ubs); 
		return (parent::update($data,$where));
		
	}
	
    
    
}

