<?php
class Aplicacao_Idade_Idade
{
    /**
     * @var Zend_Acl
     */
   
 
    public function _constructor()
    {	
		
		
		
		
    }
	
   	
    public function calculaAnos($dia,$mes,$ano)
	{
	
		if (!checkdate($mes, $dia, $ano)) {
			return "A data que você informou está errada [ $dia/$mes/$ano ]";
			exit;
		}
		$dia_atual = date("d");
		$mes_atual = date("m");
		$ano_atual = date("Y");
		$idade = $ano_atual - $ano;
		if ($mes > $mes_atual) {
			$idade--;
		}
		if ($mes == $mes_atual and $dia_atual < $dia) {
			$idade--;
		}
		return $idade;
			
 }
 
	
}
