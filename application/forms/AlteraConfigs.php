<?php

class Form_AlteraConfigs extends Zend_Form
{
    public function init()
    {
        $this->setName('AlteraConfigs');
 
      //idconfigs	id_usuario_rel_config	verMeus	verQuantosMeus	acompanhar_radicais	quais_radicais	verQuantosRadicais

        $id = new Zend_Form_Element_Hidden('id_usuario_rel_config');
        $id->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty')
        
        ;
        
        $verMeus=new Zend_Form_Element_Radio('verMeus');
        $verMeus->setLabel('Ver Meus Processos na tela inicial?:')        
        ->addMultiOptions(array('0'=>"Não", '1'=>'Sim'));
        
       
        
        $qtMeus = new Zend_Form_Element_Text('verQuantosMeus');
        $qtMeus->setLabel('Quantos processos?(mais recentes)')
               ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
              ->setAttrib('class', 'numero')
       		         ;
 
        
            
        
		$verRadicais=new Zend_Form_Element_Radio('acompanhar_radicais');
        $verRadicais->setLabel('Acompanhar processos por palavras?(radicais)')        
        ->addMultiOptions(array('0'=>"Não", '1'=>'Sim'));

       		
        $radicais = new Zend_Form_Element_Text('quais_radicais');
        $radicais->setLabel('Que Palavras?(separe com virgulas)')
       		->addFilter('StripTags')
        ->addFilter('StringTrim')
        
        ;
        
        $qtRadicais = new Zend_Form_Element_Text('verQuantosRadicais');
        $qtRadicais->setLabel('Ver quantas linhas com esses radicais?(mais recentes):')
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty')
        ->setAttrib('class', 'numero')
        ;
        
        
       
       
       
       
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Enviar')
               ->setAttrib('id', 'submitbutton');
 
        $this->addElements(array(  $verMeus, $qtMeus,$verRadicais, $radicais, $qtRadicais, $submit,$id));
    }
    
   
    
}