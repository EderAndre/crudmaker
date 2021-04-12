<?php
 
class Form_AlteraPerfil extends Zend_Form
{
    public function init()
    {
        $this->setName('AlteraPerfil');
        
        $id = new Zend_Form_Element_Text('id');
        $id->setLabel('Código:')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty')
        ->setAttrib('readonly', true)
        ;
 
        $nome = new Zend_Form_Element_Text('nome');
        $nome->setLabel('Nome:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
 
        $pg = new Zend_Form_Element_Text('pgInicial');
        $pg->setLabel('Página Inicial:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');

        $group = new Zend_Form_Element_Textarea('group_ldap');
        $group->setLabel('Grupo do LDAP:')
->setAttrib('rows', 5)
       ;
        
        $dc = new Zend_Form_Element_Text('created');
        $dc->setLabel('Incluído em:')
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty')
        ->setAttrib('readonly', true)
        ;
 
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Enviar')
               ->setAttrib('id', 'submitbutton');
 
        $this->addElements(array($id, $nome, $pg,$group, $dc, $submit));
    }
}
