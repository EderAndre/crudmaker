<?php

class AcoesController extends Zend_Controller_Action
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
		 $b=$this->_model->listaAcoes();
		$url=$this->_helper->url('excluiarray');
		$novo=$this->_helper->url('inclui');
		$base=$this->view->baseUrl();
		echo "<div class='comandos'>";
    	echo "<a class='btn btn-primary' title='Incluir Novo' href='$novo'><i class='fa fa-2x fa-plus'> </i></a>&nbsp";
    	echo "<a class='btn btn-danger' title='Excluir Selecionados' href='javascript:void(0)'  onclick='document.form1.submit();'><i class='fa fa-2x fa-trash'> </i></a>";
		echo "</div>";
		
		echo "<form id='form1' name='form1' method='post' action='$url'>";
		 echo "<table class='sample'>";
		 echo "<tr><th>Seleção</th><th>Descrição</th><th>Rótulo</th><th>ID</th><th>Ações</th></tr>";
		foreach($b as $valor){ 
		 echo "<tr>";
		echo "<td> <input type='checkbox' name='incluir[]' id='incluir[]' value='".$valor['id_acao']."' /></td><td>".$valor['descricao']."</td><td>".$valor['rotulo_acao'].'</td><td>'.$valor['id_acao']
		. "</td><td>&nbsp;&nbsp;<a href='".$this->_helper->url('altera')."/id/".$valor['id_acao']."' title='Altera'><i class='fa fa-sync'> </i></a>&nbsp;&nbsp;</td>";
		echo "</tr>";
		
		}
		echo "</table>";
		
		echo "</form>";
    }
	
    public function incluiAction()
    {
    	// action body
		$requisicao=$this->getRequest();
      //  $form = new Form_IncluiPermissao();
		$form = $this->_getFormInclui();
		
		if ($this->getRequest()->isPost())
					{
					if ($form->isValid($requisicao->getPost()))
						{
						$model=$this->_getModel();
						$model->inclui($form->getValues());
						return $this->_helper->redirector('index');
						}
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
						$model->altera($dados,$dados['id_acao']);
						return $this->_helper->redirector('index');
						}
					}
				
				    $id = $this->_request->getParam('id');
					$this->view->form=$form;
					$data=$this->_getModel();
					$data= $data->verAcao($id);
					
					$form->populate($data);
					
    }
	public function excluiAction()
    {
    	// action body
		$requisicao=$this->getRequest();
      //  $form = new Form_IncluiPermissao();
		$form = $this->_getFormExclui();
		
		if ($this->getRequest()->isPost())
					{
					
					if ($form->isValid($requisicao->getPost()))
						{
						
						$model=$this->_getModel();
						$dados=$form->getValues();
						$model->exclui(array($dados['id_acao']));
						return $this->_helper->redirector('index');
						}
					}
				
				    $id = $this->_request->getParam('id');
					$this->view->form=$form;
					$data=$this->_getModel();
					$data= $data->verAcao($id);
					
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
					 $caca= $_POST['incluir'];
					// print_r ($caca);
					$model=$this->_getModel();
						
						$model->exclui($caca);
						return $this->_helper->redirector('index');
					
					}
					
    }
	
	
	protected function _getFormInclui()
    {
    	// action body
		
		require_once APPLICATION_PATH."/forms/IncluiAcao.php";
		$form= new Form_IncluiAcao();
		$form->setAction($this->_helper->url('inclui'));
		return $form;
    }
	
	protected function _getFormAltera()
    {
    	// action body
		
		//require_once APPLICATION_PATH."/forms/AlteraAcao.php";
		$form= new Form_AlteraAcao();
		$form->setAction($this->_helper->url('altera'));
		return $form;
    }
	protected function _getFormExclui()
    {
    	// action body
		
		//require_once APPLICATION_PATH."/forms/ExluiAcao.php";
		$form= new Form_ExcluiAcao();
		$form->setAction($this->_helper->url('exclui'));
		return $form;
    }
	
	public function _getModel()
    {
    	// action body
		if(null===$this->_model)
		{
		//require_once APPLICATION_PATH."/models/Acoes.php";
		 $this->_model=new Model_Acoes();
		}
		return $this->_model;
    }
}

