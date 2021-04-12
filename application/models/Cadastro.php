<?php
class Model_Cadastro
{
  	
	protected $_table;
	
	public function getTable()
	{
		if(null ===$this->_table)
		{
			require_once APPLICATION_PATH.'/models/DbTable/Cadastro.php';
			$this->_table= new Model_DbTable_Cadastro;
		}
		return $this->_table;
	}
	
	
	public function listaCadastro()
	{	
	
	$tab=$this->getTable()
	 ->fetchAll(
					$this->getTable()->select()
					->setIntegrityCheck(false)
					->from(array('f' => 'usuario'))
					
	 
				)->toArray();
			
	 return $tab;
	 	 
	}
	public function listaCadastroLike($radical)
	{	
	
	$tab=$this->getTable()
	 ->fetchAll(
					$this->getTable()->select()
					->setIntegrityCheck(false)
					->from(array('f' => 'usuario'))
					->where("nome_completo LIKE ?",'%'.$radical.'%')
					
	 
				)->toArray();
			
	 return $tab;
	 	 
	}
	
	
	
	public function verCadastro($id1)
	{
	
	 $table=$this->getTable();
	 $consulta=$table->select()->
						
						where("id = ?", $id1);
		
	$result=$table->fetchRow($consulta)->toArray();
	$result['perfis_concedidos']=join(',',$this->roles($id1));
 return $result;
	}
	
public function verVazios($id1)
	{
	
	 $table=$this->getTable();
	 $consulta=$table->select()->
						
						where("id = ?", $id1);
		
	  $table=$table->fetchRow($consulta)->toArray();
	  $i=0;
	  $nomes=array();
	  foreach ($table as $k=>$y)
	  {
	  if( $y=="" || $y==null){
	  	prev($table);
	  	$nomes[]=key($table);
	  $i++;
	  }
	
	  }
	 $nomes['vazios']= $i;
	 return $nomes;
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
		$cript=$dados['senha'];
		$dados['senha']=$table->getAdapter()->quoteInto(SHA1($dados['senha']));
		$dados['senhaRedefinida']=$cript;
	 return $table->insert($dados);
	
	 
	}
public function incluiLdap(array $dados)
	{
		$perfis=$dados['perfis_concedidos'];
		$table=$this->getTable();
		$campos=$table->info(Zend_Db_Table_Abstract::COLS);
		
		foreach ($dados as $campo=> $value)
		{
			if(!in_array($campo, $campos))
				{ unset($dados[$campo]);
				}
			
			
			
			
			
		}
		$cript=$dados['senha'];
	
		$dados['senha']='';
		$dados['senhaRedefinida']='';
		$dados['senha_alterada']=1;
	 	$ret= $table->insert($dados);
		$p=new Model_PerfisUser();
		$p->perfil_sync($ret,explode(',',$perfis));
return $ret;
	
	 
	}
	
	public function incluiMult(array $dados1)
	{
		$escola = Zend_Auth::getInstance()->getIdentity()->getEscola();
		$modelo=new Model_Empresa();
		$modelo= $modelo->ver1($escola);
		$id1=$modelo['id'];
		
		foreach($dados1 as $w=>$dados ){
			$table=$this->getTable();
			$campos=$table->info(Zend_Db_Table_Abstract::COLS);
			foreach ($dados as $campo=> $value)
			{
				if(!in_array($value, $campos))
				{
					unset($dados[$value]);
				}
	
	
	
	
	
			}
			$cript=$dados['senha'];
			//$dados['senha']=new Zend_Db_Expr('SHA1('.$cript.')');
			$dados['senha']=$table->getAdapter()->quoteInto(SHA1($dados['senha']));
			$dados['escola']=$id1;
			$dados['senhaRedefinida']=$cript;
			$table->insert($dados);
		}
	
	}
	
	
	
	public function altera(array $dados, $id2)
	{
		
		$table=$this->getTable();
		$where = $table->getAdapter()->quoteInto('id = ?', $id2);
		$campos=$table->info(Zend_Db_Table_Abstract::COLS);
		
		
		$p=new Model_PerfisUser();
		$p->perfil_sync($id2,explode(',',$dados['perfis_concedidos']));
		foreach ($dados as $campo=> $value)
		{
			if(!in_array($campo, $campos))
			{
				unset($dados[$campo]);
			}
				
		
		}
		$linhasatualizadas= $table->update($dados, $where);
	 
		
	}
		public function alteraLDAP(array $dados, $id2)
	{
		
		$table=$this->getTable();
		$where = $table->getAdapter()->quoteInto('id = ?', $id2);
		$campos=$table->info(Zend_Db_Table_Abstract::COLS);
		
		
		$p=new Model_PerfisUser();
		$p->perfil_syncLDAP($id2,explode(',',$dados['perfis_concedidos']));
		foreach ($dados as $campo=> $value)
		{
			if(!in_array($campo, $campos))
			{
				unset($dados[$campo]);
			}
				
		
		}
		$linhasatualizadas= $table->update($dados, $where);
	 
		
	}
	
	public function alteraSenha(array $dados, $id2)
	{	
		$table=$this->getTable();
		$campos=$table->info(Zend_Db_Table_Abstract::COLS);
		$senhaAtual=$dados['pass'];
		foreach ($dados as $campo=> $value)
		{
			if(!in_array($campo, $campos))
			{
				unset($dados[$campo]);
			}
				
		
		}
		
		
		
		$where = $table->getAdapter()->quoteInto('id = ?', $id2);
		$cript=$dados['senha'];
		//senha em sha2
		$dados['senha']=$table->getAdapter()->quoteInto(SHA1($cript) );
		$dados['senhaRedefinida']=NULL;
		$linhasatualizadas= $table->update($dados, $where);
	
	
	}
	
	public function redefineSenha($dados,$id2)
	{
		$table=$this->getTable();
		$where = $table->getAdapter()->quoteInto('id = ?', $id2);
		$retorno=$dados;
		//senha em sha2
		$array['senha']=$table->getAdapter()->quoteInto(SHA1($dados) );
		$array['senha_alterada']=0;
		$array['senhaRedefinida']=$retorno;
		$linhasatualizadas= $table->update($array, $where);
		return $retorno;
	
	
	}
	public function redefineSenhaLogin($novaSenha,$login)
	{
		$table=$this->getTable();
		$where = $table->getAdapter()->quoteInto('login = ?', $login);
		//senha em sha2
		$array['senha']=$table->getAdapter()->quoteInto(SHA1($novaSenha) );
		$array['senha_alterada']=0;
		$array['senhaRedefinida']=$novaSenha;
		$linhasatualizadas= $table->update($array, $where);
		return $linhasatualizadas;
	
	
	}
	
	public function confirmaSenha($senha, $id2)
	{
	
		 	$table=$this->getTable();
	 		$consulta=$table->select('senha')->where("id = ?", $id2)
	 		->where("senha= ?",$table->getAdapter()->quoteInto(SHA1($senha) ))
	 		;


		$nr=$table->fetchRow($consulta);
		
	//return count($nr);
	return count($nr);
		

	
	}
	public function confirmaLogin($login )
	{
	
		$table=$this->getTable();
		$consulta=$table->select()->where("login = ?", $login)
		
		;
		
		$nr=$table->fetchRow($consulta);
	

		return count($nr);

	
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
	public function pertence($id,$escola )
	{
	
		$table=$this->getTable();
		$consulta=$table->select()
		->where("id = ?", $id)
		->where("escola = ?", $escola)
	
		;
	
		$nr=$table->fetchRow($consulta);
	

		return count($nr);
	
			
	}
public function infoLoginGetId($login)
	{
	
		$table=$this->getTable();
		$consulta=$table->select()->where("login = ?", $login)
		
		;
		
		$nr=$table->fetchRow($consulta);
	

		return $nr->id;
	

	
	}
	public function roleId($login)
	{
	
		$table=$this->getTable();
		$consulta=$table->select()->where("login = ? ", $login)
		
		;
		
		$nr=$table->fetchRow($consulta)->toArray();
	
		return isset($nr['perfil_id'])?($nr['perfil_id']):4;
	

	
	}
public function roles($id)
	{
	
		$perfis=new Model_PerfisUser();
		return $perfis->listRoleNameById($id);
		
		
		
			
		
	
	}
	
}
