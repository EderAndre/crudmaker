<?php
 
class Form_IncluiPermissao extends Zend_Form
{
    public function init() 
    {
        $this->setName('IncluiPermissao');
 
        $descricao = new Zend_Form_Element_Text('descricao');
        $descricao->setLabel('Descricao:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
 
        $funcionalidade = new Zend_Form_Element_Text('funcionalidade');
        $funcionalidade->setLabel('Funcionalidade:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $menu = new Zend_Form_Element_Select('exibirmenu');
        $menu->setLabel('Exibir no menu:')
        // ->setRequired(true)
        ;
        
        $es[]=array('num'=> '', 'valor'=>'' );
        $es[]=array('num'=> '1', 'valor'=>'Sim' );
        $es[]=array('num'=> '0', 'valor'=>'Não');
        
        
        foreach ($es as $valor=>$c) {
        	$menu->addMultiOption($c['num'], $c['valor']);
        }
 
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Enviar')
               ->setAttrib('id', 'submitbutton');
 
        $this->addElements(array($descricao, $funcionalidade, $menu, $submit));
    }
}