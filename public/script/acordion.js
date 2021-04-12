$(document).ready(function(){
	$('.escondido').hide();
	//Ao clicar no link, executamos a funcão
	$('h2.accordion').click(function(){
	//	$('.escondido').slideUp("fast");
		$(this).next('.escondido').slideToggle("fast");
		
		
			
	});
});