<?php

class Form_AlteraSenha extends Zend_Form
{
    public function init()
    {
        $this->setName('AlteraSenha');
        
        $pass = new Zend_Form_Element_Password('pass');
        $pass->setLabel('Senha Atual:')
        // ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ;
        
        $senha = new Zend_Form_Element_Password('senha');
        $senha->setLabel('Nova Senha:')
        // ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
      //  ->addErrorMessage('Senha incorreta')
        ;
        
        $confirma_senha = new Zend_Form_Element_Password('confirma_senha');
        $confirma_senha->setLabel('Confirmação:')
        // ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator( 'Identical', false, array( 'token' => 'senha' ) )
        ->addErrorMessage('A Nova Senha e a Confirmação são diferentes')
        ;
/*
        $confirmPswd = $this->createElement( 'senha', 'confirma_senha' );
        $confirmPswd->setLabel( 'Confirmar senha:' );
        $confirmPswd->setAttrib( 'size', '30' );
        $confirmPswd->setRequired( TRUE );
        $confirmPswd->addValidator( 'Identical', false, array( 'token' => 'senha' ) );
        $confirmPswd->addErrorMessage('As Senhas são diferentes');
        $this->addElement( $confirmPswd );
*/        
        $senhaAlterada = new Zend_Form_Element_Hidden('senha_alterada');
        $senhaAlterada
        // ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->setValue('1')
        ;
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Enviar')
               ->setAttrib('id', 'submitbutton');
 
        $this->addElements(array( $pass, $senha, $confirma_senha,$senhaAlterada, $submit));
       
    }
}