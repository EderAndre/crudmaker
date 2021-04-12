<?php

class AuthController extends Zend_Controller_Action
{
	protected $_model;
 
    public function init()
    {
    }
	
 
    public function indexAction()
    {
      //  return $this->_helper->redirector('index.php/login');
    	$this->_redirect('/auth/login');
    }
 
    public function loginAction()
    {		
	
    	echo $this->view->headScript()
    	 
    	->appendFile( $this->view->baseUrl('script/jquery.maskedinput-1.3.js' ))
    	->appendFile( $this->view->baseUrl('script/mascaras.js' ));
    	
    	$this->_helper->layout->setLayout('login');
		$this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->view->messages = $this->_flashMessenger->getMessages();
        $form = new Form_Login();
        $form2 = new Form_Reset();
if($this->_request->getParam('reset')!=1 ){
        $this->view->form = $form;
        //Verifica se existem dados de POST
        if ( $this->getRequest()->isPost() ) {
            $data = $this->getRequest()->getPost();
            //Formulário corretamente preenchido?
            if ( $form->isValid($data) ) {
                $login = $form->getValue('login');
                $senha = $form->getValue('senha');
 
                try {
				
        
			$ldap=Model_Auth::loginLdap($login, $senha);
			if($ldap!== true){$database=Model_Auth::login($login, $senha);}
			if($ldap!== true && $database!== true){throw new Exception('Nome de usuário ou senha inválida');}


			
                    
					//Redireciona para o Controller adequado
			$usuario = Zend_Auth::getInstance()->getIdentity();
    	     		$perfil=$usuario->getRoleID();
			$perfil=new Model_Cadastro();
			$perfil=$perfil->roleId($login);
					 $this->_model=new Model_Perfil();
					$c=$this->_model->_pagina($perfil);
					
					
					foreach($c as $valor1){ 
					$pg=$valor1['pgInicial'];
				
					
					 $this->_helper->redirector->goToRoute( array('controller' => 'index','action' => $pg), null, true);
					/* a linha acima é utilizada em caso do mod_rewrite e .htaccess estar ativado.
					 * caso contrário utilize a linha baixo
					*/
					#$base=  $this->view->baseUrl('');
				
					#$this->_redirect();
					}
		 
					
					
					
                } catch (Exception $e) {
                    //Dados invalidos
                    $this->_helper->FlashMessenger($e->getMessage());
                $this->_helper->redirector->goToRoute( array('controller' => 'auth','action' => 'login'), null, true);
                }
            } else {
                //Formulario preenchido de forma incorreta
                $form->populate($data);
            }
        }
}else{
	$this->_helper->viewRenderer('reset');
	$this->view->form = $form2;
        if ( $this->getRequest()->isPost() ) {
            $data = $this->getRequest()->getPost();
            
            if ( $form2->isValid($data) ) {
                $login = $form2->getValue('username');
                $email = $form2->getValue('mail');
 
                try {
				
                   $result= Model_Auth::resetMail($login,$email);
		$this->_helper->FlashMessenger($result);
                 $base=  $this->view->baseUrl('');
				
					$this->_redirect('');
					  
 
					
					
					
                } catch (Exception $e) {
                 
                    $this->_helper->FlashMessenger($e->getMessage());
                $base=  $this->view->baseUrl('');
				
					$this->_redirect();
                }
            } else {
              
                $form2->populate($data);
            }
        }


}
    }
 
    public function logoutAction()
    {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        
       return $this->_helper->redirector('index');
      
/* a linha acima é utilizada em caso do mod_rewrite e .htaccess estar ativado.
 * caso contrário utilize a linha baixo
 */
      #  return $this->_redirect('../');
    }
       
    
   
	
}
