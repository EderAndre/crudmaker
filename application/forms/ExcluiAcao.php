<?php
 
class Form_ExcluiAcao extends Zend_Form
{
    public function init()
    {
	//id_acao	id_controle	acao	rotulo_acao	ordem_acao	mostraMenu
        $this->setName('ExcluiAcao');
		$id = new Zend_Form_Element_Text('id_acao');
        $id->setLabel('Id:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
			  ->setAttrib('readonly', true)
			  ;
		
       
		$rotulo = new Zend_Form_Element_Text('rotulo_acao');
        $rotulo->setLabel('Rotulo(menu):')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
		
		
			  
		$created = new Zend_Form_Element_Text('created');
        $created->setLabel('Criado em:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
			  ->setAttrib('readonly', true)
			  ;
			  
		
					
 
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Enviar')
               ->setAttrib('id', 'submitbutton');
 
        $this->addElements(array($id, $rotulo, $created, $submit));
    }
}