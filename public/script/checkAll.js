$().ready(function() {
$('#todosnenhum').change (function(){
		$("input[name='incluir[]']").each(function(){
			
			$valor=$('#todosnenhum').attr('checked');
			$(this).attr("checked", $valor);
		});
	});
});

$().ready(function() {
	$('#todosnenhum').change (function(){
			$("input[class='alunos']").each(function(){
				
				$valor=$('#todosnenhum').attr('checked');
				$(this).attr("checked", $valor);
			});
		});
	});