<?php

class Model_DbTable_Permissoes extends Zend_Db_Table_Abstract
{
    protected $_name = 'permissoes';
	
	public function insert(array $dados)
	{
			return parent::insert($dados);
	}
	/**
	*atualizaחדo de dados
	*
	
	public function update(array $dados, $where)
	{
			 
return parent::update($data, $where);
	}
	*/
}
