<?php
class Aplicacao_Paginador_Monta
{
    /**

     */
	
 
    public function constructor($dados, $page,$lines=10)
    {
		
	$paginator = Zend_Paginator::factory($dados);
        $paginator->setCurrentPageNumber($page)
                  ->setItemCountPerPage($lines)
				  ;
 
        
 
       
 	
	return $paginator;
    }

	
  
}
