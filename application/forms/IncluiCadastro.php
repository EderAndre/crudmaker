<?php
//	senha	Rua	numero	bairro	cidade	estado	cep	created	senha_alterada 
class Form_IncluiCadastro extends Zend_Form
{
    public function init()
    {
        $this->setName('IncluiCadastro');
 
        $login = new Zend_Form_Element_Text('login');
        $login->setLabel('Login:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
 
        $nome_completo = new Zend_Form_Element_Text('nome_completo');
        $nome_completo->setLabel('Nome Completo:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('E-mail:')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty')
        ->addValidator('EmailAddress');
        
     /**
      * 
      *   
        $perfil_id = new Zend_Form_Element_Text('perfil_id');
        $perfil_id->setLabel('Perfil Concedido:')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty');
       * */ 
        $perfil_id = new Zend_Form_Element_Select('perfil_id');
        $perfil_id->setLabel('Perfil Concedido:')
        ->setRequired(true)
        ->addValidator('NotEmpty');
        
        /*
        $sn[]=array('num'=> '3', 'valor'=>'Diretor' );
        $sn[]=array('num'=> '4', 'valor'=>'Secretário');
        $sn[]=array('num'=> '5', 'valor'=>'Professor');
        $sn[]=array('num'=> '6', 'valor'=>'Aluno');
        */
        //$table = array( array("id_controle"=> '1') , array("descricao"=>"esterco"));
        $sn=$this->_menuPerfil();
        foreach ($sn as $v=>$d) {
        	$perfil_id->addMultiOption($d['id'], $d['nome']);
        }
        
        
        $agencia = new Zend_Form_Element_Hidden('empresa');
        $agencia
        ->setRequired(true)
        ->addValidator('NotEmpty')
        ->setValue(1)
        
        ;
        
        
        $pass=new Aplicacao_GeradorSenha_GeradorSenha();
        $pass=$pass->_constructor('eder');
        
        $senha = new Zend_Form_Element_Text('senha');
        $senha->setLabel('senha:')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty')
        ->setValue($pass)
        ;
       /* 
        $senhaRedef =  new Zend_Form_Element_Hidden('senhaRedefinida');
        $senhaRedef
        // ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->setValue('coco')
        ;
 		*/
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Enviar')
               ->setAttrib('id', 'submitbutton');
 
        $this->addElements(array( $login, $nome_completo, $email, $perfil_id, $senha, $submit,$agencia));
    }
    
    public function _menuEmpresa()
    {
    	$escola = Zend_Auth::getInstance()->getIdentity()->getEscola();
    	if($escola==1){
    		$modelo=new Model_Empresa();
    		$modelo=$modelo->lista();
    		return $modelo;
    	} 
    	else{
    	$modelo=new Model_Empresa();
    	$modelo=$modelo->ver1($escola);
    	return $modelo;
    	}
    }
    public function _menuPerfil()
    {
    	$perfil = Zend_Auth::getInstance()->getIdentity()->getRoleId();
    	$modelo=new Model_Perfil();
    	$modelo=$modelo->verMaior($perfil);
    	return $modelo;
    }
}