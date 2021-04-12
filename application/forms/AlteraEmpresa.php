<?php

class Form_AlteraEmpresa extends Zend_Form
{

	protected $_img;
	public function init()
    {
        $this->setName('AlteraEmpresa');
		

        $id = new Zend_Form_Element_Hidden('id');
        $id->setLabel('')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty');
        
        
        $nome = new Zend_Form_Element_Text('nome');
        $nome->setLabel('Nome:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
			  ->setAttrib('size',60);
			  
		 $cnpj = new Zend_Form_Element_Text('cnpj');
        $cnpj->setLabel('CNPJ:')
              ->setRequired(false)
              ->addFilter('StripTags')
              ->addFilter('StringTrim');
	
 
       
        
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
		//validação da data
        $valData=new Zend_Validate_Date('yyyy/mm/dd');
		$valData->setMessages(array(
		Zend_Validate_Date::INVALID_DATE=>'A data \'%value\' não é válida',
		Zend_Validate_Date::FALSEFORMAT=>'O formato de data \'%value\' não é válido'));
		//fim da validação
		
        $fund = new Zend_Form_Element_Text('fundacao');
        $fund->setLabel('Data de fundação:')
        ->setRequired(true)
		->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty')
        ->addValidator( $valData)
        ;
        
               
    
    $inc = new Zend_Form_Element_Text('inclusao_sistema');
    $inc->setLabel('Data de Inclusão:')
    ->setRequired(true)
    ->addFilter('StripTags')
    ->addFilter('StringTrim')
    ->setAttrib('readonly', 'true')
    
    ;
    
    
    $img = new Zend_Form_Element_File('imagem_inicio');
    $img->setLabel('Alterar Imagem:')
    //->addValidator('Extension', false, array('jpg', 'png', 'gif'))
    //->addValidator('Size', false, 512000)
  //  ->setDestination('src/logo/')
    ;
    
    
    
    
    $oldname = pathinfo($img->getFileName());
    if($oldname){
    $newname = SHA1(date("Ymdhms")) . '.' . $oldname['extension'];
    $img->addFilter('Rename', $newname);
    $this->_img=$newname;
    } else {$this->_img=NULL;}
        //	senha	Rua	numero	bairro	cidade	estado	cep	created	senha_alterada
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Enviar')
               ->setAttrib('id', 'submitbutton');
 
        $this->addElements(array($nome, $cnpj, $email, $rua , $numero, $bairro, $cidade, 
        						$estado, $cep, $fund, $inc, $img, $submit,$id));
    }
    
    public function getImg()
    {
    	return $this->_img;
    }
}
