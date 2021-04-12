<?php
class Aplicacao_Menu_GetMenu
{
    /**
     * @var Zend_Acl
     */
	protected $_navegador1;
	protected $_lista1;
	
 
    public function constructor(array $idConstrutor)
    {

$i=0;
		if(in_array('1',$idConstrutor)):
		/*garantia de que o admin(id=1) sempre 
		tenha todo acesso a toda feature registrada no DB*/
		$pai=$this->_listaPermissoesSU();
		
		else:
		$pai=$this->_listaPermissoes($idConstrutor);
		endif;

			 
		
			foreach ($pai as $valor0=>$c)
			{  
					if(in_array('1',$idConstrutor)):
					/*garantia de que o admin(id=1) sempre 
					tenha todo acesso a toda ação registrada no DB*/
					$permissoes=$this->_listaAcoesSU($c['id_controle']);
		
					else:
					$permissoes=$this->_listaAcoes($idConstrutor,$c['id_controle']);
					endif;

					
		
					foreach ($permissoes as $valor=>$p)
					{	
						
						$inclusao=array(
						'label'  => $p['rotulo_acao'],
						'controller' => $p['funcionalidade'],
						'action' => $p['acao']	);
						
						${"page$i"}[]=$inclusao;
						
						
					}
				
				
				$this->_navegador1[]=array(
				'label'  => $c['descricao'],
				'controller' => $c['funcionalidade'],
				'action' => 'index',
				'pages'=> ${"page$i"});
				$i++;
				
				
		
	
		
	
	
	}

	return $this->_navegador1;
    }
 /*
    protected function _init()
    {
     //  $this->_construct();
	  // $p=$this->_construct1($k);
	  // return $p;
        
    }
*/
	public function _listaPermissoes($idPerfil)
    {
	
	
		$db=$this->Conecta();
		$select = $db->select()->distinct()
             ->from(array('f' => 'perfilfunc'),array(
                                'f.id_acao_rel'
                             ))
			 ->joinInner(array(
                            'p'=>'perfil'),
                            'f.id_perfil_rel= p.id'
                         )  
			->joinInner(array(
                            'a'=>'acoes'),
                            'f.id_acao_rel= a.id_acao',array(
                                'a.rotulo_acao','a.acao','a.id_controle'
                             )
                         )
			->joinInner(array(
                            'k'=>'permissoes'),
                            'a.id_controle= k.id_funcionalidade',array(
                                'k.funcionalidade','k.id_funcionalidade','k.descricao'
                             )
                         )
			->where('p.id IN( ? )',$idPerfil)
			->where('k.exibirmenu = ?',1)
			->group('a.id_controle')
			->order('ordem_controles')
			 ;
		$this->_lista1 = $db->fetchAll($select);
		return $this->_lista1;
 
    }
public function _listaPermissoesSU()
    {
	
	
		$db=$this->Conecta();
		$select = $db->select()->distinct()
             ->from(array('f' => 'perfilfunc'),array(
                                'f.id_acao_rel'
                             ))
			 ->joinInner(array(
                            'p'=>'perfil'),
                            'f.id_perfil_rel= p.id'
                         )  
			->joinInner(array(
                            'a'=>'acoes'),
                            'f.id_acao_rel= a.id_acao',array(
                                'a.rotulo_acao','a.acao','a.id_controle'
                             )
                         )
			->joinInner(array(
                            'k'=>'permissoes'),
                            'a.id_controle= k.id_funcionalidade',array(
                                'k.funcionalidade','k.id_funcionalidade','k.descricao'
                             )
                         )
			->where('k.exibirmenu = ?',1)
			->group('a.id_controle')
			->order('ordem_controles')
			 ;
		$this->_lista1 = $db->fetchAll($select);
		return $this->_lista1;
 
    }
	
	protected function _listaAcoes(array $idPerfil, $idFuncionalidade)
    {
	
	
		$db=$this->Conecta();
		$select = $db->select()->distinct()
             ->from(array('f' => 'perfilfunc'),array(
                                'f.id_acao_rel'
                             ))
			 ->joinInner(array(
                            'p'=>'perfil'),
                            'f.id_perfil_rel= p.id'
                         )  
			->joinInner(array(
                            'a'=>'acoes'),
                            'f.id_acao_rel= a.id_acao',array(
                                'a.rotulo_acao','a.acao','a.id_controle','a.mostraMenu'
                             )
                         )
			->joinInner(array(
                            'k'=>'permissoes'),
                            'a.id_controle= k.id_funcionalidade',array(
                                'k.funcionalidade','k.id_funcionalidade','k.descricao'
                             )
                         )
			->where('p.id IN ( ? )', $idPerfil)
			->where('k.exibirmenu = ?',1)
			->where('a.mostraMenu = ?',0)
			->where('a.id_controle = ?', $idFuncionalidade)
			->group('a.id_acao')
			->order('ordem_acao')
			 ;
		$result= $db->fetchAll($select);
		return $result;
 
    }
	protected function _listaAcoesSU( $idFuncionalidade)
    {
	
	
		$db=$this->Conecta();
		$select = $db->select()->distinct()
             ->from(array('f' => 'perfilfunc'),array(
                                'f.id_acao_rel'
                             ))
			 ->joinInner(array(
                            'p'=>'perfil'),
                            'f.id_perfil_rel= p.id'
                         )  
			->joinInner(array(
                            'a'=>'acoes'),
                            'f.id_acao_rel= a.id_acao',array(
                                'a.rotulo_acao','a.acao','a.id_controle','a.mostraMenu'
                             )
                         )
			->joinInner(array(
                            'k'=>'permissoes'),
                            'a.id_controle= k.id_funcionalidade',array(
                                'k.funcionalidade','k.id_funcionalidade','k.descricao'
                             )
                         )
			->where('a.id_controle = ?', $idFuncionalidade)
			->where('k.exibirmenu = ?',1)
			->where('a.mostraMenu = ?',0)
			->group('a.id_acao')
			->order('ordem_acao')
			 ;
		$result= $db->fetchAll($select);
		return $result;
 
    }
	
	
	protected function Conecta()
	{
	require_once 'Zend/Config.php';
	require_once 'Zend/Db.php';

	$config = new Zend_Config_Ini ('../application/configs/application.ini','production');
	$db = Zend_Db::factory($config->resources->db);
	return $db;
	//pega perfil do usu�rio....
	}
	
  
}
