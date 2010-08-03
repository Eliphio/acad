<?php
/**
 * UnidadeSaude
 *  
 * @author PS00287
 * @version 
 */
class Model_Unidades extends Model_PadraoModelos
{
    /**
     * The default table name 
     */
    protected $_name = 'unidades';
    protected $_primary = 'cod_unsa';
    protected $_dependentTables = array('Model_EquipesUbs');
    protected $_referenceMap = array
    (
    	array(
    		'refTableClass' => 'Model_Regionais',
    		'refColumns'	=> 'cod_regi',
    		'columns'		=> 'cod_regi',
    	),
    	
    );
    
	public function listarUnidades() {
		return $this->fetchAll(null,array('cod_regi','cod_unsa'));
	}
	
	public function getUnidade($cod_unsa) {
		
		$cod_unsa = (int) $cod_unsa;
        $row = $this->fetchRow('cod_unsa = ' . $cod_unsa);
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

		$cod_unsa = $data['cod_unsa'];
        unset($data['cod_unsa']);
        $where = array('cod_unsa = ?' => $cod_unsa); 
		return (parent::update($data,$where));
		
	}
	
	
}
