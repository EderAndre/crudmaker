
//JavaScript Document
$().ready(function(){
	
	//mascaras
	 //	 	endrua 	 	endcompl 	cidade 	estado 	objetivo 	atv_fisica_fav 	emerg 	
		// este funciona--> $("#fonefixo").mask("(99) 9999-9999",{completed:function(){alert("Seu fone fixo: "+this.val());}});  
	$(".telefone").mask("(99) 9999-9999");  	
	$(".celular").mask("(99) 9999-9999"); 
	 $(".numero").mask("?9999999999");  
	$(".cep").mask("99.999-999");  
	$(".data").mask("99/99/9999",{placeholder:"_"}); 
	$(".nb").mask("999.999.999-9");  
	$(".proc").mask("99999.999999/2099-99");  
	$(".ctc").mask("99999999/9-999999"); 
		 //$("#cpf").mask("999.999.999-99");  
		 //$("#cnpj").mask("99.999.999/9999-99");  
	//
	
	

	
	
	
});



	
