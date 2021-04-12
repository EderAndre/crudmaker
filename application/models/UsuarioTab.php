<?php
class Model_UsuarioTab
{
  	
	protected $_table;
	
	public function getTable()
	{
		if(null ===$this->_table)
		{
			require_once APPLICATION_PATH.'/models/DbTable/Usuario.php';
			$this->_table= new Model_DbTable_Usuario;
		}
		return $this->_table;
	}
	
	
	public function listaUsuario()
	{
	
		
	 return $this->getTable()->fetchAll()->toArray();
	 
	 
	}
	public function ver1Usuario($matr)
	{
	
		
	return $this->getTable()->fetchRow(
				
				$this->getTable()->select()
				->where("login = ?", $matr)
				)
				
				
				->toArray();
	 
	 
	}
	public function listaUsuarioFEscola($id1)
	{
	
	
		return $this->getTable()->fetchAll(
				
				$this->getTable()->select()
				->setIntegrityCheck(false)
				->from(array('f' => 'usuario'))
				->where("escola = ?", $id1)
				)
				
				
				->toArray();
	
	
	}
	public function pertence($id,$escola )
	{
	
		$table=$this->getTable();
		$consulta=$table->select()
		->where("id = ?", $id)
		->where("escola = ?", $escola)
	
		;
	
		$nr=$table->fetchRow($consulta);
	
		//return count($nr);
		return count($nr);
	
		/*
		 $where = $table->getAdapter()->quoteInto('id = ?', $id2);
		//senha em sha2
		$dados=$table->getAdapter()->quoteInto(SHA1($dados) );
	
		$linhas= $table->select($dados, $where);
		*/
	
	}
}