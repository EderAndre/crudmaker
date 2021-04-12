<?php
class Aplicacao_Protocolos_Petroski95
{
    /**
     * @var Zend_Acl
     */
   
 
    public function _constructor()
    {	
		
		
		
		
    }
	
   	
    public function densidadeCorporalMasculina($idade,$tricipital,$subescapular,$suprailiaca,$panturrilha_media)
	{
	
		$soma=$tricipital+$subescapular+$suprailiaca+$panturrilha_media;
		$densidade=1.10726863-0.00081201*($soma)+ 0.00000212*(($soma)*($soma))-0.00041761*($idade);
		
		return $densidade;
			
	}
 
	
	public function percentualGorduraMasculino($densidade, $casasDecimais)
	{
		$percentual=((4.95/$densidade)-4.5)*100;
		$percentual=number_format($percentual,$casasDecimais);
	
		return $percentual;
			
	}
	
	public function densidadeCorporalFeminina($idade,$axilar_media, $suprailiaca, $coxa, $panturrilha_media)
	{
		//
		$soma=$axilar_media+$coxa+$suprailiaca+$panturrilha_media;
		$densidade=1.1954713-0.07513507*log10($soma)-0.00041072*($idade);
	
		return $densidade;
			
	}
	
	
	public function percentualGorduraFeminino($densidade, $casasDecimais)
	{
		
		$percentual=((5.01/$densidade)-4.57)*100;
		$percentual=number_format($percentual,$casasDecimais);
	
		return $percentual;
			
	}
}
