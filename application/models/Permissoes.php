<?php
class Model_Permissoes
{
  	
	protected $_table;
	
	public function getTable()
	{
		if(null ===$this->_table)
		{
			require_once APPLICATION_PATH.'/models/DbTable/Permissoes.php';
			$this->_table= new Model_DbTable_Permissoes;
		}
		return $this->_table;
	}
	
	
	public function listaPermissoes()
	{
	
		
	 return $this->getTable()->fetchAll(
	 		$this->getTable()->select()
	 		->setIntegrityCheck(false)
	 		->from(array('f' => 'permissoes'))
	 		->order('ordem_controles')
	 		)->toArray();
	 
	 
	}
	
	public function verPermissao($id)
	{
	 $table=$this->getTable();
	 $consulta=$table->select()->where("id_funcionalidade = ?", $id);
		
	 return $table->fetchRow($consulta)->toArray();
	 
	 
	}
	
	public function verMaior($id1)
	{
	
		$table=$this->getTable();
		$consulta=$table->select()->
	
		where("id_funcionalidade > ?", $id1);
	
		return $table->fetchRow($consulta)->toArray();
	}
	
	
	public function incluiPermissoes(array $dados)
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
	public function alteraPermissoes(array $dados, $id)
	{
		
		$table=$this->getTable();
		$where = $table->getAdapter()->quoteInto('id_funcionalidade = ?', $id);
		$linhasatualizadas= $table->update($dados, $where);
	 
		
	}
	public function exclui($dados1)
	{
	
		foreach ($dados1 as $valor=>$d)
		{
			$table=$this->getTable();
			$where = $table->getAdapter()->quoteInto('id_funcionalidade = ?', $d);
			$table->delete($where);
	
		}
	
	
	}
public function exists($featureName)
	{
		
	$table=$this->getTable();
	$query=$table->select()->where("funcionalidade = ?", $featureName);
		
	 return $table->fetchAll($query)->toArray();
	
	 
	 
	}

}
