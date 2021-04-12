<?php
class Model_Crud
{
  	
	protected $_table;
	
	public function getTable()
	{
		if(null ===$this->_table)
		{
			require_once APPLICATION_PATH.'/models/DbTable/Crud.php';
			$this->_table= new Model_DbTable_Crud;
		}
		return $this->_table;
	}
	
	
	public function listAll()
	{
	
		
	 return $this->getTable()->fetchAll()->toArray();
	 
	 
	}
	public function listLikeNome($nome)
	{

	 return $this->getTable()->fetchAll($this->getTable()->select()
					->setIntegrityCheck(false)
					->from(array('f' => 'tb_crud'))
					->where("name LIKE ?",'%'.$nome.'%'))->toArray();
	 
	 
	}
	
		
		
	public function getOne($id)
	{
		$table=$this->getTable();
		$consulta=$table->select()->where("id = ?", $id);
	
		return $table->fetchRow($consulta)->toArray();
	
	
	}
	
			
	
	public function insert(array $dados)
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
	public function update(array $dados, $id)
	{
		
		$table=$this->getTable();
		$campos=$table->info(Zend_Db_Table_Abstract::COLS);
		foreach ($dados as $campo=> $value)
		{
			if(!in_array($campo, $campos))
				{ unset($dados[$campo]);
				}
			
		}
		$where = $table->getAdapter()->quoteInto('id = ?', $id);
					
		$linhasatualizadas= $table->update($dados, $where);
	 
		
	}
	public function delete($id)
	{
	
			$table=$this->getTable();
			$where = $table->getAdapter()->quoteInto('id = ?', $id);
			$table->delete($where);
	
	
	
	
	}
	public function getTableInfo(){
$table=$this->getTable();
		return $table->info(Zend_Db_Table_Abstract::METADATA);	
	}
}
