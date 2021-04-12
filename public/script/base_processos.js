//JavaScript Document
$().ready(function(){
	
	
	var nb=$( "input[name='nb']" ).val();
	var especie=$( "select[name='id_especie_rel']" ).val();
$("input[name='tipo']").change(function(){
		
	var valor=$(this).val();
	
		
	if(valor=='proc'){
		$( "input[name='nb']" ).attr( "class", "" ).attr( "class", "proc" ).mask("99999.999999/9999-99").focus().val(nb);
		$( "select[name='id_especie_rel']" ).val('');
		$( "select[name='id_especie_rel']").hide();	
		$( "select[name='id_especie_rel']").parent().prev().hide();	
		$( "#nb-label").html('<label for="nb" class="required">Processo:</label>');	
	};
	
	
	if(valor=='ctc'){
		$( "input[name='nb']" ).attr( "class", " " ).attr( "class", "ctc" ).mask("99999999/9-999999").focus().val(nb);
		$( "select[name='id_especie_rel']" ).val('');
		$( "select[name='id_especie_rel']").hide();	
		$( "select[name='id_especie_rel']").parent().prev().hide();	
		$( "#nb-label").html('<label for="nb" class="required">CTC:</label>');	
	
	};	
	
	
	if(valor=='nb'){
		$( "input[name='nb']" ).attr( "class", "" ).attr( "class", "nb" ).mask("999.999.999-9").focus().val(nb);
		$( "select[name='id_especie_rel']" ).val(especie);
		$( "select[name='id_especie_rel']").show();	
		$( "select[name='id_especie_rel']").parent().prev().show();	
		$( "#nb-label").html('<label for="nb" class="required">NB:</label>');	
	
	};


	


	
	
	
	

	
	
	
});
});


	
