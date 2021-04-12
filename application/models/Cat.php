<?php
class Model_Cat
{
  	
	protected $_table_name='tb_rotas_2';
	protected $_id_connection=2;
	protected $_db;
	protected $table;

	public function getTable(){

		$md=new Model_Conexoes();	
		$config=$md->getOne($this->_id_connection);
		$this->_db=$this->_connectionGeneric($config);
		$this->table=new Zend_Db_Table(array('name'=>$this->_table_name,'db'=>$this->_db));
	
	}
	
	public function setIdConnection($int){
	
		$this->_id_connection=$int;
	 
	}

	public function getIdConnection(){
	
		return $this->_id_connection;
	 
	}

	public function listAll(){
		$this->getTable();
		$select=$this->_db->select($this->_table_name)->from(array('f' => $this->_table_name));
		
	
		return  $this->_db->fetchAll($select);
	 
	}

	public function listLikeNome($string){

		$this->getTable();
		$query=$this->_db->select($this->_table_name)
						->from(array('f' => $this->_table_name))
					->where("CIDADE_ORIGEM LIKE ?",'%'.$string.'%');
		return $this->_db->fetchAll($query);
	 
	}
	
		
		
	public function getOne($id){

		$this->getTable();
		$table=$this->_db;
		$query=$table->select($this->_table_name)->from(array('f' => $this->_table_name))->where("id = ?", $id);
		return array_map('utf8_encode',$this->_db->fetchRow($query));
	
	}
			
	
	public function insert(array $data){

		$this->getTable();
		$table	=$this->table;	
		$fields=$table->info(Zend_Db_Table_Abstract::COLS);
		foreach ($data as $field=> $value)
		{
			if(!in_array($field, $fields))
				{ unset($data[$field]);
				}
			
		}
	 return $table->insert($data); 
	 
	}

	public function update(array $data, $id){

		$this->getTable();
		$table=$this->table;
		$where = $table->getAdapter()->quoteInto('id = ?', $id);
		$updated_lines= $table->update($data, $where);
	 
		
	}

	public function delete($id){
		$this->getTable();
		$table=$this->table;
		$where = $table->getAdapter()->quoteInto('id = ?', $id);
		$table->delete($where);
	

	}

	public function _connectionGeneric($config){
		require_once 'Zend/Db.php';

		try{
			
			$db = Zend_Db::factory($config['factory'],$config);

		}catch(Exception $e){	

			$db= $e->getMessage();
			
			}
	
		return $db;

	}
public function info(){
$this->getTable();
try{
return $this->table->info(Zend_Db_Table_Abstract::COLS);
}catch(Exception $e){echo $e->getMessage(); exit;}
}

}
