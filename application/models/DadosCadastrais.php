<?php
/**
 * DadosCadastrais
 *  
 * @author PS00287
 * @version 
 */
class Model_DadosCadastrais extends Model_PadraoModelos
{
    /**
     * The default table name 
     */
    protected $_name = 'dados_cadastrais';
    protected $_dependentTables = array('Model_DiasSemana','Model_AtividadesExtra');
    protected $_primary = 'cod_usua';

    
    public function insert($data) {
    	$data["cod_acad"] = $this->_academia;
    	return parent::insert($data);
    }
    
    public function update(array $data, array $where) {
        
    	$this->preparaDados($data);
		if (!isset($this->_data['cod_usua_cad'])) {
			$this->_data['cod_usua_alt'] = $this->_usuario_sistema;
			$this->_data['dat_alt'] = @date('Y-m-d');
		}
    	return parent::update($this->_data, $where);
    }
    
    public function pesquisaNome($nome) {
		
    	$ret =  $this->getAdapter()->fetchAssoc("SELECT cod_usua, cod_acad, nom_usua, convert(varchar(10),dat_nasc,103) dat_nasc FROM dados_cadastrais
								 WHERE nom_usua LIKE ? and cod_acad = ?" , array("%".$nome."%",$this->_academia));
		return $ret;
    }
    
    /**
     * 
     * @param array $where
     * @return Zend_Db_Table_Row_Abstract|null se não houver dados 
     * 
     */
    public function busca(array $where)
    {    
        $ret = $this->fetchRow($where);
        
        if (!is_null($ret->dat_nasc))
       	{
       	    $dat_aval = new Zend_Date($ret->dat_nasc,Zend_Date::DATE_SHORT);
       	    $ret->dat_nasc = $dat_aval->toString('dd/MM/yyyy');       
       	}
       	
       	if (!is_null($ret->dat_aval))
       	{
       	    $dat_aval = new Zend_Date($ret->dat_aval,Zend_Date::DATE_SHORT);
       	    $ret->dat_aval = $dat_aval->toString('dd/MM/yyyy');       
       	}
       	 
       	if (!is_null($ret->dat_said))
       	{
       	    $dat_aval = new Zend_Date($ret->dat_said,Zend_Date::DATE_SHORT);
       	    $ret->dat_said = $dat_aval->toString('dd/MM/yyyy');       
       	}
        
        return $ret;
     }
    
        
}
