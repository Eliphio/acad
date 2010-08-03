<?php
class Model_PadraoModelos extends Zend_Db_Table_Abstract
{
    protected $_data;
    protected $_usuario_sistema;
    public $_academia;
  	public $_retorno;
  	protected $_varData;
  	    
    public function __construct($opt = null) {
    	parent::__construct($opt);
    	$this->_usuario_sistema = 1;
    	$this->_academia = 1;
		$this->_varData = array();    	
    /*	$this->_academia = Zend_Auth::getInstance()->getStorage()->read()->cod_acad;
    	$this->_usuario_sistema = Zend_Auth::getInstance()->getStorage()->read()->cod_usua;*/

    }
    
    public function insert(array $data) {
		//$data['cod_acad'] = $this->_academia;    	
       	$this->preparaDados($data);
		if (!isset($this->_data['cod_usua_cad'])) {
			$this->_data['cod_usua_cad'] = $this->_usuario_sistema;
			$this->_data['dat_cad'] = @date('Y-m-d');
		} 
		return parent::insert($this->_data);
    }
    
   
    public function preparaDados (array $data)
    {
        $cols = $this->_getCols();
        $info = $this->info();
        $info = $info['metadata'];
    	foreach ($data as $k => $v) {
    	    if (array_key_exists($k,$info) && !is_array($v) && strlen($v) > 0){
    	        if ($info[$k]['DATA_TYPE'] == 'datetime'){
        	           list ($dia, $mes, $ano) = split ('[/.-]', $v);
        	           $v =  @date(("Y-m-d"),mktime(0,0,0,$mes,$dia,$ano,0));
    	        }
    	        if (strlen($v) > 0)
    			    $this->_data[$k] = strtoupper(utf8_decode($v));
    	    }
		}
		return $this->_data;
		
    }
    
    public function _getCols() {
    	return parent::_getCols();
    }

    public function _getToSelect($codigo, $descricao)
    {  
       $options[''] = 'Selecione...';
       $select = $this->select()->from($this->_name,array($codigo,$descricao));
       foreach ($this->fetchAll($select)->toArray() as $valor)
       {
               $options[$valor[$codigo]] = utf8_encode($valor[$descricao]);
       }
       return $options;    
    }

    public function _getToCheckbox($codigo, $descricao)
    {  
       $select = $this->select()->from($this->_name,array($codigo,$descricao));
       foreach ($this->fetchAll($select)->toArray() as $valor)
       {
               $options[$valor[$codigo]] = utf8_encode($valor[$descricao]);
       }
       return $options;    
    }

    public function retornafetchAll(array $data) {
    	foreach ($data as $key => $var) {
    		foreach ($var as $k => $v){
        		if (in_array($k, $this->_varData)){
        			
	    			list ($mes, $dia, $ano, $hora) = split (' ', $v);
	    			
	    			switch ($mes) {
	    				case 'Jan':
		    				$mes = '01';
		    				break;
	    				case 'Feb':
		    				$mes = '02';
		    				break;
		    			case 'Mar':
		    				$mes = '03';
		    				break;
		    			case 'Apr':
		    				$mes = '04';
		    				break;
		    			case 'May':
		    				$mes = '05';
		    				break;
		    			case 'Jun':
		    				$mes = '06';
		    				break;
		    			case 'Jul':
		    				$mes = '07';
		    				break;
		    			case 'Aug':
		    				$mes = '08';
		    				break;
						case 'Sep':
		    				$mes = '09';
		    				break;
		    			case 'Oct':
		    				$mes = '10';
		    				break;
		    			case 'Nov':
		    				$mes = '11';
		    				break;
		    			case 'Dec':
		    				$mes = '12';
		    				break;	    				
	    			}
					$v =  @date(("Y-m-d"),mktime(0,0,0,$mes,$dia,$ano,0));        			
        			
                   $Data = new Zend_Date($v,'pt_BR');
                   $v = $Data->toString('dd/MM/yyyy');       
        		}
        		$this->_retorno[$key][$k] = utf8_encode($v);
    		}
    	}
    	return $this->_retorno;
    }

    public function retornafetchRow(array $data) {
    	
		foreach ($data as $k => $v){
    		if (in_array($k, $this->_varData)){
    			list ($mes, $dia, $ano, $hora) = split (' ', $v);
    			
    			switch ($mes) {
    				case 'Jan':
	    				$mes = '01';
	    				break;
    				case 'Feb':
	    				$mes = '02';
	    				break;
	    			case 'Mar':
	    				$mes = '03';
	    				break;
	    			case 'Apr':
	    				$mes = '04';
	    				break;
	    			case 'May':
	    				$mes = '05';
	    				break;
	    			case 'Jun':
	    				$mes = '06';
	    				break;
	    			case 'Jul':
	    				$mes = '07';
	    				break;
	    			case 'Aug':
	    				$mes = '08';
	    				break;
					case 'Sep':
	    				$mes = '09';
	    				break;
	    			case 'Oct':
	    				$mes = '10';
	    				break;
	    			case 'Nov':
	    				$mes = '11';
	    				break;
	    			case 'Dec':
	    				$mes = '12';
	    				break;	    				
    			}
				$v =  @date(("Y-m-d"),mktime(0,0,0,$mes,$dia,$ano,0));
               $Data = new Zend_Date($v,'pt_BR');
               $v = $Data->toString('dd/MM/yyyy');       
    		}
	        $this->_retorno[$k] = utf8_encode($v);
		}
    	return $this->_retorno;
    }    
    
    
}
?>