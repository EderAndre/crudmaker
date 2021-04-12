<?php

class Form_AlteraCadastro extends Zend_Form
{
    public function init()
    {
        $this->setName('AlteraCadastro');

        $id = new Zend_Form_Element_Text('id');
        $id->setLabel('Código:')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty')
        ->setAttrib('readonly', true)
        ;
        
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
              
        $nasc = new Zend_Form_Element_Text('data_nascimento');
        $nasc->setLabel('Data de nascimento:')

        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator( 'date')
        ;
        
         $nome_pai = new Zend_Form_Element_Text('nome_pai');
        $nome_pai->setLabel('Nome do pai:')
             // ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
             // ->addValidator('NotEmpty')
              ;
              
         $nome_mae = new Zend_Form_Element_Text('nome_mae');
        $nome_mae->setLabel('Nome da mãe:')
             // ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
             // ->addValidator('NotEmpty')
              ;
              
              
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('E-mail:')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty')
        ->addValidator('EmailAddress');
        
         $fone= new Zend_Form_Element_Text('telefone');
        $fone->setLabel('Telefone:')
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
     //   ->addValidator('NotEmpty')
      //  ->addValidator('numeric')
      ;
              $celular= new Zend_Form_Element_Text('telefone_movel');
        $celular->setLabel('Celular:')
   
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
     
      ;
        
   

    $all_groups = new Zend_Form_Element_Hidden('perfis');
        $all_groups->setValue($this->_menuPerfil()); 


	 $_groups = new Zend_Form_Element_Text('perfis_concedidos');
        $_groups->setLabel('Seus Perfis:')
        ->setRequired(true)
        ->addValidator('NotEmpty'); 


        $perfil_id = new Zend_Form_Element_Select('perfil_id');
        $perfil_id->setLabel('Perfil Preferencial(pg Inicio):')
        ->setRequired(true)
        ->addValidator('NotEmpty');

 	

        
    	$sn=$this->_menuPerfilPref();
        foreach ($sn as $v=>$d) {
        	$perfil_id->addMultiOption($d['id'], $d['nome']);
        }
        
        
       
       
        
        $rua = new Zend_Form_Element_Text('rua');
        $rua->setLabel('Rua:')
        //->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ;
        
        $numero = new Zend_Form_Element_Text('numero');
        $numero->setLabel('Número:')
        //->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ;
        
        $bairro = new Zend_Form_Element_Text('bairro');
        $bairro->setLabel('Bairro:')
        //->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ;
        
        $cidade = new Zend_Form_Element_Text('cidade');
        $cidade->setLabel('Cidade:')
       // ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ;
        
    	$estado = new Zend_Form_Element_Select('estado');
        $estado->setLabel('Estado:')
       // ->setRequired(true)
        ;
        
        $es[]=array('num'=> '', 'valor'=>'' );
        $es[]=array('num'=> 'RS', 'valor'=>'RS' );
        $es[]=array('num'=> 'SC', 'valor'=>'SC');
        $es[]=array('num'=> 'PA', 'valor'=>'PA');
        $es[]=array('num'=> 'SP', 'valor'=>'SP');
        //$table = array( array("id_controle"=> '1') , array("descricao"=>"esterco"));
        foreach ($es as $valor=>$c) {
        	$estado->addMultiOption($c['num'], $c['valor']);
        }
        
        $cep = new Zend_Form_Element_Text('cep');
        $cep->setLabel('CEP:')
       // ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ;
        //	senha	Rua	numero	bairro	cidade	estado	cep	created	senha_alterada
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Enviar')
               ->setAttrib('id', 'submitbutton');
 
        $perfil = Zend_Auth::getInstance()->getIdentity()->getRoleId();
        if($perfil<=2):
        $this->addElements(array( $id, $login, $nome_completo,$nasc,$nome_pai, $nome_mae, $email, 
        						$fone, $celular, $rua , $numero, $bairro, $cidade, 
        						$estado, $cep,$perfil_id , $_groups,$all_groups , $submit));
        else:
        $this->addElements(array( $id, $login, $nome_completo,$nasc,$nome_pai, $nome_mae, $email,
        		$fone, $celular,
        		 $rua , $numero, $bairro, $cidade,
        		$estado, $cep ,  $submit));
        endif;
    }

    public function _menuPerfil()
    {
    	$modelo=new Model_Perfil();
        $modelo=$modelo->verOrigem('APP');
	$res=array();
	foreach ($modelo as $v=>$d) {
        	$res[]= $d['nome'];
       }
	$modelo= implode(',',$res);
    	return $modelo;
    }
public function _menuPerfilPref()
    {
    	$modelo=new Model_Perfil();

        $modelo=array_merge($modelo->verOrigem('APP'),$modelo->verOrigem('LDAP'));
    	return $modelo;
    }


}
