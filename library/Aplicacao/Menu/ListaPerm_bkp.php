<?php
class Aplicacao_Menu_ListaPerm
{
    /**
     * @var Zend_Acl
     */
	protected $_navegador1;
	protected $_lista1;
	
 
    public function constructor($idConstrutor)
    {
    // $v=$this->_listaPermissoes1();
	// foreach($v as $va=>$valor){ echo "<br>"."Perfil : ".$valor['nome']." - Permissao -> Controller: ".$valor['funcionalidade']." - Acao : ".$valor['acao'];}
		//echo $idConstrutor;
     // return $this->_listaPermissoes1();
		$pai=$this->_listaPermissoes($idConstrutor);	 
		
		//$pages=array();
		$i=0;
		
			foreach ($pai as $valor0=>$c)
			{  
				
					$permissoes=$this->_listaPermissoes1($idConstrutor,$c['id_controle']);
		
					foreach ($permissoes as $valor=>$p)
					{	
						
						
						
						${"page$i"}[]=array(
						'label'  => $p['rotulo_acao'],
						'controller' => $p['funcionalidade'],
						'action' => $p['acao']	);
						
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
			->where('id = ?',$idPerfil)
			->where('exibirmenu = ?',1)
			->group('id_controle')
			->order('ordem_controles')
			 ;
		$this->_lista1 = $db->fetchAll($select);
		return $this->_lista1;
 
    }
	
	protected function _listaPermissoes1($idPerfil, $idFuncionalidade)
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
			->where('id = ?',$idPerfil)
			->where('id_controle = ?',$idFuncionalidade)
			->where('mostraMenu = ?',0)
			
			->order('id_controle')
			->order('ordem_acao')
			 ;
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
	//pega perfil do usu�rio....
	}
	
  
}
