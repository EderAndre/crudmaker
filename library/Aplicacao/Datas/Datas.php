<?php
class Aplicacao_Datas_Datas
{
    /**
     * @var Zend_Acl
     */
   
 
    public function _constructor()
    {	
		
		
		
		
    }
	
   	
public function data_PtBr_mysql($data)
	{
		 
		if ($data)
		{
				$d= explode("/",$data);
				$data=$d[2]."-".$d[1]."-".$d[0];
				return $data;
			
			
		}
		else{ return null;}
			
	}
public function data_mysql_PtBr($data)
	{
	if ($data)
		{  
		$d= explode("-",$data);
		$data=$d[2]."/".$d[1]."/".$d[0];
		return $data;
		}
		else{ return null;}
		 
    }
 
	
}
