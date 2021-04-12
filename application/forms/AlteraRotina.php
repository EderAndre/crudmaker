<?php
 
class Form_AlteraRotina extends Zend_Form
{
    public function init()
    {
	//id_acao	id_controle	acao	rotulo_acao	ordem_acao	mostraMenu
        $this->setName('AlteraRotina');
 
        
        $id = new Zend_Form_Element_Text('idrotinas');
        $id->setLabel('Código:')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->setAttrib('readonly', 'true')
        ->addValidator('NotEmpty');
        
        $nome = new Zend_Form_Element_Text('nomerotina');
        $nome->setLabel('Nome:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
		
		$desc = new Zend_Form_Element_Text('descricaorotina');
        $desc->setLabel('Descrição:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
		
        $dias = new Zend_Form_Element_Text('dias_ciclo');
        $dias->setLabel('Dias do ciclo:')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty');
     
     //   $i=Zend_Auth::getInstance()->getIdentity()->getUserName();
       
       
        
		$autor = new Zend_Form_Element_Text('criado_por');
        $autor->setLabel('Autor:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->setAttrib('readonly', 'true')
              ->setValue()
              ->addValidator('NotEmpty');
			  
		
			
       // $data = Zend_Date::now()->toString('yyyy-MM-dd HH:mm:ss');
        
        $inclusao = new Zend_Form_Element_Text('created');
        $inclusao->setLabel('Data de inclusão:')
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->setAttrib('readonly', 'true')
        ->setValue();
 
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Enviar')
               ->setAttrib('id', 'submitbutton');
 
        $this->addElements(array($id,$nome, $desc, $dias, $autor, $inclusao, $submit));
    }
}