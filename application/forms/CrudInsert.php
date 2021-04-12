<?php

class Form_CrudInsert extends Zend_Form
{
    public function init()
    {
        $this->setName('CrudInsert');


	$field00=new Zend_Form_Element_Hidden('id');



 	$field02=new Zend_Form_Element_Text('name');
        $field02->setLabel('Nome:') 
	->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addFilter('StringToLower')
        ->addValidator('NotEmpty')     
     	;
	$field06=new Zend_Form_Element_Text('table_name');
        $field06->setLabel('Tabela:') 
	->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty')     
     	;

	$field03=new Zend_Form_Element_Text('descriptor');
        $field03->setAttrib('class', 'invisible') 
     	;
	$field04=new Zend_Form_Element_Select('role_default');
        $field04->setLabel('Acesso Padrão:')     
     	;
	$roles=new Model_Perfil();
	$listR=$roles->lista();
  	foreach ($listR as $l=>$k) {
        	$field04->addMultiOption($k['id'], $k['nome']);
        }

	$field05=new Zend_Form_Element_Select('connection');
	$conns=new Model_Conexoes();
	$listC=$conns->listAll();
  	foreach ($listC as $v=>$d) {
        	$field05->addMultiOption($d['id'], $d['nome']);
        }
	$field01=new Zend_Form_Element_Hidden('primary_key');
 	$field01->setAttrib('class', 'invisible') ;

	         
    
       $captch = new Zend_Form_Element_Captcha('captcha',array('label'=>'Digite o que ve','captcha'=>array('captcha'=>'Image','wordLen'=>8,'timeout'=>900,'width'=>300,'height'=>180,'imgDir'=>'captcha/','imgUrl'=>'/skeleton_zf1/public/captcha/','font'=>'font/Dustismo_Roman.ttf','fontSize'=>25,'dotNoiseLevel'=>3,'lineNoiseLevel'=>3)));
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Enviar')
               ->setAttrib('id', 'submitbutton');
 
        $this->addElements(array($field00
				,$field02
				,$field06
				,$field03
				,$field04

				,$field05
				,$field01
				//,$captch			
				//,$submit
				));
    }
    
   
    
}
