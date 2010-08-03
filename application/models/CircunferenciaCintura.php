<?php
/**
 * CborOficial
 *  
 * @author PS00287
 * @version 
 */
class Model_CircunferenciaCintura extends Model_PadraoModelos
{
    /**
     * The default table name 
     */
    protected $_name = 'circunferencia_cintura';
    protected $_primary = 'cod_class';
    
    
	public function listarClassificacoes() {
		return $this->retornafetchAll($this->fetchAll()->toArray());;
	}
	
	public function getClassificacao($cod_class) {
		
		$cod_class = (int) $cod_class;
        $row = $this->fetchRow('cod_class = '.$cod_class);
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

		$cod_class = $data['cod_class'];
        unset($data['cod_class']);
        $where = array('cod_class = ?' => $cod_class); 
		return (parent::update($data,$where));
		
	}
	
	
}
    