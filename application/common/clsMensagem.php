<?php
class Mensagem
{ 
	public static function getMensagem($idMsg){
		$msg = array(
			'MSG-01' => 'Inclusão realizada com sucesso.',
			'MSG-02' => 'Alteração realizada com sucesso.',
			'MSG-03' => 'Exclusão realizada com sucesso.',		 
			'MSG-04' => 'Você deseja fechar o sistema?.',
			'MSG-06' => 'Confirma Exclusão?',
			'MSG-08' => 'Este registro já existe.',
			'MSG-09' => 'Nenhum registro encontrado.',
			'MSG-10' => 'Problema na inclusão do registro.',
			'MSG-11' => 'Não foi possível verificar Login. Tente novamente',
		);
		return $msg[$idMsg];	
	}
}