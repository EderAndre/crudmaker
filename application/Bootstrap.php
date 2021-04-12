<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{	
	
   
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
		//conecta
		//$dbAdapter=Zend_Db::factory($application->db);
    }
    protected function _initAutoload()
    {
    	$autoloader = new Zend_Application_Module_Autoloader(array(
    			'basePath' => APPLICATION_PATH,
    			'namespace' => ''
    	));
		
 
    	return $autoloader;
		
    }
  
	protected function _initAcl()
    {
		if(!Zend_Auth::getInstance()->hasIdentity())//existe a identidade?
			{
			$roles=array(0);
			} 
			else{
				$usuario = Zend_Auth::getInstance()->getIdentity();
				$perfis=new Model_PerfisUser();
				$roles=$perfis->listRolesFromLogin($usuario->_userName);
				}
    		$aclSetup = new Aplicacao_Acl_Setup();
		$aclSetup->constructor($roles);
		
		
    }

    
	protected function _initNavigation(){
        
        $this->bootstrap("layout");
        $layout = $this->getResource("layout");
        $view= $layout->getView();
	
		//pegar perfil
		if(!Zend_Auth::getInstance()->hasIdentity())//existe a identidade?
			{
			$roles=array(0);
			} 
			else{
				$usuario = Zend_Auth::getInstance()->getIdentity();
				$perfis=new Model_PerfisUser();
				$roles=$perfis->listRolesFromLogin($usuario->_userName);
				}
					
		//------------------------
	
				
$menuUsuario2 = new Aplicacao_Menu_GetMenu();
$menuUsuario2 = $menuUsuario2->constructor($roles);
		
        $navigation = new Zend_Navigation($menuUsuario2);
       // $view->navigation($navigation);
		$view->navigation($navigation);
		

     } 
	 protected function _initPaginador(){
        
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('pagination.phtml');
		

     } 
	 
	public function _initTranslate() {    
        $translator = new Zend_Translate ( array ('adapter' => 'array', 'content' => '../library/translate', 'locale' => 'pt_BR', 'scan' => Zend_Translate::LOCALE_DIRECTORY ) );
        Zend_Validate_Abstract::setDefaultTranslator ( $translator );
    }
	
	public function _initTime() {  
	
	/****** Inicia a sess�o ******/

//$session->setExpirationSeconds ( 30 );
		
    }
	public function _initVersao()
{
    	$versao = $this->getOption('aplicativo');
    	Zend_Registry::set('_version', $versao['versao']);
	Zend_Registry::set('_appname', $versao['nome']);
	Zend_Registry::set('_LDAP', $this->getOption('ldap'));
}
}

