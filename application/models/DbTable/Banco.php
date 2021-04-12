<?php

class Model_DbTable_Banco extends Zend_Db_Table
{
    protected $_name='';
    public function setName($tabela)
    {
    	$this->_name=$tabela;
    }
    public function getName()
    {
    	return $this->_name;
    }
}
