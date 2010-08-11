<?php

class TiposLogradouro {
	public static function getTiposLogradouro(){
		$tipos = array(
			'ACS' => 'ACESSO',
			'ALA' => 'ALAMEDA',
			'AVE' => 'AVENIDA',
			'BEC' => 'BECO',
			'CAM' => 'CAMINHO',
			'ELV' => 'ELEVADO',
			'ELP' => 'ESPACO LIVRE PUBLICO',
			'EST' => 'ESTRADA',
			'LRG' => 'LARGO',
			'MAR' => 'MARGINAL',
			'PAS' => 'PASSARELA',
			'PCA' => 'PRACA',
			'QDR' => 'QUADRA',
			'QTF' => 'QUARTEIRAO FECHADO',
			'RMA' => 'REDE DE MANILHAS',
			'RTN' => 'RETORNO',
			'ROD' => 'RODOVIA',
			'BR ' => 'RODOVIA FED.',
			'RUA' => 'RUA',
			'RDP' => 'RUA DE PEDESTRE',
			'TRV' => 'TRAVESSA',
			'TRE' => 'TREVO',
			'TRI' => 'TRINCHEIRA',
			'TUN' => 'TUNEL',
			'VIA' => 'VIA',
			'VDP' => 'VIA DE PEDESTRE',
			'VDT' => 'VIADUTO',
		);
		return $tipos;	
	}
	
}

?>