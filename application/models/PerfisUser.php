<?php
class Model_PerfisUser
{
  	
	protected $_table;
	
	public function getTable()
	{
		if(null ===$this->_table)
		{
			require_once APPLICATION_PATH.'/models/DbTable/PerfisUser.php';
			$this->_table= new Model_DbTable_PerfisUser;
		}
		return $this->_table;
	}
	
	
	public function listAll()
	{
	
		
	 return $this->getTable()->fetchAll()->toArray();
	 
	 
	}
	public function listFromId($id)
	{
		$db=$this->Conecta();
		$select = $db->select()->from(array('pfu' => 'perfil_user'),array(
                                'pfu.id_perfil_rel as role'
                             ))->where("pfu.id_user_rel = ?", $id);
	
		$res= $db->fetchAll($select);
foreach($res as $in){$finalResult[]=$in['role'];}
	return $finalResult;
	 
	 
	}
	public function perfil_exist($id,$id_perfil)
	{
		$db=$this->Conecta();
		$select = $db->select()->from(array('pfu' => 'perfil_user'),array(
                                'pfu.id_perfil_rel as role'
                             ))->where("pfu.id_user_rel = ?", $id)
			->where("pfu.id_perfil_rel = ?", $id_perfil);
	
		$res= $db->fetchAll($select);
		$finalResult=true;
		if(count($res)<1){$finalResult=false;}
		
	return $finalResult;
	 
	 
	}
	public function perfil_sync($id,array $name_perfil)
	{
	$perfis=$name_perfil;
	//inclusão de roles
	$perfil=new Model_Perfil();
	foreach($name_perfil as $r){
		$id_perfil=$perfil->getByName($r)['id'];
		if(!$this->perfil_exist($id,$id_perfil)){
			$this->insert(array('id_perfil_rel'=> $id_perfil,'id_user_rel'=>$id));
		}
}

	//exclusão de roles

	$perfis_concedidos=$this->listRolesById($id);
	foreach($perfis_concedidos as $k=>$c){
		if($this->perfil_exist($id,$c['role']) && !in_array($c['nome'],$name_perfil)
){
			$this->delete($c['id_perfil_user']);


		}
	}
	
	 
	 
	}
public function perfil_syncLDAP($id,array $name_perfil)
	{
	$perfis=$name_perfil;
	//inclusão de roles
	$perfil=new Model_Perfil();
	foreach($name_perfil as $r){
		$id_perfil=$perfil->getByName($r)['id'];
		if(!$this->perfil_exist($id,$id_perfil)){
			$this->insert(array('id_perfil_rel'=> $id_perfil,'id_user_rel'=>$id));
		}
}

	//exclusão de roles

	$perfis_concedidos=$this->listRolesByIdLDAP($id);
	foreach($perfis_concedidos as $k=>$c){
		if($this->perfil_exist($id,$c['role']) && !in_array($c['nome'],$name_perfil)
){
			$this->delete($c['id_perfil_user']);


		}
	}
	
	 
	 
	}

    public function listRoleNameById($id)
	{
		$db=$this->Conecta();
		$select = $db->select()->from(array('pfu' => 'perfil_user'),array(
                               'pfu.id_perfil_user', 'pfu.id_perfil_rel as role','p.nome'
                             ))
			->joinInner(array(
                            'p'=>'perfil'),
                            'pfu.id_perfil_rel= p.id'
                         )  
			->where("pfu.id_user_rel = ?", $id);
	
		$res= $db->fetchAll($select);
foreach($res as $in){$finalResult[]=$in['nome'];}
	return $finalResult;
	 
	 
	}
public function listRolesById($id)
	{
		$db=$this->Conecta();
		$select = $db->select()->from(array('pfu' => 'perfil_user'),array(
                               'pfu.id_perfil_user',  'pfu.id_perfil_rel as role','p.nome'
                             ))
			->joinInner(array(
                            'p'=>'perfil'),
                            'pfu.id_perfil_rel= p.id'
                         )  
			->where("pfu.id_user_rel = ?", $id);
	
		$res= $db->fetchAll($select);

	return $res;
	 
	 
	}
public function listRolesByIdLDAP($id)
	{
		$db=$this->Conecta();
		$select = $db->select()->from(array('pfu' => 'perfil_user'),array(
                               'pfu.id_perfil_user',  'pfu.id_perfil_rel as role','p.nome'
                             ))
			->joinInner(array(
                            'p'=>'perfil'),
                            'pfu.id_perfil_rel= p.id'
                         ) ->where("p.origem = ?", "LDAP")
			->where("pfu.id_user_rel = ?", $id);
	
		$res= $db->fetchAll($select);

	return $res;
	 
	 
	}
	public function listRolesFromLogin($login){
	
		$db=$this->Conecta();
		$select = $db->select()->distinct()
             ->from(array('pfu' => 'perfil_user'),array(
                                'pfu.id_perfil_rel as role','p.nome'
                             ))
			 ->joinInner(array(
                            'u'=>'usuario'),
                            'pfu.id_user_rel= u.id'
                         )  
			->joinInner(array(
                            'p'=>'perfil'),
                            'pfu.id_perfil_rel= p.id'
                         )  
			->where('u.login = ? ',$login)
			 ;
	$res= $db->fetchAll($select);	
	$finalResult=array();
	foreach($res as $in){$finalResult[]=$in['role'];}
	return $finalResult;
	}
	public function listRolesNameFromLogin($login){
	
		$db=$this->Conecta();
		$select = $db->select()->distinct()
             ->from(array('pfu' => 'perfil_user'),array(
                                'pfu.id_perfil_rel as role','p.nome'
                             ))
			 ->joinInner(array(
                            'u'=>'usuario'),
                            'pfu.id_user_rel= u.id'
                         )  
			->joinInner(array(
                            'p'=>'perfil'),
                            'pfu.id_perfil_rel= p.id'
                         )  
			->where('u.login = ? ',$login)
			 ;
	$res= $db->fetchAll($select);	
	$finalResult=array();
	foreach($res as $in){$finalResult[]=$in['nome'];}
	return $finalResult;
	}
		
		
	public function getOne($id)
	{
		$table=$this->getTable();
		$consulta=$table->select()->where("id_perfil_user = ?", $id);
	
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

	
	public function delete($id)
	{
	
			$table=$this->getTable();
			$where = $table->getAdapter()->quoteInto('id_perfil_user = ?', $id);
			$table->delete($where);
	
	
	
	
	}
	protected function Conecta()
	{
	require_once 'Zend/Config.php';
	require_once 'Zend/Db.php';

	$config = new Zend_Config_Ini ('../application/configs/application.ini','production');
	$db = Zend_Db::factory($config->resources->db);
	return $db;
}
	
}
