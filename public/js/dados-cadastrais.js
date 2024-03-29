$(document).ready(function(){
    $.mask.definitions['d']='[0123]';
    $.mask.definitions['D']='[0123456789]';
    $.mask.definitions['m']='[01]';
    $.mask.definitions['M']='[0123456789]';
    $.mask.definitions['a']='[12]';
    $.mask.definitions['A']='[09]';
	$("#ida_usua").attr({readonly: "true"});
	$("#dat_nasc").change(
		function(){
			var idade = calculaIdade(this);
			if (idade) {
				$("#ida_usua").val(idade);
			}
		});
	$("#dat_nasc").datepicker({
		autoSize: true,
		navigationAsDateFormat: true ,
		yearRange: 'c-99:c', 
		changeMonth: true,
		changeYear: true,
		showOn: 'button',
		buttonImage: '../images/calendar.gif',
		buttonImageOnly: true
	
	});
	$("#dat_aval").datepicker({
		autoSize: true,
		yearRange: 'c-3:c', 
		changeMonth: true,
		changeYear: true,
		showOn: 'button',
		buttonImage: '../images/calendar.gif',
		buttonImageOnly: true
		
	});
	$("#dat_nasc").mask("dD/mM/aA99");
	$("#dat_aval").mask("dD/mM/aA99");
	
    $("input[name^=num_vezes_sem]").click(function(){
    	$("input[name^=dias_sem]").each(
            	function(){
            		this.checked = false;
            	}
        )
    });
    $("input[name^=dias_sem]").click(function(){
   		var n = $("input[name^=dias_sem]").filter(":checked").length;
   		var lim = $("input[name^=num_vezes_sem]").filter(":checked").val();
   		if (lim === undefined)
       		lim = 0;
		if (n > lim){
			alert("Marcar somente " + lim + " dia(s)");
			this.checked = false;
		}           		
    });
    $('#cod_unsa').change(function(){
        $('#cod_eqp_ubs').load('equipe/cod_unsa/' + $(this).val());
        $('#cod_profis_ubs').html("");
    });

    $('#cod_eqp_ubs').change(function(){
        $('#cod_profis_ubs').load('profissional/cod_eqp_ubs/' + $(this).val());
    });

	$("#janela").dialog(
			{
				modal : true,
				autoOpen : false,
				position : 'center',
				resizable: false,
				width: 400,
				
				close: function() {
					$("#janela").html("");
				}
				
			});    
    //seleciona os elementos a com atributo name="modal"
    $('a[name=modal]').click(function(e) {
	    //armazena o atributo href do link
	    var cod_unsa = $('#cod_unsa');
	    var cod_eqp_ubs = $('#cod_eqp_ubs'); 
	    var url = $(this).attr('href') + '/cod_unsa/' + cod_unsa.val()+'/cod_eqp_ubs/' + cod_eqp_ubs.val();
		$("#janela").dialog({title: $(this).html()});
	    $("#janela").load(url,null,function (){carrega();$('#janela').dialog('open');});
	    
		return false;
    });
	    //se o botãoo fechar for clicado
  	
});

function carrega(){

    $("#janela > form").submit(function(e) {
    	e.preventDefault();                                                                       
        var data = $(this).serialize(); // Dados do formulário     
        // Envia o formulário via Ajax
        var nome = this.id;
        $.ajax({
                type: "POST",
                url: this.action,
                data: data,
                cache: false,
                dataType: "json",
                success: function(dados)
                		{
    		   			   alert(dados["msg"]);
						   var cod_eqp_ubs = $('#cod_eqp_ubs');
						   var cod_unsa = $('#cod_unsa');
						   var url_unsa = 'equipe/cod_unsa/' + cod_unsa.val();
						   var url_profis = 'profissional/cod_eqp_ubs/' + cod_eqp_ubs.val();
						   if (nome == 'fProfissional')
						   {
						        $('#cod_profis_ubs').load(url_profis,null,function(){$('#cod_profis_ubs').attr('value', dados["profis"]);});
						   }
						   else
						   {
							   $('#cod_eqp_ubs').load(url_unsa,null,function(){$('#cod_eqp_ubs').attr('value', dados["eqp"]);});
							   $('#cod_profis_ubs').html("");
						   }
						   $("#janela").dialog('close');
						}
        });
        return false; // Previne o form de ser enviado pela forma normal
	});


}