$(document).ready(function(){
	$('#hierarchy').menu({
		content: $('#hierarchy').next().html(),
		crumbDefaultText: ' '
	});
});

function calculaIdade(dataNascimento) {
	if (dataNascimento.value === null){
		return false;
	} else {
		 var arrayData = dataNascimento.value.split("/");
		 var nascimento = new Date(arrayData[2], arrayData[1] - 1, arrayData[0]);
	}
	var hoje = new Date();
	// Decompoem a data em array
	var ano = nascimento.getFullYear();
	var mes = nascimento.getMonth();
	var dia = nascimento.getDate();
	// Valida a data informada
	// Subtrai os anos das duas datas
	var idade = hoje.getFullYear() - ano;
	// Subtrai os meses das duas datas
	var meses = hoje.getMonth() - mes;
	// Se meses for menor que 0 entao nao cumpriu anos. Se for maior sim ja
	// cumpriu
	var dias = hoje.getDate() - dia;
	if (meses < 0 || (meses == 0 && dias < 0)){
		idade = idade - 1;
	}
		
	return idade;
};

/*
 * function PesquisaLograd(){ var localweb; if (this.value == "" ){
 * alert("digite parte do nome do logradouro"); return false; } else { localweb =
 * "PesquisaLogradouro.php?lograd="+document.cadastro.nom_logr.value+
 * "&tipo="+document.cadastro.tip_logr.value+"&numero="+document.cadastro.num_imov.value
 * +"&bairro="+document.cadastro.nom_bair.value;
 * window.open(localweb,null,"toolbar=0,status=0,menubar=0,fullscreen=no,resizable=0,scrollbars=1"); }
 * 
 *  } function PesquisaCep(){ var localweb; if (document.cadastro.num_cep.value == "" ){
 * alert("digite numero do cep"); return false; } else { localweb =
 * "PesquisaLogradouro.php?cep="+document.cadastro.num_cep.value;
 * window.open(localweb,null,"toolbar=0,status=0,menubar=0,fullscreen=no,resizable=0,scrollbars=1"); }
 * 
 *  }
 */

