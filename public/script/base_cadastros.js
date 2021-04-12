
//JavaScript Document
$().ready(function(){
	
	
	$("#telefone").mask("(99) 99999-9999");  	
	$("#telefone_movel").mask("(99) ?9999-9999"); 
	 
	 	$("#numero").mask("?99999");  
		 $("#cep").mask("99.999-999");  
		 $("#data_nascimento").mask("99/99/9999",{placeholder:"_"}); 
		 //$("#cpf").mask("999.999.999-99");  
		 //$("#cnpj").mask("99.999.999/9999-99");  
	//
	
	$('#mais').live('click',function(){
				  

		
		
		var next = $('#lista tbody').children('tr').length + 1;
		
		var id = $('#id1').val();
		
		
			var clone= $("#select-linha0 select").clone(true);
			

			
		
		
	
					
					$('#lista tbody').append('<tr id="incluir' + (next-1) + '">' +
							'<td>' + (next) + '</td>'+
				        	'<td id="select-linha' + (next-1) +'">'+
				            '<input type="hidden"  name="incluir[' + (next-1) + '][id_cliente_rel]" value="'+id+'" /></td>'+
				            '<td><input type="text" class="required" name="incluir[' + (next-1) + '][horario_ini]" size="8" /></td>'+
				            '<td><input type="text" class="required" name="incluir[' + (next-1) + '][horario_final]" size="8" /></td>'+
				             '</tr>'
				            );
					
					
				
		
		$('#select-linha' + (next-1)).append(clone.attr("name", "incluir[" + (next-1) +"][dia_semana]").
				val($('#select-linha' + (next-2)+' select').val()));

		
		return false;
	});
	
$('#menos').click(function(){
		
		var anterior = $('#lista tbody').children('tr').length-1 ;
				
		if (anterior>=1){
		
		$("#incluir"+anterior).remove();
		
		//$(':hidden').val(next);
		
		
		return false;
		}
	});

$('#add').click(function(){
	
	$('#inclusao').show({
					"model":"modal",
					"title":"Inclui Exercicios na rotina"
	});
});

$('#sair').click(function(){
	
	$(this).parent().hide("slow");
});



$('#enviar,#enviarB').click(function(){
		$('form').submit();
	});
	
	$(':text').live('focus',function(){
		$(this).closest('tr').addClass('input-focus');
	}).live('blur',function(){
		$(this).closest('tr').removeClass();
	});
});





$.validator.setDefaults({
	submitHandler: function() {
		//alert("Enviado!"); 
		document.formulario.submit()	;
	},
	highlight: function(input) {
		$(input).addClass("erroMsg");
	},
	unhighlight: function(input) {
		$(input).removeClass("erroMsg");
		}
});
 
//VALIÇÃO FORMULÁRIO
$().ready(function() {
	jQuery.extend(jQuery.validator.messages, { required: "Campo Requerido"
		, remote: "Please fix this field."
		, email: "email inválido."
		, url: "URL inválida."
		 }); 
		
	// validate signup form on keyup and submit
	$("#formulario").validate();
	
	
	//$("input #nome").focus();	
	

	
	
	
});



	
