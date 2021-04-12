<?php
class Model_Banco extends Zend_Db_Table

    
{
	protected $_name;

	

public function setTable($tabela)
{
	$this->_name=$tabela;
	
}

public function getTable()
{

	return  $this->_name;

}




public  function tabelas()
{
       
       $dbAdapter = Zend_Db_Table::getDefaultAdapter();
       $tabelas=$dbAdapter->listTables();
          return $tabelas;
      
    }
    
    public  function describe($tabela)
    {
    	 
    	$dbAdapter = Zend_Db_Table::getDefaultAdapter();
    	
    	$res=$dbAdapter->describeTable($tabela);
    	return $res;
    
    }
    public  function create($tabela)
    {
    
    	$dbAdapter = Zend_Db_Table::getDefaultAdapter();
    	 
    	$res=$dbAdapter->fetchRow('SHOW CREATE TABLE '.$tabela);
    	return $res;
    
    }

public function linhas($tabela)
{
		$this->_name=$tabela;
		$tabelas2=$this->fetchAll()->toArray();
    	return $tabelas2;
    
  }
  public  function addCol($tabela, $novaColuna)
  {
  
  	$dbAdapter = Zend_Db_Table::getDefaultAdapter();
  
  $dbAdapter->fetchRow('ALTER TABLE '.$tabela.' ADD '.$novaColuna.' float AFTER circ_pd');
  
  
  }
  
  public  function dropCol($tabela,array $colunas)
  {
  
  	$dbAdapter = Zend_Db_Table::getDefaultAdapter();
  	
  foreach($colunas as $f=>$c):
  	$dbAdapter->fetchRow('ALTER TABLE '.$tabela.' DROP '.$c);
  endforeach;
  
  }
  public  function listaCol($tabela)
  {
  
  	$this->_name=$tabela;
	$tabelas2=$this->info(Zend_Db_Table_abstract::COLS);
  	return $tabelas2;
  
  }
  
    
    
}