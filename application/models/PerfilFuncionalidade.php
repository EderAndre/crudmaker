<?php
class Model_PerfilFuncionalidade 
{
	private $_idPerfil;
	private $_idFunc;
	protected $_table;
	
	public function getTable()
	{
		if(null ===$this->_table)
		{
			require_once APPLICATION_PATH.'/models/DbTable/Perfilfunc.php';
			$this->_table= new Model_DbTable_Perfilfunc;
		}
		return $this->_table;
	}
	
	
	public function listaFunc($perfil)
	{
		
	$table=$this->getTable();
	$consulta=$table->select()->where("id_perfil_rel = ?", $perfil);
		
	 return $table->fetchAll($consulta)->toArray();
	
	 
	 
	}
	
	
		
	public function getIdPerfil()
	{
				return $this->_idPerfil;
	}

	public function setIdPerfil($perfilId)
	{
		$this->_idPerfil = (int) $perfilId;
	}

	public function getIdFunc()
	{
		return $this->_idFunc;
	}

	public function setIdFunc($idFunc)
	{
		$this->_idFunc = (array) $idFunc;
	}
	
	public function lista($id)
	{
	
		$table=new Model_Acoes();
		$consulta=$table->listaAcoes();
	
	//	return $table->fetchAll($consulta)->toArray();
	foreach($consulta as $k=>$r)
	{
		$n=$this->acaoExiste($r['id_acao'],$id);
	//	$n=1;
		if($n==1){$r['select']="Checked";}else{$r['select']="";}
		$resultado[]=$r;
	}
	return $resultado;
	
	
	
	}
	
	public function permite($id,$id2)
	{
		//$this->cleanPerm($id2);
	
		
		foreach($id as $t=>$w)
		{
			$teste=$this->acaoExiste($w, $id2);
			
			if($teste==0)
			{
				$table=$this->getTable();
				$dados['id_acao_rel']=$w;
				$dados['id_perfil_rel']=$id2;
				$table->insert($dados);
			} 
			
			
		}
		return true;
		
	}
	
	public function cleanPerm($id_perfil)
	{
		$table=$this->getTable();
		$where = $table->getAdapter()->quoteInto('id_perfil_rel = ?', $id_perfil);
		 $table->delete($where);
	}
	
	public function acaoExiste($id,$id2)
	{
		
		
		$table=$this->getTable();
		$consulta=$table->select()
		->where('id_acao_rel = ?',$id)
		->where('id_perfil_rel = ?',$id2);
		
		$nr=$table->fetchRow($consulta);
		//	return $table->fetchAll($consulta)->toArray();
		if(count($nr)>0){return 1;} else {return 0;}
	
	
	
	}
public function exclui($acao, $perfil)
	{
			
		$table=$this->getTable();
		$condicao = array(
                   'id_acao_rel = ' . $acao,
                   'id_perfil_rel = '. $perfil
					);
					
		$table->delete($condicao);
		
		
	 
	}
public function deleteFromAllProfiles($acao)
	{
			
		$table=$this->getTable();
		$condicao = array(
                   'id_acao_rel = ' . $acao
					);
					
		$table->delete($condicao);
		
		
	 
	}
	
	
	
	
}
