<?php
 
class Form_Login extends Zend_Form
{
    public function init()
    {
        $this->setName('login');
 
        $login = new Zend_Form_Element_Text('login');
        $login->setLabel('Matricula:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
      
              ;
 
        $senha = new Zend_Form_Element_Password('senha');
        $senha->setLabel('Senha:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
              ->setAttrib('class', 'required')
              ;
 
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Entrar')
               ->setAttrib('id', 'submitbutton')
        ->setAttrib('class', 'botao');
 
        $this->addElements(array($login, $senha, $submit));
    }
}
