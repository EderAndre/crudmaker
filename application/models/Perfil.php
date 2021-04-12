<?php
class Model_Perfil
{
    protected $_table;
	
	public function getTable()
	{
		if(null ===$this->_table)
		{
			require_once APPLICATION_PATH.'/models/DbTable/Perfil.php';
			$this->_table= new Model_DbTable_Perfil;
		}
		return $this->_table;
	}
		
	public function listaPagina()
	{
	 return $this->getTable()->fetchAll()->toArray();
	}
	
	public function _pagina($id1)
	{
	return $this->getTable()->find($id1)->toArray();
	}
	
	public function lista()
	{
		return $this->getTable()->fetchAll()->toArray();
	}
	
	public function ver1($id1)
	{
		//return $this->getTable()->find($id1)->toArray();
		$table=$this->getTable();
		$consulta=$table->select()->
		
		where("id = ?", $id1);
		
		return $table->fetchRow($consulta)->toArray();
		
	}
	public function getByName($name)
	{
		//return $this->getTable()->find($id1)->toArray();
		$table=$this->getTable();
		$consulta=$table->select()->
		
		where("nome = ?", $name);
		
		return $table->fetchRow($consulta)->toArray();
		
	}
	public function nomeExiste($nome)
	{
		//return $this->getTable()->find($id1)->toArray();
		$table=$this->getTable();
		$consulta=$table->select()->
		
		where("nome = ?", $nome);
		
		return count($table->fetchAll($consulta)->toArray());
		
	}
	
	public function inclui(array $dados)
	{
	
		$table=$this->getTable();
		$campos=$table->info(Zend_Db_Table_Abstract::COLS);
		foreach ($dados as $campo=> $value)
		{
			if(!in_array($campo, $campos))
			{
				unset($dados[$campo]);
			}
	
		}
		return $table->insert($dados);
	
	
	}
	public function altera(array $dados, $id2)
	{
	
		$table=$this->getTable();
		$where = $table->getAdapter()->quoteInto('id = ?', $id2);
		$linhasatualizadas= $table->update($dados, $where);
	
	
	}
	
	public function exclui($dados1)
	{
	
		foreach ($dados1 as $valor=>$c)
		{
			$table=$this->getTable();
			$where = $table->getAdapter()->quoteInto('id = ?', $c);
			$table->delete($where);
	
		}
	
	
	}
	
	public function verMaior($id1)
	{
	
		$table=$this->getTable();
		$consulta=$table->select()->
	
		where("id >= ?", $id1);
	
		return $table->fetchAll($consulta)->toArray();
	}
	public function verOrigem($origem)
	{
	
		$table=$this->getTable();
		$consulta=$table->select()->
	
		where("origem= ?", $origem);
	
		return $table->fetchAll($consulta)->toArray();
	}
	
	
}
