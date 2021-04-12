<?php
 
class Form_AlteraAcao extends Zend_Form
{
    public function init()
    {
	//id_acao	id_controle	acao	rotulo_acao	ordem_acao	mostraMenu
        $this->setName('AlteraAcao');
		$id = new Zend_Form_Element_Text('id_acao');
        $id->setLabel('Id:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
			  ->setAttrib('readonly', true)
			  ;
		
        $idcontrole = new Zend_Form_Element_Select('id_controle');
        $idcontrole->setLabel('Controle:')
              ->setRequired(true)
              ->addValidator('NotEmpty');
			 
					$table = new Model_Permissoes();
					$table=$table->listaPermissoes();
					//$table = array( array("id_controle"=> '1') , array("descricao"=>"esterco"));
					foreach ($table as $valor=>$c) {
				$idcontrole->addMultiOption($c['id_funcionalidade'], $c['descricao']);
					}
 
        $acao = new Zend_Form_Element_Text('acao');
        $acao->setLabel('Ação:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
		
		$rotulo = new Zend_Form_Element_Text('rotulo_acao');
        $rotulo->setLabel('Rotulo(menu):')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
		
		$ordem = new Zend_Form_Element_Text('ordem_acao');
        $ordem->setLabel('Ordem(menu):')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
			  
		$menu = new Zend_Form_Element_Select('mostraMenu');
        $menu->setLabel('Mostrar no menu:')
              ->setRequired(true)
              ->addValidator('NotEmpty');
			 
					
					$sn[]=array('num'=> 0, 'valor'=>'Sim' );
					$sn[]=array('num'=> 1, 'valor'=>'Não');
					//$table = array( array("id_controle"=> '1') , array("descricao"=>"esterco"));
					foreach ($sn as $valor=>$c) {
				$menu->addMultiOption($c['num'], $c['valor']);
				}
			  
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
 
        $this->addElements(array($id, $idcontrole, $acao, $rotulo, $ordem, $menu, $created, $submit));
    }
}