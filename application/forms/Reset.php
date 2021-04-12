<?php
 
class Form_Reset extends Zend_Form
{
    public function init()
    {
        $this->setName('reset');
 
        $login = new Zend_Form_Element_Text('username');
        $login->setLabel('login:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
      
              ;
 
        $senha = new Zend_Form_Element_Text('mail');
        $senha->setLabel('email:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
              ->setAttrib('class', 'required')
              ;
 
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Enviar')
               ->setAttrib('id', 'submitbutton2')
        ->setAttrib('class', 'botao');
 
        $this->addElements(array($login, $senha, $submit));
    }
}
