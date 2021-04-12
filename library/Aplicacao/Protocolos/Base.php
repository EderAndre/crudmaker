<?php
class Aplicacao_Protocolos_Base
{
    /**
     * @var Zend_Acl
     */
   
 
    public function _constructor()
    {	
		
	
		
    }
    public function todos($peso,$altura,$punho,$femur,$cintura,$quadril,$percentualGord,$percentualGordDesejado)
    {
    
    	$res['Relação_cintura_quadril']=$this->relCinturaQuadril($cintura, $quadril);
    	$res['Peso_gordo']=$this->pesoGordo($peso, $percentualGord);
    	$res['Peso_osseo']=$this->pesoOsseo($altura, $punho, $femur);
    	$res['Peso_residual']=$this->pesoResidual($peso);
    	$res['Peso_muscular']=$this->pesoMuscular($peso, $res['Peso_gordo'], $res['Peso_osseo'], $res['Peso_residual']);
    	$res['Peso_magro']=$this->pesoMagro($peso, $res['Peso_gordo']);
    	$res['Peso_teorico_ideal']=$this->pesoTeoricoIdeal($res['Peso_magro'], $percentualGordDesejado);
    	$res['Excesso_de_peso']=$this->excessoPeso($peso, $res['Peso_teorico_ideal']);
    	$res['Percentual_Muscular']=$this->percentualMuscular($peso, $res['Peso_muscular']);
    
    	return $res;
    
    
    }
	  
	public function relCinturaQuadril($cintura,$quadril)
	{
		
		$rel=$cintura/$quadril;
		$rel=number_format($rel,2);
	
		return $rel;
			
	}
	
		
	
	public function pesoGordo($peso_total,$percentual_Gordura)
	{
		$rel=$peso_total*$percentual_Gordura/100;
		$rel=number_format($rel,2);
	
		return $rel;
			
	}
	
	public function pesoOsseo($altura, $punho, $femur)
	{
		//
		$rel=3.02*($altura*2)*($punho*$femur*400)*0.712;
		$rel=number_format($rel,2);
	
		return $rel;
			
	}
	
	public function pesoResidual($peso_total)
	{
		//
		$rel=$peso_total*24.1/100;
		$rel=number_format($rel,2);
	
		return $rel;
			
	}
	public function pesoMuscular($peso_total,$peso_gordo,$peso_osseo, $peso_residual)
	{
		//
		$rel=$peso_total-($peso_gordo+$peso_osseo+$peso_residual);
		$rel=number_format($rel,2);
	
		return $rel;
			
	}
	
	public function pesoMagro($peso_total,$peso_gordo)
	{
		//
		$rel=$peso_total-$peso_gordo;
		$rel=number_format($rel,2);
	
		return $rel;
			
	}
	
	public function pesoTeoricoIdeal($peso_magro,$percentual_gordura_desejado)
	{
		
		$rel=($peso_magro*100)/(100-$percentual_gordura_desejado);
		$rel=number_format($rel,2);
	
		return $rel;
			
	}
	public function excessoPeso($peso_total,$peso_teorico_ideal)
	{
		
		$rel=$peso_total-$peso_teorico_ideal;
		$rel=number_format($rel,2);
	
		return $rel;
			
	}
	public function percentualMuscular($peso_total,$peso_muscular)
	{
	
		$rel=$peso_muscular*100/$peso_total;
		$rel=number_format($rel,2);
	
		return $rel;
			
	}
	
}
