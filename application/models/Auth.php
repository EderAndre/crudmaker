<?php
class Model_Auth
{
    public static function loginLdap($login, $senha)
	
    {
	$configs=Zend_Registry::get('_LDAP');
	$authAdapter = new Zend_Auth_Adapter_Ldap($configs,$login,$senha);
		$auth = Zend_Auth::getInstance();
		$result=$auth->authenticate($authAdapter);
$info=$authAdapter->getAccountObject(array('mail','displayname','sAMAccountName','memberOf'),array('dn'));
if(empty($info->mail)){$info->mail=date("YmdHms").'fake@defensoria.rs.def.br';}

if( $result->isValid() ) {
		$perfis= new Model_Perfil();
		$group_map_ldap=array('Consulta');
		foreach($info->memberof as $roles){
			$nome='ROLE_'.str_replace('-','_',strtoupper(substr($roles,3,strpos($roles,',')-3)));
		array_push($group_map_ldap,$nome);
		if($perfis->nomeExiste($nome) == 0){
			$perfis->inclui(array('nome'=>$nome,'pgInicial'=>'index4','group_ldap'=>$roles, 'origem'=>'LDAP','heranca'=>4));
		}
						
		}
	$cadastro=new Model_Cadastro();
if($cadastro->confirmaLogin($info->samaccountname )){
	$usuario = new Model_Usuario();
            $usuario->setFullName( $info->displayname );
            $usuario->setUserName( $info->samaccountname);
	    $usuario->setMail( $info->mail);
            $usuario->setRoleId($cadastro->roleId($info->samaccountname));
           $usuario->setEmpresa(1);
	   $usuario->setGroupMap( join(',',$group_map_ldap));
           $usuario->save();
            $usuario->setUserId($cadastro->infoLoginGetId($info->samaccountname));
}

else{
	$cadastro=new Model_Cadastro();
	$id001=$cadastro->incluiLdap(array('login'=>$info->samaccountname,'nome_completo'=>$info->displayname,'email'=>$info->mail,'perfil_id'=>4,'group_ldap_map'=>join(',',$group_map_ldap),'perfis_concedidos'=>join(',',$group_map_ldap)));
	$usuario = new Model_Usuario();
            $usuario->setFullName( $info->displayname );
            $usuario->setUserName( $info->samaccountname);
	    $usuario->setMail( $info->mail);
            $usuario->setRoleId(4);
           $usuario->setEmpresa(1);
	   $usuario->setGroupMap( join(',',$group_map_ldap));
            //$usuario->save();
            $usuario->setUserId($id001);
	    
}
 

            $storage = $auth->getStorage();
            $storage->write($usuario);
	    return true;

        }else{
      //  throw new Exception('Nome de usuário ou senha inválida');
return false;
	
}
}
    public static function login($login, $senha)
    {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        //Inicia o adaptador Zend_Auth para banco de dados
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        $authAdapter->setTableName('usuario')
                    ->setIdentityColumn('login')
                    ->setCredentialColumn('senha')
                    ->setCredentialTreatment('SHA1(?)');
        //Define os dados para processar o login
        $authAdapter->setIdentity($login)
                    ->setCredential($senha);
        //Faz inner join dos dados do perfil no SELECT do Auth_Adapter
        $select = $authAdapter->getDbSelect();
        $select->join( array('p' => 'perfil'), 'p.id = usuario.perfil_id', array('nome_perfil' => 'nome') );
        //Efetua o login
        $auth = Zend_Auth::getInstance();
		//$auth->setExpirationSeconds(300);
        $result = $auth->authenticate($authAdapter);
        //Verifica se o login foi efetuado com sucesso
        if ( $result->isValid() ) {
            //Recupera o objeto do usuário, sem a senha
            $info = $authAdapter->getResultRowObject(null, 'senha');
 
            $usuario = new Model_Usuario();
            $usuario->setUserId( $info->id );
            $usuario->setFullName( $info->nome_completo );
            $usuario->setUserName( $info->login );
            $usuario->setRoleId( $info->perfil_id );
            $usuario->setEmpresa( $info->empresa );
            $usuario->setSenhaAlterada( $info->senha_alterada );
 
            $storage = $auth->getStorage();
            $storage->write($usuario);
 
            return true;
        }
else{
       // throw new Exception('Nome de usuário ou senha inválida');
return false;
 	
}
    }
public function resetMail($username,$email)
	{
	$dados=new Model_UsuarioTab;
	$dados=$dados->ver1usuario($username);
$bootstrap = $this->getInvokeArg('bootstrap');
	$config=$bootstrap->getOptions()['resources']['mail']['transport'];

	$envio=new Aplicacao_Mail_Dispatcher();

	$result=0;
try{
	$novasenha=new Aplicacao_GeradorSenha_GeradorSenha();
$novasenha=$novasenha->_constructor($dados['login']);
$cadastro=new Model_Cadastro();
$cadastro->redefineSenhaLogin($novasenha,$dados['login']);
	$envio->_constructor(
				$config
				,utf8_decode('<p>Sua nova senha temporária é: '.$novasenha.'</p>')
				, array('mail'=>$dados['email'],'name'=>$dados['login'])
				,'Sua Senha foi Reiniciada'
				);
$result=$dados['login'].', e-mail enviado para '.$dados['email'];
}catch(Exception $e){$result='Não foi possível enviar o email';}
    
return $result;
		}

}
