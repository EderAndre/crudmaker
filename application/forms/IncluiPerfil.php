<?php
 
class Form_IncluiPerfil extends Zend_Form
{
    public function init()
    {
        $this->setName('IncluiPerfil');
 
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
 
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Enviar')
               ->setAttrib('id', 'submitbutton');
 
        $this->addElements(array($nome, $pg, $submit));
    }
}