<?php
class Model_Configs
{
  	
	protected $_table;
	
	public function getTable()
	{
		if(null ===$this->_table)
		{
			require_once APPLICATION_PATH.'/models/DbTable/Configs.php';
			$this->_table= new Model_DbTable_Configs;
		}
		return $this->_table;
	}
	
	
	public function listaConfigs()
	{
	
		
	 return $this->getTable()->fetchAll()->toArray();
	 
	 
	}
	
		
		
	public function verConfigs($id)
	{
		$table=$this->getTable();
		$consulta=$table->select()->where("id_usuario_rel_config = ?", $id);
	
		return $table->fetchRow($consulta)->toArray();
	
	
	}
	public function testaConfigs($id)
	{
		$table=$this->getTable();
		$consulta=$table->select()->where("id_usuario_rel_config = ?", $id)
		->limit(1,0);
	
		return $table->fetchAll($consulta)->toArray();
	
	
	}
			
	
	public function inclui(array $dados)
	{
	
		$table=$this->getTable();
		$campos=$table->info(Zend_Db_Table_Abstract::COLS);
		foreach ($dados as $campo=> $value)
		{
			if(!in_array($campo, $campos))
				{ unset($dados[$campo]);
				}
			
		}
	 return $table->insert($dados);
	 
	 
	}
	public function altera(array $dados, $id)
	{
		
		$table=$this->getTable();
		$where = $table->getAdapter()->quoteInto('id_usuario_rel_config = ?', $id);
		$linhasatualizadas= $table->update($dados, $where);
	 
		
	}
	public function exclui($dados1)
	{
	
		foreach ($dados1 as $valor=>$d)
		{
			$table=$this->getTable();
			$where = $table->getAdapter()->quoteInto('idconfigs = ?', $d);
			$table->delete($where);
	
		}
	
	
	}
}
