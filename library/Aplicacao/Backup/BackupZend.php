<?php
class Aplicacao_Backup_BackupZend
{
    /**
     * @var Zend_Acl
     */
   
 
    public function _constructor()
    {	
		
		$this->backup_tables();
		
		
    }
	
   	
    protected function backup_tables()
	{
	
		//lista tabelas
		$tabelas=new Model_Banco();
		$tabelas1=$tabelas->tabelas();
		
		
		//obtem dados
		foreach($tabelas1 as $r=>$k)
		{
			
			$return.= '-- Tabela '.$k.";\n";
			
			$linhas=new Model_Banco();
		
			$create=$linhas->create($k);
			$return.= "\n\n".$create['Create Table'].";\n\n";
		
			$colunas=$linhas->describe($k);
			
			$num_campos=count($colunas);
			$linhas=$linhas->linhas($k);
			
			foreach($linhas as $t=>$e)
				{
					$return.= 'INSERT INTO '.$k.' VALUES(';
					
					$values=[];
					foreach($e as $l=>$j)
						{
						
						if (isset($j) && $j != null) { 
						$j = addslashes($j);
						$j = ereg_replace("\n","\\n",$j);
							
							$values[]= '"'.$j.'"' ; 
						} else { 
						$values[]= 'null';
						}

						
						}
					$return.=join(',',$values);
					$return.= ");\n";
		
				}
		
		
	
			$return.="\n\n\n";
		}
			
		$data=date('Y').'-'.date('m').'-'.date('d').'_as_'.date('H_\h\s_\-_i_\m\i\n_\e_s_\s');
			$nome='backup_SQL/BackupZend_em_'.$data.'.sql';
			$handle = fopen($nome,'w+');
			fwrite($handle,$return);
					fclose($handle);
					chmod($handle, 0777);
					chmod('backup_SQL/'.$nome, 0777);
					return $handle;
	
	
 }
	
}
