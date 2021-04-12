<?php
class Model_Acoes
{
  	
	protected $_table;
	
	public function getTable()
	{
		if(null ===$this->_table)
		{
			require_once APPLICATION_PATH.'/models/DbTable/Acoes.php';
			$this->_table= new Model_DbTable_Acoes;
		}
		return $this->_table;
	}
	
	
	public function listaAcoes()
	{	
	/**
	*  me deu um baile 
	*  devia ter estudado fetchAll() antes---
	*
	**/
	$tab=$this->getTable()
	 ->fetchAll(
					$this->getTable()->select()
					->setIntegrityCheck(false)
					->from(array('f' => 'acoes'))
					->joinInner(array(
                            'p'=>'permissoes'),
                            'f.id_controle = p.id_funcionalidade',array('p.*','f.*')
                         )
	 			->order('id_controle')
	 		->order('ordem_acao')
	 
				)->toArray();
			
	 return $tab;
	 	 
	}
	
	
	
	public function verAcao($id1)
	{
	
	 $table=$this->getTable();
	 $consulta=$table->select()->
						
						where("id_acao = ?", $id1);
		
	 return $table->fetchRow($consulta)->toArray();
	}
	
	public function getAllActionByFeature($idFeature)
	{
	
	 $table=$this->getTable();
	 $consulta=$table->select()->
						
						where("id_controle = ?", $idFeature);
		
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
	public function altera(array $dados, $id2)
	{
		
		$table=$this->getTable();
		$where = $table->getAdapter()->quoteInto('id_acao = ?', $id2);
		$linhasatualizadas= $table->update($dados, $where);
	 
		
	}
	
	public function exclui($dados1)
	{
	
		foreach ($dados1 as $valor=>$c) 
		{
		$table=$this->getTable();
		$where = $table->getAdapter()->quoteInto('id_acao = ?', $c);
		$table->delete($where);
		
		}
	 
	 
	}
	
	
}
