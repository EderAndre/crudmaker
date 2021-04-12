function formatar(src, mask){
  var i = src.value.length;
  var saida = mask.substring(0,1);
  var texto = mask.substring(i);
if (texto.substring(0,1) != saida)
  {
    src.value += texto.substring(0,1);
  }
}

function gerador()
{
	          
	data = new Date();
    var time = data.getUTCMilliseconds();
	//var time=Date.setUTCDate();
	 var  str = 'ederas'+time;
	 // Ele faz um md5 da variavel $aux e captura os 6 primeiros caracteres
	  str=hex_md5(str);
	 var senha = str.substr(0,8);
    
    return senha;


}


$().ready(function() {
	$('#nome0').keyup(function(){

		nome = $(this).val();
		
		$.post('../cadastro/existe', {nome:nome}, function(data) {
		
				 
				 $('#result0').html(data);
				 
							
				
		 }); 
		}); 
	   }); 


//JavaScript Document
$().ready(function(){
	
	$('#mais').click(function(){
				   var senha = gerador();

		
		
		var next = $('#lista tbody').children('tr').length +1;
	//	var indexSelect=$("#select-linha0 select").attr('selectedIndex');
		var clone= $("#select-linha0 select").clone(true);
	/*	.each(function(){
			if(indexSelect){
				$('select',this).attr('selectedIndex',indexSelect);
			}
			
		});
		*/
		
		$('#lista tbody').append('<tr id="incluir' + (next-1) + '">' +
				'<td>' + (next) + '</td>'+
	        	'<td> <input type="text" id="nome' + (next-1) + '" class="required nome" name="incluir[' + (next-1) + '][login]" size="5" autocomplete="off"  /></td>'+
	        	'<td><span id="result' + (next-1) + '" ></span></td>' + 
	            '<td><input type="text" class="required" name="incluir[' + (next-1) + '][nome_completo]" size="20" /></td>' +
	            '<td><input type="text" class="required email" name="incluir[' + (next-1) + '][email]" size="15" /></td>'+
	            '<td id="select-linha' + (next-1) +'">'+
	            '</td>'+
	            '<td class="linha-right"><input type="text" class="required" name="incluir[' + (next-1) + '][senha]" size="8" value="' +senha + '" /></td>' +
		        '</tr>'
	            );
		
		$('#select-linha' + (next-1)).append(clone.attr("name", "incluir[" + (next-1) +"][perfil_id]").
												val($('#select-linha' + (next-2)+' select').val()));
		$().ready(function() {
		$('#nome'+ (next-1)).keyup(function(){

			nome = $(this).val();
			
			$.post('../cadastro/existe', {nome:nome}, function(data) {
			
					 
					 $('#result'+(next-1)).html(data);
								
					
			 }); 
			}); 
		   }); 
		
		
		return false;
	});
	
$('#menos').click(function(){
		
		var anterior = $('#lista tbody').children('tr').length-1 ;
				
		if (anterior>=1){
		
		$("#incluir"+anterior).remove();
		
		
		
		return false;
		}
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
$(document).ready( function()
		{
		        var senha=gerador();
		         $("input[name='incluir[0][senha]']"). val(senha );
		         
		});

$.validator.setDefaults({
	submitHandler: function() {
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
	
	
	

	
	
	
});


	
