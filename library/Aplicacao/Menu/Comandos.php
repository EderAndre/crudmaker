<?php
class Aplicacao_Menu_Comandos
{
    /**
     * @var Zend_Acl
     */
	
	protected $_comandos;
	
 
    public function constructor($perfil, $base, $perfilMin, $linkAdd,$LinkReport, $acoes=array())
    {
    	
    	$add= "<a class='mouseOn' href='$linkAdd'><img  src='$base/src/img/add.png' alt='Novo Registro' title='Novo Registro'/></a>";
    	$excl= "<a class='mouseOn' href='javascript:void(0)'><img  src='$base/src/img/exc.png' alt='Excluir selecionados' title='Excluir selecionados' onclick='document.form1.submit();'/></a>";
    	$report= "<a class='mouseOn' target='_blank' href='$LinkReport'><img  src='$base/src/img/reports-icon.png' alt='Relatório PDF' title='Relatório PDF'/></a>";
    	
    	$comandos= "<div class='comandos'>";
    	
    	
    	if($perfil<=$perfilMin){
    		
    	
    	
    	
    	} else {echo "<span><i><b>**</b>Seu perfil não permite movimentação</i></span>";}
    	
		
    	$comandos.= "</div>";
    	 
	}
	
  
}
