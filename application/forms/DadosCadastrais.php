<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_DadosCadastrais extends Form_PadraoForm 
{
	
	public function __construct($options = null) {
 
        //$cbo = new Model_CborOficial();
        //$optcbo = $cbo->_getToSelect('cod_sgrp_cbo','desc_reduzida_sgrp_cbo');

        $opttipLogr = TiposLogradouro::getTiposLogradouro();
        $horario = new Model_HorariosAcademias();
        $optHorario = $horario->_getToSelect('cod_hor','desc_hor');
        $profis = new Model_ProfissionaisSaude();
        $optProfis = $profis->_getToSelect('cod_profis','nom_profis');
        $unidade = new Model_Unidades();
        $optUnidade = $unidade->_getToSelect('cod_unsa','desc_unsa');

       
       
        $optMotivo = array(1 => '1 - Abandono',2 => '2 - Int. por problemas de saúde');
        $optSexo = array(1 => 'Masculino',2 => 'Feminino');
        $optObjetivo = array(1 => '1 - Saúde',2 => '2 - Estética',3 => '3 - Socialização',4 => '4 - Outros',);
        $optInfoAcad = array(1 => '1 - Centrode Saude',2 => '2 - NAF', 3 => '3 - Alunos da Academia', 4 => '4 - Amigos/Familiares/Vizinhos', 5 => '5 - Associação de bairro', 6 => '6 - Outros',);
        $optAtividades = array(1 => '1 - Academia',2 => '2 - Caminhada',3 => '3 - Só Orientação',4 => '4 - Segundo tempo na escola',5 => '5 - Grupo nutrição Centro de Saúde',6 => '6 - Grupo nutrição Escola',7 => '7 - Lian Gong',8 => '8 - Outra Atividade');
        $optNumVezes = array(1 => '1',2 => '2',3 => '3',4 => '4',5 => '5',6 => '6',7 => '7',);
        $optDiasSemana = array(1 => '1 - Segunda-Feira',2 => '2 - Terça-Feira',3 => '3 - Quarta-Feira',4 => '4 - Quinta-Feira',5 => '5 - Sexta-Feira',6 => '6 - Sábado',7 => '7 - Domingo',);

        /**
         * Cria elementos relativos aos dados básicos do cadastro
         */
		
        
        $this->addElement('text', 'nom_usua', array(
            'label'      => 'Nome do usuário',
        	'size' 	=> 70,
        	'style'=> 'width: 90%',
        	'required' => true
        
        ));
        $this->addElement('text', 'num_pron', array(
            'label'      => 'Nº Prontuário',
        	'size' 	=> 15,
        	'style'=> 'width: 40%',
        	'required' => true
        
        ));
        $this->addElement('text', 'num_cns', array(
            'label'      => 'Nº CNS (Cartão Nacional de Saúde)',
        	'size' 	=> 15,
        	'style'=> 'width: 40%',
        	'required' => true,
        ));
        $this->addElement('text', 'dat_nasc', array(
        	'id'	=> 'dat_nasc',
            'label'      => 'Data Nascimento',
        	'required' => true
        ));
        $this->addElement('text', 'ida_usua', array(
            'label'      => 'Idade',
        	'id' => 'ida_usua',
        	'required' => true,
        ));
        $this->addElement('radio', 'sex_usua', array(
            'label'      => 'Sexo ',
        	'multiOptions' => $optSexo,
        	'required' => true,
        	'separator' => ' '
        ));
        $this->addElement('text', 'cod_sgrp_cbo', array(
            'label'      => 'Código CBOR',
            'style'=> 'width: 90%',
        	'required' => true
        ));
        $this->addElement('text', 'num_bhvida', array(
            'label'      => 'Nº BHVida',
        	'size' 	=> 15,
        	'style'=> 'width: 40%',
        	'required' => true
        ));
        
		$this->addGroup('gBasico', 'Dados Cadastrais');        
        /**
         * Cria elementos relativos a endereço do cadastro
         */
        
        $this->addElement('select', 'tip_logr', array(
            'label'      => 'Tipo',
        	'multiOptions' => $opttipLogr,
        	'required' => true
        ));
        $this->addElement('text', 'nom_logr', array(
            'label'      => 'Logradouro',
        	'style'=> 'width: 90%',
        	'required' => true
        ));
        $this->addElement('text', 'num_imov', array(
            'label'      => 'Nº do imóvel',
        	'required' => true
        ));
        $this->addElement('text', 'cmp_imov', array(
            'label'      => 'Complemento',
        	'style'=> 'width: 40%',
        	'required' => true
        ));
        $this->addElement('text', 'nom_bair', array(
            'label'      => 'Bairro',
        	'style'=> 'width: 90%',
			'required' => true        
        ));
        $this->addElement('text', 'num_cep', array(
            'label'      => 'CEP',
        	'required' => true
        ));
        $this->addElement('text', 'fon_usua', array(
            'label'      => 'Telefone',
        	'required' => true
        ));

        
        $this->addGroup('gEndereco', 'Endereço');

        
        /*
        $this->addElement('text', 'dat_said', array(
            'label'      => 'Data da saida das atividades da academia',
        ));
        $this->addElement('radio', 'mot_said', array(
            'label'      => 'Motivo da saída ',
        	'multiOptions' 	=> $optMotivo,
        ));
        
        */
        /**
         * Cria elementos relativos à avaliação do cadastro
         */
        
        $this->addElement('text', 'dat_aval', array(
            'label'      => 'Data Avaliação',
        	'required' => true
        ));
        $this->addElement('select', 'cod_profis_aval', array(
            'label'      => 'Avaliador',
            'multiOptions' => $optProfis,
        	'required' => true
        ));
        
        $this->addElement('select', 'cod_unsa', array(
            'label'      => 'Unidade de Saúde',
            'multiOptions' 	=> $optUnidade,
        	'required' => true
        ));
        
        $rota = Zend_Controller_Front::getInstance()->getBaseUrl(). '/Equipes-ubs/addbyajax';
        
        $this->addElement('select', 'cod_eqp_ubs', array(
            'label'      => "Equipe",
        	'Description'	=> "<a name=\"modal\" href=\"$rota\">Nova Equipe</a>",
        	//'required' => true
            
        ));
        
        $rota = Zend_Controller_Front::getInstance()->getBaseUrl(). '/Profissionais-saude/addbyajax';
        
        $this->addElement('select', 'cod_profis_ubs', array(
            'label'      => 'Profissional responsável na UBS',
        	'Description'	=> "<a name=\"modal\" href=\"$rota\">Novo Profissional</a>",
        	//'required' => true
        ));
        $this->addElement('radio', 'obj_aln', array(
            'label'      => 'Objetivo do aluno da academia ',
        	'multiOptions' 	=> $optObjetivo,
        	'separator' => ' ',
        	'required' => true
        
        ));
        $this->addElement('radio', 'flg_info_acad', array(
            'label'      => 'Como você ficou sabendo da academia da cidade',
        	'multiOptions' 	=> $optInfoAcad,
        	'required' => true
        ));
        
        	$this->addElement('MultiCheckbox', 'ativ_freq', array(
            'label'      => 'Atividades que frequenta',
        	'multiOptions'=>$optAtividades,
        	'required' => true
        ));
        	
        $this->addElement('radio', 'num_vezes_sem', array(
            'label'      => 'Nº vezes na semana ',
        	'multiOptions'=>$optNumVezes,
        	'separator' => ' ',
		    'required' => true
        ));
        $this->addElement('MultiCheckbox', 'dias_sem', array(
            'label'      	=> 'Dias da Semana ',
        	'multiOptions' 	=> $optDiasSemana,
        	'required' 		=> true,
        ));
        
        
        $this->addElement('select', 'hor_freq_acad', array(
            'label'      => 'Horário que irá freqüentar a academia ',
        	'multiOptions' 	=> $optHorario,
        	'required' => true 
       ));
        $this->addElement('select', 'melh_hor_freq', array(
            'label'      => 'Melhor horário para Frequentar a Academia ',
        	'multiOptions' 	=> $optHorario,
        	'required' => true
        ));	
        
        
        $this->addGroup('gAvaliacao', 'Dados Avaliação');
        
		$this->addElement(
		    'submit',
		    'submit',
		    array(
		        'required'   => false,
		        'ignore'     => true,
		        'label'      => 'Salvar',
		    )
		);
		
 		parent::__construct($options);		
	}
	
	
}