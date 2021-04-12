<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
       /*
        * redirecionamento para index.php
        * apenas em caso de não ativarem o 
        * mod-rewrite ou 
        * a utilização do .htaccess
        */ 
    	#$uri    = $this->getRequest()->getServer('REQUEST_URI');
    	#$script = $this->getRequest()->getServer('SCRIPT_NAME');
    	#if (strpos($uri, $script) === false) {
    	#	$this->_redirect('');
    	#}
    	
    	/*
    	 * remover as linhas acima em caso de correção da 
    	 * configuração do servidor
    	 */
    	// action body
        $perfil = Zend_Auth::getInstance()->getIdentity()->getRoleId();
        
        $pagina=new Model_Perfil();
        $pagina=$pagina->ver1($perfil);
        $pagina=$pagina['pgInicial'];

        return $this->_helper->redirector($pagina);
  
    	
    }
public function index1Action()
    {
    
    	
  // $configs=Zend_Registry::get('_LDAP');
	//$k=new Model_Teste();

	
//print_r($k->getOne(1));


/*

    	$authAdapter = new Zend_Auth_Adapter_Ldap(array(
    'server1' => array(
'host' => '10.244.168.3',
        'accountDomainName' => 'defpub.local',
'accountDomainNameShort' => 'defpub',
        'accountCanonicalForm' => 3,
        'baseDn' => 'DC=defpub,DC=local',

    )
),'4245121@defpub.local','qwer78');
$authAdapter->authenticate();
echo json_encode( $authAdapter->getAccountObject(array('mail','displayname','sAMAccountName'),array('dn')));
*/
/*
//$auth = Zend_Auth::getInstance();

// Do the login
//$rs = $auth->authenticate($authAdapter);
//print_r($rs) ;
}
catch(Exception $e){ print_r($e);}
*/

 	 $this->view->assign('content','Index 1');
    }
public function index2Action()
    {
       
    }
public function index3Action()
    {
      
    
    	
    }
    public function index4Action()
    {
    	
    	


//print_r($o->constructor(array(4,1)));
//exit;

 //$auth = Zend_Auth::getInstance();
	 
        //   print_r($auth->getIdentity()->_userName);


       
        }
public function index5Action()
    {
        // action body
     echo "Página Inicial 5";
    	
    
    	
    }
public function index6Action()
    {
        // action body
     echo "Página Inicial 6";
    	
    
    	
    }
    
public function calendarioAction()
    {
    	// action body
    	$this->_helper->layout->disableLayout();
    	$data= $_POST['data'];
    	$data_ex=explode('=', $data);
    	
    	$cal=new Aplicacao_Calendario_Calendario();
		$cal->_constructor($data_ex[1]);
    	 
    
    	 
    }
public function agendaAction()
    {
    	// action body
    	
    	
    
    
    }
   
   
function searchForId($id, $array) {
    	foreach ($array as $key => $val) {
    		if ($val['idcliente'] === $id) {
    			return true;
    		}
    	}
    	return false;
    }

}

