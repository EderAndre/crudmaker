<?php
class Aplicacao_Acl_Setup
{
    /**
     * @var Zend_Acl
     */
    protected $_acl;
	protected $_idPerfil;
protected $_contador=0;
 
    public function constructor(array $idConstrutor)
    {	
			
	$this->_acl = new Zend_Acl();
return        $this->_initialize($idConstrutor);

		
    }
	
    protected function _initialize(array $idInicio)
    {
        $this->_setupRoles();
        $this->_setupResources();
$ret=array();
foreach($idInicio as $k):
       $ret[]= $this->_setupPrivileges($k);
endforeach;
        $this->_saveAcl();
	
	return $ret;	
		
    }
	
	
    protected function _setupRoles()
    {	$perfis=$this->_listaPerfis();
		
		$contador1=0;
		$valorAnt=0;
		foreach( $perfis as $rec=>$valor)
		{
		if ($contador1==0){
		 
		$this->_acl->addRole( new Zend_Acl_Role($valor['id']) );
	
		} else
		{
		$this->_acl->addRole( new Zend_Acl_Role($valor['id'])
		//,$valorAnt 
		);
	
		}
		
		$valorAnt=($valor['id']);
		$contador1++;
		 }
	
	
    }
 
    protected function _setupResources()
	
    {
	
		$recursos=$this->_listaRecursos();
		

		foreach( $recursos as $rec=>$valor)
		{
		
	
		 $this->_acl->addResource( new Zend_Acl_Resource($valor['funcionalidade']) );
		 }
		
    }
 
    protected function _setupPrivileges($idPrivilegio)
	
    {  
		//if($idPrivilegio==1):
		/*garantia de que o admin(id=1) sempre 
		tenha determinados acesso, sem necessidade do DB*/
		//$this->_allowAdmin();
		//else:
		//endif;
$retorno=array();
	
		
		$privilegios=$this->_listaRecursos1($idPrivilegio);
		$i=0;
		foreach( $privilegios as $prv=>$valor)
		{
			
				$array=$this->_listaPermissoes1($idPrivilegio, $valor['id_controle']);
				foreach ($array as $vlr=>$p)
				{	
				
				${"array$i"}[]=$p['acao'];
			
				}
		 $retorno[]= array($idPrivilegio, $valor['funcionalidade'], ${"array$i"} );
			$this->_acl->allow( $idPrivilegio, $valor['funcionalidade'], ${"array$i"} );
		 
				
		 
			$i++;
			
		}
	
	return $retorno	;			
    }
	
	
 
    protected function _saveAcl()
    {
        $registry = Zend_Registry::getInstance();
        $registry->set('acl', $this->_acl);
    }
	
	protected function _listaPrivilegios()
    {	
		$db=$this->Conecta();
		

		
		$select = $db->select()
             ->from('perfilfunc')
             ->joinInner(permissoes, 'perfilfunc.id_func_rel=permissoes.id_funcionalidade', array('perfilfunc.*','permissoes.*'))
			 ->order('id_perfil_rel DESC');
		$result = $db->fetchAll($select);
	
		return $result;
		
	
    }
	
	protected function _listaRecursos()
    {
		$db=$this->Conecta();
		$select = $db->select()
             ->from('permissoes');
			 
			 
		$result = $db->fetchAll($select);
		return $result;
    }
	
		protected function _listaRecursos1($idRecursos)
    {
		$db=$this->Conecta();
		$select = $db->select()
             ->from(array('f' => 'perfilfunc'))
			 ->joinInner(array(
                            'p'=>'perfil'),
                            'f.id_perfil_rel= p.id',array(
                                'p.*','f.*'
                             )
                         )  
			->joinInner(array(
                            'a'=>'acoes'),
                            'f.id_acao_rel= a.id_acao',array(
                                'a.*','f.*'
                             )
                         )
			->joinInner(array(
                            'k'=>'permissoes'),
                            'a.id_controle= k.id_funcionalidade',array(
                                'a.*','k.*'
                             )
                         )
			->where('id = ?',$idRecursos)
			->group('id_controle')
			->order('id_controle')
			 ;
			 
			 
		$result = $db->fetchAll($select);
		return $result;
    }
	
	protected function _listaPermissoes1($idPermissoes, $idFuncionalidade)
    {
	
	
		$db=$this->Conecta();
		$select = $db->select()
             ->from(array('f' => 'perfilfunc'))
			 ->joinInner(array(
                            'p'=>'perfil'),
                            'f.id_perfil_rel= p.id',array(
                                'p.*','f.*'
                             )
                         )  
			->joinInner(array(
                            'a'=>'acoes'),
                            'f.id_acao_rel= a.id_acao',array(
                                'a.*','f.*'
                             )
                         )
			->joinInner(array(
                            'k'=>'permissoes'),
                            'a.id_controle= k.id_funcionalidade',array(
                                'a.*','k.*'
                             )
                         )
			->where('id = ?',$idPermissoes)
			->where('id_controle = ?',$idFuncionalidade)
			->order('id_controle')
			->order('ordem_acao')
			 ;
		$result = $db->fetchAll($select);
		return $result;
 
    }
	
	protected function _listaPerfis()
    {
	
	
		$db=$this->Conecta();
		$select = $db->select()
             ->from('perfil')
			 ->order("id DESC");
		$result = $db->fetchAll($select);
		return $result;
 
    }
	
	protected function Conecta()
	{
	require_once 'Zend/Config.php';
	require_once 'Zend/Db.php';

	$config = new Zend_Config_Ini ('../application/configs/application.ini','production');
	$db = Zend_Db::factory($config->resources->db);
	return $db;

	}
	protected function _allowAdmin()
    {
	
		 return $this->_acl->allow( '1', 'auth', array('index', 'login','logout'))
			->allow( '1', 'error', array('error', 'forbidden'))
			->allow( '1', 'index', array('index', 'index1'))
			->allow( '1', 'perfis', array('index', 'inclui', 'altera','excluiarray'))
 			->allow( '1', 'permissoes', array('index', 'inclui', 'altera','excluiarray'))
 			->allow( '1', 'acoes', array('index', 'inclui', 'altera','excluiarray'))
 			->allow( '1', 'cadastro', array('index', 'inclui','existe','teste','processa','cadmult', 'altera','alt','altera','excluiarray','alterasenha','redefinir','admin'))
			->allow( '1', 'empresa', array('index','dados'))
			->allow( '1', 'configs', array('index','altera','backup','delbackup'))
			->allow( '1', 'configs', array('mail','index'))
			;
	
 
    }
}
