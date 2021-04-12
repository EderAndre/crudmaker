<?php
class Aplicacao_Protocolos_Torres98
{
    /**
     * @var Zend_Acl
     */
   
 
    public function _constructor()
    {	
		
		
		
		
    }
	
   	
  
	public function percentualGorduraMasculino($altura,$pescoço,$abdomen, $casasDecimais)
	{
		//85.20969*LOG(B22*0.39-B17*0.39)-69.73016*LOG(B8*100*0.39)+37.26673
		$percentual=85.20969 * log10(($abdomen * 0.39)-($pescoço * 0.39))-69.73016 * log10($altura * 100 * 0.39) + 37.26673;
		$percentual=number_format($percentual,$casasDecimais);
	
		return $percentual;
			
	}
	
		
	
	public function percentualGorduraFeminino($altura,$pescoço,$abdomen,$quadril, $casasDecimais)
	{
		//161.27327*LOG(B22*0.39+B23*0.39-B17*0.39)-100.81032*LOG(B8*100*0.39)-69.55016
		$percentual=161.27327*log10($abdomen*0.39+$quadril*0.39-$pescoço*0.39)-100.81032*log10($altura*100*0.39)-69.55016;
		$percentual=number_format($percentual,$casasDecimais);
	
		return $percentual;
			
	}
}
