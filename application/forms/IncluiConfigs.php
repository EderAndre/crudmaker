<?php

class Form_IncluiConfigs extends Zend_Form
{
    public function init()
    {
        $this->setName('IncluiConfigs');
 
      //idconfigs	id_usuario_rel_config	verMeus	verQuantosMeus	acompanhar_radicais	quais_radicais	verQuantosRadicais

       
        
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
        $radicais->setLabel('Que Palavras?')
  
		->addFilter('StripTags')
        ->addFilter('StringTrim')
        
        ;
        
        $qtRadicais = new Zend_Form_Element_Text('verQuantosRadicais');
        $qtRadicais->setLabel('Ver quantos com esses radicais?(mais recentes):')
     
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty')
        ->setAttrib('class', 'numero')
        ;
        
        
       
       
       
       
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Enviar')
               ->setAttrib('id', 'submitbutton');
 
        $this->addElements(array(  $verMeus, $qtMeus,$verRadicais, $radicais, $qtRadicais, $submit));
    }
    
   
    
}