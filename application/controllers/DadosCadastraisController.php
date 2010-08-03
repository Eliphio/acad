<?php
class DadosCadastraisController extends Zend_Controller_Action {
	protected $_form;
	protected $_dados;
	protected $_cod_usua;

	
	public function getForm($id = false) {
		if (null === $this->_form) {
			$this->_form = new Form_DadosCadastrais ( array ('action' => 'add', 'method' => 'post', 'id' => 'fDados' ) );
		}
		
		return $this->_form;
	}
	
	
	public function equipeAction() {
		$this->_helper->layout->disableLayout (); //disable layout
		$this->_helper->viewRenderer->setNoRender (); //suppress auto-rendering
		try {
			$cod_unsa = $this->_request->getParam('cod_unsa');
			$mEquipe = new Model_EquipesUbs();
			$equipes = $mEquipe->getEquipes(array('cod_unsa = ?'=> $cod_unsa));
			if (count($equipes) > 0){
				$options = "<option value='0'>Selecione a equipe</option>"; 
				foreach ($equipes as $equipe) {
					$options .= "<option value='$equipe->cod_eqp_ubs'>$equipe->desc_eqp_ubs</option>";
				}
			} else {
				$options = "<option>Nenhuma Equipe cadastrada para esta UBS</option>";
			}
			echo $options;
		} catch ( Exception $e ) {
			echo $e->getMessage ();
		}
	
	}

	
	public function profissionalAction() {
		$this->_helper->layout->disableLayout (); //disable layout
		$this->_helper->viewRenderer->setNoRender (); //suppress auto-rendering
		try {
			$cod_eqp_ubs = $this->_request->getParam('cod_eqp_ubs');
			$mProfis = new Model_ProfissionaisSaude();
			$profissionais = $mProfis->getProfisionais(array('cod_eqp_ubs = ?'=> $cod_eqp_ubs));
			if (count($profissionais) > 0){
				$options = "<option value='0'>Selecione o Profissional</option>"; 
				foreach ($profissionais as $profissional) {
					$options .= "<option value='$profissional->cod_profis'>$profissional->nom_profis</option>";
				}
			} else {
				$options = "<option>Nenhum Profissional cadastrado para esta equipe</option>";
			}
			echo $options;
		} catch ( Exception $e ) {
			echo $e->getMessage ();
		}
	
	}
	
	public function testeAction() {
		;
	}
	public function addAction() {
		$this->view->title = "Novo Usuario";
		$this->view->headTitle ( $this->view->title, 'PREPEND' );
		$form = $this->getForm ();
		$this->view->form = $form;
		if ($this->getRequest ()->isPost ()) {
			$elem = $form->getElement('nom_usua');
			$this->_dados = $this->getRequest ()->getPost ();
			if ($form->isValid ( $this->_dados )) {
				if (isset ( $this->_dados ['dias_sem'] )) {
					$dias_semana = ($this->_dados ['dias_sem']);
					unset ( $this->_dados ['dias_sem'] );
				}
				if (isset ( $this->_dados ['ativ_freq'] )) {
					$ativ_freq = ($this->_dados ['ativ_freq']);
					unset ( $this->_dados ['ativ_freq'] );
				}
				try {
					$dadosCadastrais = new Model_DadosCadastrais ();
					if ($dadosCadastrais->insert ( $this->_dados )) {
						$this->_cod_usua = $dadosCadastrais->getAdapter ()->lastInsertId ();
						if (isset ( $dias_semana ) && count ( $dias_semana ) > 0) {
							$dias = new Model_DiasSemana ();
							foreach ( $dias_semana as $valor ) {
								$inserir ['cod_usua'] = $this->_cod_usua;
								$inserir ['dias_sem'] = $valor;
								$dias->insert ( $inserir );
							}
						}
						if (isset ( $ativ_freq ) && count ( $ativ_freq ) > 0) {
							$atividades = new Model_AtividadeExtra ();
							foreach ( $ativ_freq as $valor ) {
								$inserir ['cod_usua'] = $this->_cod_usua;
								$inserir ['ativ_freq'] = $valor;
								$atividades->insert ( $inserir );
							}
						}
						$msg = new Mensagem ();
						$this->view->mensagem = $msg->getMensagem ( 'MSG-01' );
						$this->view->estiloMsg = "mensagemsucesso";
						$this->view->form->reset ();
					}
				} catch ( Exception $e ) {
					$this->_dados ['ativ_freq'] = $ativ_freq;
					$this->_dados ['dias_sem'] = $dias_semana;
					$this->view->form->populate ( $this->_dados );
					$this->view->mensagem = $e->getMessage ();
				}
			}
		}
	}
}





