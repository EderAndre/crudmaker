<?php

class PermissoesController extends Zend_Controller_Action
{
	protected $_model;
	
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
		//	echo $this->_helper."/incluir<br>";
        // action body
		 $this->_getModel();
		 $b=$this->_model->listaPermissoes();
		 $base=$this->view->baseUrl();
		 //-------------------------------------------------
		 $url=$this->_helper->url('excluiarray');
		 $novo=$this->_helper->url('inclui');
		 
		 echo "<div class='comandos'>";
		 echo "<a class='btn btn-primary' title='Incluir Novo' href='$novo'><i class='fa fa-2x fa-plus '> </i></a>&nbsp;";
		 echo "<a class='btn btn-danger' title='Excluir Selecionados'  href='javascript:void(0)' onclick='document.form1.submit();'><i class='fa fa-2x fa-trash '> </i></a>";
		 echo "</div>";
		 echo "<form id='form1' name='form1' method='post' action='$url'>";
		 echo "<table class='sample'>";
		 echo "<tr><th>Seleção</th><th>Código</th><th>Descrição</th><th>Funcionalidade</th><th>Ações</th></tr>";
		 foreach($b as $valor){
		 	echo "<tr>";
		 	echo "<td> <input type='checkbox' name='incluir[]' id='incluir[]' value='".$valor['id_funcionalidade']."' /></td><td>".$valor['id_funcionalidade']."</td><td>".$valor['descricao'].'</td><td>'.$valor['funcionalidade']
		 	. "</td><td>&nbsp;&nbsp;<a href='".$this->_helper->url('altera')."/id/".$valor['id_funcionalidade']."' title='Alterar'><i class='fa fa-sync'> </i></a>&nbsp;&nbsp;</td>";
		 	echo "</tr>";
		 	}
		 	echo "</table>";
		 	
		 	echo "</form>";
		 //------------------------------------------------
		 

    }
    
	
    public function incluiAction()
    {

    	
		$requisicao=$this->getRequest();
      
		$form = $this->_getFormPerm();
		
		if ($this->getRequest()->isPost())
					{
					if ($form->isValid($requisicao->getPost()))
						{
						$model=$this->_getModel();
						$model->incluiPermissoes($form->getValues());
						return $this->_helper->redirector('index');
						}
					else{echo 'erro';}
					}
					$this->view->form=$form;

    }
	
	 public function alteraAction()
    {
    	// action body
		$requisicao=$this->getRequest();
      //  $form = new Form_IncluiPermissao();
		$form = $this->_getFormAltera();
		
		if ($this->getRequest()->isPost())
					{
					
					if ($form->isValid($requisicao->getPost()))
						{
						
						$model=$this->_getModel();
						$dados=$form->getValues();
						$model->alteraPermissoes($dados,$dados['id_funcionalidade']);
						return $this->_helper->redirector('index');
						}
					}
				
				    $id = $this->_request->getParam('id');
					$this->view->form=$form;
					$data=$this->_getModel();
					$data= $data->verPermissao($id);
					
					$form->populate($data);
					
    }
    
    public function excluiarrayAction()
    {
    	// action body
    	$requisicao=$this->getRequest();
    	//  $form = new Form_IncluiPermissao();
    	//$form = $this->_getFormInclui();
    
    	if ($this->getRequest()->isPost())
    	{
    		$exc= $_POST['incluir'];
    		// print_r ($caca);
    		$model=$this->_getModel();
    
    		$model->exclui($exc);
    		return $this->_helper->redirector('index');
    
    	}
    
    }
	
	protected function _getFormPerm()
    {
    	// action body
		
		require_once APPLICATION_PATH."/forms/IncluiPermissao.php";
		$form= new Form_IncluiPermissao();
		$form->setAction($this->_helper->url('inclui'));
		return $form;
    }
	protected function _getFormaltera()
    {
    	// action body
		
		require_once APPLICATION_PATH."/forms/AlteraPermissao.php";
		$form= new Form_AlteraPermissao();
		$form->setAction($this->_helper->url('altera'));
		return $form;
    }
	
	public function _getModel()
    {
    	// action body
		if(null===$this->_model)
		{
		require_once APPLICATION_PATH."/models/Permissoes.php";
		 $this->_model=new Model_Permissoes();
		}
		return $this->_model;
    }
}

