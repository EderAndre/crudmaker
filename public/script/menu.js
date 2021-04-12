/**
 * @author Felipe
 *Se for usar me avisa e comenta o post 
 */

$(document).ready(function(){

    $("ul li ul").hide();//aqui eu escondo as ul´s que forem filhas de li.
    $("ul li").hover(function(){//O método hover recebe dois parametros que são duas funções.
        $(this).find("ul:first").stop(true,true).slideDown("fast"); //aqui você faz o que quiser quando o mouse estiver em cima
        
    }, function(){
        $(this).find("ul:first").stop(true,true).fadeOut("medium"); //aqui é como se fosse o callback e você também faz o que quiser.
		}
		);
});