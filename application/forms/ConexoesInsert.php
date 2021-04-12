<?php

class Form_ConexoesInsert extends Zend_Form
{
    public function init()
    {
        $this->setName('ConexoesInsert');


	$field00=new Zend_Form_Element_Hidden('id');


 	$field01=new Zend_Form_Element_Text('nome');
        $field01->setLabel('Nome:') 
	->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty')     
     	;

	$field02=new Zend_Form_Element_Text('host');
        $field02->setLabel('Host do banco:') 
	->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty')     
     	;

	$field03=new Zend_Form_Element_Text('username');
        $field03->setLabel('Username:') 
	->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty')     
     	;
	
	$field04=new Zend_Form_Element_Password('password');
        $field04->setLabel('Senha:') 
        ->addFilter('StripTags')
        ->addFilter('StringTrim')    
     	;
	
	$field05=new Zend_Form_Element_Text('dbname');
        $field05->setLabel('Nome do banco:') 
	->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty')     
     	;

	$field06 = new Zend_Form_Element_Select('pdoType');
        $field06->setLabel('Tipo do PDO:')
	;
      	$field06
	->addMultiOption('', 'Nenhum-Detecção Auto')
	->addMultiOption('dblib', 'Genérico DBLIB(Suporta MSSQL)')
	->addMultiOption('pgsql', 'PostGre PDO')
	->addMultiOption('mysql', 'Mysql PDO')
	;
	
	$field07 = new Zend_Form_Element_Select('factory');
        $field07->setLabel('Espécie de banco:')
        ->setRequired(true)
        ->addValidator('NotEmpty')
	;
      	$field07
	->addMultiOption('Pdo_Mysql', 'Mysql')
	->addMultiOption('Pdo_Mssql', 'SQL Server')
	->addMultiOption('Pdo_Pgsql', 'PostgreSQL')
	;
	
	$field08 = new Zend_Form_Element_Select('charset');
        $field08->setLabel('Encode:');
      	$field08
	->addMultiOption('UTF8', 'UTF8')
	->addMultiOption('', 'AUTO')
	;
	         
       
       
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Enviar')
               ->setAttrib('id', 'submitbutton');
 
        $this->addElements(array($field00
				,$field01
				,$field02			
				,$field03
				,$field04
				,$field05
				,$field06
				,$field07
				,$field08
				,$submit
				));
    }
    
   
    
}
