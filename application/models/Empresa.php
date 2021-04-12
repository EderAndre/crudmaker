<?php
class Model_Empresa

{
  	
	protected $_table;
	
	public function getTable()
	{
		if(null ===$this->_table)
		{
			require_once APPLICATION_PATH.'/models/DbTable/Empresa.php';
			$this->_table= new Model_DbTable_Empresa;
		}
		return $this->_table;
	}
	
	
	public function lista()
	{	
	
	$tab=$this->getTable()
	 ->fetchAll(
					$this->getTable()->select()
					->setIntegrityCheck(false)
					->from(array('f' => 'empresa'))
					 
				)->toArray();
			
	 return $tab;
	 	 
	}
	
	
	
	public function ver1($id1)
	{
	
	 $table=$this->getTable();
	 $consulta=$table->select()->
						
						where("id = ?", $id1);
		
	 return $table->fetchRow($consulta)->toArray();
	}
	
	public function inclui(array $dados,$img)
	{
	
		$table=$this->getTable();
	if($img==NULL){unset ($dados['imagem_inicio']);} else {	$dados['imagem_inicio']=$img;}
		$campos=$table->info(Zend_Db_Table_Abstract::COLS);
		foreach ($dados as $campo=> $value)
		{
			if(!in_array($campo, $campos))
				{ unset($dados[$campo]);
				}
			
		}
	 return $table->insert($dados);
	 
	 
	}
	
	public function verMaior($id1)
	{
	
		$table=$this->getTable();
		$consulta=$table->select()->
	
		where("id > ?", $id1);
	
		return $table->fetchRow($consulta)->toArray();
	}
	
	
	
	public function altera(array $dados, $id2, $img)
	{
		
		$table=$this->getTable();
	if($img==NULL){unset ($dados['imagem_inicio']);} else {	$dados['imagem_inicio']=$img;}
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
	
	
}
