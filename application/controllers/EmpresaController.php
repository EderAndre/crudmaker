<?php

class EmpresaController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->_helper->redirector('dados');
    	
    }
    
    
    public function alteraAction()
    {
    	// action body
    
    }
    
    public function dadosAction()
    {
    	// action body
		
    	$requisicao=$this->getRequest();
    	//  $form = new Form_IncluiPermissao();
    	$form = new Form_AlteraEmpresa();
    
    	if ($this->getRequest()->isPost())
    	{
    
    		if ($form->isValid($requisicao->getPost()))
    		{
    			$imageAdapter = new Zend_File_Transfer_Adapter_Http();
    
    			//$imageAdapter->setDestination('upload');
    
    			if(is_uploaded_file($_FILES['imagem_inicio']['tmp_name'])){
    				if (!$imageAdapter->receive['imagem_inicio']){
    					$messages = $imageAdapter->getMessages['imagem_inicio'];
    					//A Imagem Não Foi Recebida Corretamente
    					echo "A imagem não foi recebida corretamente";
    				} else {
    					//Arquivo Enviado Com Sucesso
    					//Realize As Ações Necessárias Com Os Dados
    
    					$filename = $form->getImg();
    
    				}
    			}
    
    			$filename = $form->getImg();
    
    
    			$model=$this->_getModel();
    			$dados=$form->getValues();
    			$model->altera($dados,$dados['id'],$filename);
    			return $this->_helper->redirector('index');
    		}
    	}
    
     
    	$this->view->form=$form;
    	$data=$this->_getModel();
    	$data= $data->ver1('1');
    
    	$form->populate($data);
    	if($data['imagem_inicio']==NULL){
    	 echo "<p class='erroMsg'>Ainda não há imagem cadastrada</p>";
    		}
    		else
    		{
    			$base=$this->view->baseUrl();
    			$imagem=$data['imagem_inicio'];
    			$this->view->img= "<div style='display:block;float:left;'><p>Imagem representativa:</p>
    			<img src='$base/src/logo/$imagem' style='width:200px; height:auto; display:block;float:left;'title='imagem da escola' alt= 'imagem da Empresa'/></div> ";
    		}
		
    }
    
	
    public function _getModel()
    {
    	// action body
    	if(null===$this->_model)
    	{
    		require_once APPLICATION_PATH."/models/Empresa.php";
    		$this->_model=new Model_Empresa();
    	}
    	return $this->_model;
    }
    

}

