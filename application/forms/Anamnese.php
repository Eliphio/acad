<?php

/** 
 * @author Elan
 * 
 * 
 */
class Form_Anamnese extends  Form_PadraoForm
{
	
	public function __construct($options = null) {
 
 	    $eva =             array(1 => '01 - Sem dor',
	                             2 => '02 - Leve',
	                             3 => '03 - Leve',
	                             4 => '04 - Moderada',
	                             5 => '05 - Moderada',
	                             6 => '06 - Média Dor',
	                             7 => '07 - Moderada',
	                             8 => '08 - Intensa',
	                             9 => '09 - Intensa',
	                             10 => '10 - Intensa',
	                             11 => '11 - Pior Dor',);
	    $optpu_sem_saude = array(1 => '01 - Muito Boa',
	                             2 => '02 - Boa',
	                             3 => '03 - Razoável',
	                             4 => '04 - Ruim',
	                             5 => '05 - Muito Ruim',
	                             6 => '06 - Sem informação',);
        $opthsa_drink =    array(1 => '01 - Todos os dias ou quase todos os dias',
                                 2 => '02 - Uma ou duas vezes por semana',
                                 3 => '03 - Três a cinco vezes por semana',
                                 4 => '04 - Nos finais de semana',
                                 5 => '05 - Bebe esporadicamente/socialmente',
                                 6 => '06 - Bebia todos os dias, mas parou',
                                 7 => '07 - Bebia nos finais de semana, mas parou',
                                 8 => '08 - Bebia esporadicamente/socialmente, mas parou',
                                 9 => '09 - Nunca bebeu',
                                 10 => '10 - Sem informação',);	    

        $opthsa_medic =    array(0 => '0 - Não',
                                 1 => '1 - Sim',
                                 2 => '2 - Sem Informação',);

        $opthsa_fuma =     array(1 => '01 - Ao longo de toda a sua vida jamais fumou 100 cigarros',
                                 2 => '02 - Já fumou 100 cigarros durante toda a sua vida, mas parou de fumar',
                                 3 => '03 - Fuma alguns dias, mas não todos',
                                 4 => '04 - Fuma todos os dias menos de um maço de cigarros',
                                 5 => '05 - Fuma todos os dias entre um e dois maços de cigarros',
                                 6 => '06 - Fuma todos os dias pelo menos dois maços de cigarros',
                                 7 => '07 - Nunca fumou',
                                 8 => '08 - Sem informação',);
                                 
        $opthsa_trim_freq_cami=
                           array(1 => '01 - Todos os dias ou quase todos os dias',
                                 2 => '02 - Uma ou duas vezes por semana',
                                 3 => '03 - Três a cinco vezes por semana',
                                 4 => '04 - Uma a três vezes por mês',
                                 5 => '05 - Menos de uma vez por mês',
                                 6 => '06 - Não praticou esportes nos últimos 90 dias (3 meses)',
                                 7 => '07 - Sem informação',);
        $opthsa_hab_ativ_fis=
                           array(1 => '01 - Você geralmente fica sentado durante o dia e anda pouco',
                                 2 => '02 - Fica em pé ou caminha bastante durante o dia e só carrega ou levanta coisas de vez em quando',
                                 3 => '03 - Geralmente carrega volumes (caixas, livros, entre outros) ou geralmente sobe escadas ou ladeiras/morro',
                                 4 => '04 - Faz trabalho pesado, tendo de carregar volumes pesados (caixas, livros, tijolos, sacos de cimento, etc.)',
                                 5 => '05 - Sem informação',);                                  

        $opthsa_sat_corp = array(1 => '01 - Muito insatisfeito',
                                 2 => '02 - Insatisfeito',
                                 3 => '03 - Indiferente',
                                 4 => '04 - Satisfeito',
                                 5 => '05 - Muito satisfeito',);
                                 
        $opthsa_fat_ativ_fis =
                           array(1 => '1,3 - Sedentário',
                                 2 => '1,5 - Algum exercício regular',
                                 3 => '1,7 - Exercício de alta intensidade',);                                                          

                                 
        $optsa_bem_equip = array(1 => '01 - Está muito mal equipado',
                                 2 => '02 - Não está bem equipado',
                                 3 => '03 - Mais ou menos equipado',
                                 4 => '04 - Está razoavelmente equipado',
                                 5 => '05 - Está muito bem equipado',);
                                                                  
        $optsa_conhec_profis=
                           array(1 => '01 - Nenhum conhecimento',
                                 2 => '02 - Muito pouco conhecimento',
                                 3 => '03 - Mais ou menos',
                                 4 => '04 - Algum conhecimento',
                                 5 => '05 - Muito conhecimento',);
                                                          
        $optsa_satis_acad =
                           array(1 => '01 - Muito insatisfeito',
                                 2 => '02 - Insatisfeito',
                                 3 => '03 - Indiferente',
                                 4 => '04 - Satisfeito',
                                 5 => '05 - Muito satisfeito',);
                                                                  
		$optsa_recomend =  array(1 => '01 - Não recomendaria de forma alguma',
		                         2 => '02 - Acho que não recomendaria',
		                         3 => '03 - Indiferente',
		                         4 => '04 - Acho que recomendaria',
		                         5 => '05 - Com certeza eu recomendaria',);

		$this->addElement('RadioButton', 'pq_card_superv_medic', array(
			'label'      => 'Seu médico já disse que você possui algum problema cardíaco e recomenda atividade físicas apenas sob supervisão médica ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'pq_dor_peito_dia', array(
			'label'      => 'Você tem dor no peito provocada por atividade física ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'pq_dor_peio_mes', array(
			'label'      => 'Você teve dor no peito no último mês quando praticava atividade física ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'pq_desmaio', array(
			'label'      => 'Você já perdeu a consciência em alguma ocasião ou sofreu alguma queda em virtude de tontura ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'pq_prob_osseo', array(
			'label'      => 'Você tem algum problema ósseo ou articular que poderia agravar-se com as atividade física ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'pq_pressao_alta', array(
			'label'      => 'Algum médico já lhe prescreveu medicamento para pressão arterial ou para o coração ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'pq_superv_medic', array(
			'label'      => 'Você tem conhecimento, por informação médica ou pela própria experiência, de algum motivo que poderia impedi-lo de participar de atividades físicas sem supervisão médica ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('ValidationTextBox', 'pq_pontua', array(
			'label'      => 'Pontuação PAR-Q - Classificação de risco do usuário para atividade física',
			));
			
		foreach ($this->getElements() as $elemento) {
        	$elementos[]= $elemento->getName();
        }
  
		$this->addDisplayGroup($elementos, 'gParq', array('legend'=>"PAR-Q"));//,"dojoType"=>'dijit.TitlePane',));
        $this->clearElements();
			
		$this->addElement('RadioButton', 'eva_dor_geral', array(
			'label'      => 'Classificação da dor na EVA (Dores gerais) ',
			'multiOptions' 	=> $eva,
			));
			
		foreach ($this->getElements() as $elemento) {
        	$elementos[]= $elemento->getName();
        }
  
		$this->addDisplayGroup($elementos, 'gEva', array('legend'=>"EVA"));//,"dojoType"=>'dijit.TitlePane',));
        $this->clearElements();			
			
		$this->addElement('RadioButton', 'pu_sem_saude', array(
			'label'      => 'De uma maneira em geral você diria que sua saúde é ',
			'multiOptions' 	=> $optpu_sem_saude ,
			));
		$this->addElement('ValidationTextBox', 'pu_dias_sem_sau_fisi', array(
			'label'      => 'No último mês por quantos dias sua saúde física não foi boa. (Número de dias) - Somente doenças, machucados, tontura e dor.',
			));
		$this->addElement('ValidationTextBox', 'pu_dias_sem_sau_psi', array(
			'label'      => 'No último mês por quantos dias sua saúde mental não foi boa. (Número de dias) - inclui depressão, stress ou problemas emocionais',
			));
		$this->addElement('ValidationTextBox', 'pu_dias_sem_dorm_desc', array(
			'label'      => 'No último mês por quantos dias você não conseguiu descansar ou dormir bem (Número de dias)',
			));
		$this->addElement('ValidationTextBox', 'pu_dias_sem_ativid', array(
			'label'      => 'No último mês por quantos dias deixou de realizar suas tarefas habituais, do dia a dia (trabalho, escola,serviço domestico, visitas etc)por motivo de saúde (Número de dias)',
			));
			
		foreach ($this->getElements() as $elemento) {
        	$elementos[]= $elemento->getName();
        }
  
		$this->addDisplayGroup($elementos, 'gPercep', array('legend'=>"PERCEPÇÃO DO USUÁRIO"));//,"dojoType"=>'dijit.TitlePane',));
        $this->clearElements();			
			
		$this->addElement('ValidationTextBox', 'hp_dias_acam', array(
			'label'      => 'No último mês quantos dias esteve acamado (a) (por motivo de saúde) (Número de dias)',
			));
		$this->addElement('ValidationTextBox', 'hp_ano_interna', array(
			'label'      => 'No último ano quantas vezes esteve internado (a) (Nº de internações)',
			));
		foreach ($this->getElements() as $elemento) {
        	$elementos[]= $elemento->getName();
        }
  
		$this->addDisplayGroup($elementos, 'gHP', array('legend'=>"HISTÓRIA PREGRESSA"));//,"dojoType"=>'dijit.TitlePane',));
        $this->clearElements();			
			
		$this->addElement('RadioButton', 'hsa_infa_derr_fami', array(
			'label'      => 'Já teve infarto ou derrame na família - Pai, mãe ou irmãos ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'hsa_medic', array(
			'label'      => 'Você faz uso de algum medicamento regularmente - Remédio de uso regular é aquele que você não pode ficar sem ele ',
			'multiOptions' 	=> $opthsa_medic,
			));
		foreach ($this->getElements() as $elemento) {
        	$elementos[]= $elemento->getName();
        }
  
		$this->addDisplayGroup($elementos, 'gHSA', array('legend'=>"HISTÓRIA DA SAÚDE ATUAL"));//,"dojoType"=>'dijit.TitlePane',));
        $this->clearElements();

        $this->addElement('RadioButton', 'hsa_acid_uric_alto', array(
			'label'      => 'Ácido Úrico alto ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'hsa_trig_alto', array(
			'label'      => 'Triglicérides alto ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'hsa_colest_alto', array(
			'label'      => 'Colesterol alto (Acima de 200 mg/dl) ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'hsa_depres', array(
			'label'      => 'Depressão ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'hsa_doen_colu', array(
			'label'      => 'Doenças na coluna ou das costas (Hiperlordose, hipercifose, hérnia, artrose (desgaste), artrite(inflamação), escoliose (desvio), espondilolistese (bico de papagaio) ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'hsa_artri_artro_reum', array(
			'label'      => 'Artrite, Artrose ou Reumatismo ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'hsa_asm_bronq', array(
			'label'      => 'Asma/Bronquite ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'hsa_diabet', array(
			'label'      => 'Diabetes (Acima 100 mg/dl) ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'hsa_press_alta', array(
			'label'      => 'Pressão alta (Hipertensão, acima de 140/90 mmHg ou usa medicamento para PA) ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'hsa_doen_coron', array(
			'label'      => 'Outra doença do coração - Nas coronárias do coração, sopro, arritmia, comunicação átrio ventricular ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'hsa_angi', array(
			'label'      => 'Angina ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'hsa_infa', array(
			'label'      => 'Infarto ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'hsa_derr_avc', array(
			'label'      => 'Derrame/AVE - Acidente vascular encefálico ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'hsa_doen_rena', array(
			'label'      => 'Doença renal crônica - Hemodiálise, perda dos rins gerada por Diabetes, P.A. Alta ou Ácido úrico ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'hsa_drink', array(
			'label'      => 'Quantas vezes nos ultimos 30 dias você bebeu 5 ou mais drinques em um único dia - Um drinque = Uma lata de cerveja de 350ml, uma taça de vinho ou uma dose de bebida destilada (whisky, cachaça) ',
			'multiOptions' 	=> $opthsa_drink,
			));
		$this->addElement('RadioButton', 'hsa_fuma', array(
			'label'      => 'Você fuma Qual das seguintes frases define melhor seus hábitos em relação ao uso de cigarros ',
			'multiOptions' 	=> $opthsa_fuma,
			));
		$this->addElement('RadioButton', 'hsa_trim_freq_cami', array(
			'label'      => 'Nos últimos 3 meses, durante seus períodos de lazer ou de folga com que freqüência você caminhou para fazer exercícios ou fez ginástica ou praticou algum esporte por pelo menos 20 a 30 minutos ',
			'multiOptions' 	=> $opthsa_trim_freq_cami,
			));
		$this->addElement('RadioButton', 'hsa_hab_ativ_fis', array(
			'label'      => 'Qual das seguintes frases que vou ler define seus hábitos ou atividades físicas no dia a dia ',
			'multiOptions' 	=> $opthsa_hab_ativ_fis,
			));
		$this->addElement('RadioButton', 'hsa_sat_corp', array(
			'label'      => 'Como você diria que está sua satisfação com seu corpo ',
			'multiOptions' 	=> $opthsa_sat_corp,
			));
		$this->addElement('RadioButton', 'hsa_fat_ativ_fis', array(
			'label'      => 'Fator atividade Física p/ Valor Energético Total - (FAO/OMS/ONU, 1985) ',
			'multiOptions' 	=> $opthsa_fat_ativ_fis ,
			));
			
		foreach ($this->getElements() as $elemento) {
        	$elementos[]= $elemento->getName();
        }
  
		$this->addDisplayGroup($elementos, 'gHSB', array('legend'=>"ALGUM MÉDICO OU PROFISSIONAL DE SAÚDE, DISSE QUE VOCE TINHA:"));//,"dojoType"=>'dijit.TitlePane',));
        $this->clearElements();
			
		$this->addElement('ValidationTextBox', 'ubs_trim_freq_visi', array(
			'label'      => 'Quantas vezes você foi, nos últimos 3 meses ao centro de saúde - Somar número de vezes',
			));
			
			
		foreach ($this->getElements() as $elemento) {
        	$elementos[]= $elemento->getName();
        }
  
		$this->addDisplayGroup($elementos, 'gUBS', array('legend'=>"VISITA A UNIDADE DE SAÚDE"));//,"dojoType"=>'dijit.TitlePane',));
        $this->clearElements();
			
			
			
		$this->addElement('RadioButton', 'sa_bem_equip', array(
			'label'      => 'Você acha que a academia está bem equipada para atender a população em atividades físicas ',
			'multiOptions' 	=> $optsa_bem_equip,
			));
		$this->addElement('RadioButton', 'sa_conhec_profis', array(
			'label'      => 'Você acha que os profissionais têm conhecimento suficiente para atender a população em atividades físicas ',
			'multiOptions' 	=> $optsa_conhec_profis,
			));
		$this->addElement('RadioButton', 'sa_satis_acad', array(
			'label'      => 'Qual é o seu grau de satisfação com esta academia ',
			'multiOptions' 	=> $optsa_satis_acad,
			));
		$this->addElement('RadioButton', 'sa_recomend', array(
			'label'      => 'Você recomendaria esta academia para um amigo (a) ou parente seu ',
			'multiOptions' 	=> $optsa_recomend,
			));
			
		foreach ($this->getElements() as $elemento) {
        	$elementos[]= $elemento->getName();
        }
		$this->addDisplayGroup($elementos, 'gPA', array('legend'=>"AVALIAÇÃO ACADEMIA"));//,"dojoType"=>'dijit.TitlePane',));
        $this->clearElements();
			
		$this->addElement('RadioButton', 'flg_aliment', array(
			'label'      => 'Alimentou antes de vir para a academia(Até 2 horas) ',
		    'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'flg_hidrata', array(
			'label'      => 'Hidratou antes de vir para a academia (Até 1 hora) ',
		    'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'flg_dorm', array(
			'label'      => 'Dormiu bem a noite antes de vir para a academia ',
			'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'flg_alfabt', array(
			'label'      => 'Sabe ler e escrever ',
		    'multiOptions' 	=> $this->_getSN(),
			));
		$this->addElement('RadioButton', 'flg_enxerga', array(
			'label'      => 'Enxerga bem ',
			'multiOptions' 	=> $this->_getSN(),
		    ));
		foreach ($this->getElements() as $elemento) {
        	$elementos[]= $elemento->getName();
        }
		$this->addDisplayGroup($elementos, 'gSA', array('legend'=>"SAÚDE ATUAL"));//,"dojoType"=>'dijit.TitlePane',));
        $this->clearElements();
		    
		$this->addElement('SubmitButton','foo',array(
		    'required'   => false,
		    'ignore'     => true,
		    'label'      => 'Salvar',
		    ));        
 		parent::__construct($options); 
		    
	}
}