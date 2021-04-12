

var conceded,koptions;	
$().ready(function() {
/*
		
	var conceded=$("input[name='perfil_id']").val();
	var options=$("input[name='perfil_id']").val();
	conceded=str.split(',');
	options=options.split(',');
	
	$("input[name='perfil_id']").after('<div class="col-md-4 border" ><span class="badge badge-info">'
+array.join('</span>&nbsp;<span class="badge badge-info">')
+'</span></div>');
	
	*/

	conceded=$("input[name='perfis_concedidos']").val().split(',');
	var koptions=$("input[name='perfis']").val().split(',');
//alert(koptions);
	
$("input[name='perfis_concedidos']").amsifySuggestags({
 suggestions: koptions

})
	
	
	
});
	
	
	

	
