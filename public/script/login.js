

$.validator.setDefaults({
	submitHandler: function() {
		//alert("Enviado!"); 
		document.login.submit()	;
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
	$("#login").validate();
	
	
	$("input #login").focus();	
	

	
	
	
});


	
