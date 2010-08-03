<?php
/**
 * ClassificacaoFlexibilidade
 *  
 * @author PS00287
 * @version 
 */
class Model_ClassificacaoFlexibilidade extends Model_PadraoModelos
{
    /**
     * The default table name 
     */
    protected $_name = 'classificacao_flexibilidade';
    protected $_primary = 'cod_flex';
    
    
	public function listarClassificacoes() {
		return $this->retornafetchAll($this->fetchAll()->toArray());;
	}
	
	public function getClassificacao($cod_flex) {
		
		$cod_flex = (int) $cod_flex;
        $row = $this->fetchRow('cod_flex = ' . $cod_flex);
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

		$cod_flex = $data['cod_flex'];
        unset($data['cod_flex']);
        $where = array('cod_flex = ?' => $cod_flex); 
		return (parent::update($data,$where));
		
	}
	
	
}
    