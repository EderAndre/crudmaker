<?php
class Aplicacao_Menu_MenuUsuario
{
    /**
     * @var Zend_Acl
     */
    protected $_navegador;
	protected $_navegador1;
 
    public function __construct()
    {
    // $v=$this->_listaPermissoes1();
	// foreach($v as $va=>$valor){ echo "<br>".$valor['id_acao_rel']."-".$valor['nome'];}
	 
	$this->_navegador = array(
    array(
        'label'  => 'Home',
		'controller' => 'index',
        'action' => 'index'
    ),
    array(
        'label'  => 'Permissoes',
		'controller' => 'permissoes',
        'action' => 'index',
		'pages' => array(
            array(
        'label'  => 'Incluir',
		'controller' => 'permissoes',
        'action' => 'inclui')
		)
       
    ),
    array(
        'label'  => 'Usuarios',
		'controller' => 'usuarios',
        'action' => 'index'
    ),
	array(
        'label'  => 'Toma',
		'controller' => 'toma',
        'action' => 'index',
		'pages'=> array(
					array('label'  => 'New',
		'controller' => 'toma',
        'action' => 'new')
		
		)
    ),
	array(
        'label'  => 'Sair',
		'controller' => 'auth',
        'action' => 'logout'
    )
);
 

	
	
	return $this->_navegador;
       
    }
	
	public function __construct1($permissoes, $controles)
    {
    
	 
	$this->_navegador1 = array();
	foreach ($controles as $valor0=>$c)
	{ $this->_navegador1[]=array(
        'label'  => $c['descricao'],
		'controller' => $c['funcionalidade'],
        'action' => ''
			);
	
	foreach ($permissoes as $valor=>$p)
	{
	  $this->_navegador1[]=array(
        'label'  => $p['rotulo_acao'],
		'controller' => $p['funcionalidade'],
        'action' => $p['acao']
    );
	}
  
	}

	
	
	return $this->_navegador1;
       
    }
 
    protected function _init()
    {
        $this->_construct();
        
    }
	
  
}
