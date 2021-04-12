<?php

class PerfisController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    	
    	
    	$model=$this->_getModel();
    	$b=$model->listaPagina();
    	$base=$this->view->baseUrl();
    	$url=$this->_helper->url('excluiarray');
    	$novo=$this->_helper->url('inclui');
    	echo "<div class='comandos'>";
    	echo "<a class='btn btn-primary' title='Adicionar Novo' href='$novo'><i class='fa fa-2x fa-plus'> </i></a>";
    	echo "<a class='btn btn-danger' title='Excluir selecionados' href='javascript:void(0)'  onclick='document.form1.submit();'><i class='fa fa-2x fa-trash'> </i></a>";
    	echo "</div>";
    	
    	echo "<form id='form1' name='form1' method='post' action='$url'>";
    	echo "<table class='sample'>";
    	echo "<tr><th>Seleção</th><th>Cód</th><th>Nome</th><th>Pg Inicial</th><th>Ações</th></tr>";
    	foreach($b as $valor){
    		echo "<tr>";
    		echo "<td> <input type='checkbox' name='incluir[]' id='incluir[]' value='".$valor['id']."' /></td><td>".$valor['id']."</td><td>".$valor['nome'].'</td><td>'.$valor['pgInicial']
    		. "</td><td>
    		&nbsp;&nbsp;<a href='".$this->_helper->url('altera')."/id/".$valor['id']."' title='Alterar'><i class='fa fa-sync'> </i></a>&nbsp;&nbsp;
    		&nbsp;&nbsp;<a href='".$this->_helper->url('perm')."/id/".$valor['id']."' title='Ver/Alterar Permissões'><i class='fa fa-eye'> </i></a>&nbsp;&nbsp;
    		</td>";
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
		$form = new Form_IncluiPerfil();
		
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
		$form = new Form_AlteraPerfil();
		
		if ($this->getRequest()->isPost())
					{
					
					if ($form->isValid($requisicao->getPost()))
						{
						
						$model=$this->_getModel();
						$dados=$form->getValues();
						$model->altera($dados,$dados['id']);
						return $this->_helper->redirector('index');
						}
					}
				
				    $id = $this->_request->getParam('id');
					$this->view->form=$form;
					$data=$this->_getModel();
					$data= $data->ver1($id);
					
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
 public function excluipAction()
    {
    	// action body
    	$model=new Model_PerfilFuncionalidade();
    	$idPerfil = $this->_request->getParam('id');
    	 $idAcao = $this->_request->getParam('acao');  
    		
    
    		$model->exclui($idAcao,$idPerfil);
    		// $this->_helper->redirector('/perm/id/'.$idPerfil);
    	return	$this->_helper->_redirector->gotoUrl('perfis/perm/id/'.$idPerfil);
    
    
    
    }
    
    
    public function permAction()
    {

    	$model=new Model_PerfilFuncionalidade();
    	$id = $this->_request->getParam('id');
    	$b=$model->lista($id);
    	
    	$altera=$this->_helper->url('alterap');
    	$base=$this->view->baseUrl();
    	$add='/src/img/add.png';
    	$exc='/src/img/exc.png';
    	//print_r($b);
    	
    	echo "<div class='comandos'>";
    	echo "<a class='btn btn-primary' title='Alterar selecionados' href='javascript:void(0)'  onclick='document.form1.submit();'><i class='fa fa-2x fa-sync'> </i></a>";
    	echo "</div>";
    	
    	echo "<form id='form1' name='form1' method='post' action='$altera'>";
    	echo "<input type='hidden' name='id' id='id' value='".$id."' />";
    	echo "<table class='sample'>";
    	echo "<tr><th>Seleção</th><th>Descrição</th><th>Ação</th></tr>";
    	foreach($b as $valor){
    		
    		echo "<tr>";
    		echo "<td> <input type='checkbox' name='incluir[]' id='incluir[]' value='".
    		$valor['id_acao']."' ".
    		$valor['select']."/></td><td>".
    		$valor['descricao']." - ".
    		$valor['rotulo_acao']."</td>";
    		echo "<td><a class='mouseOn' href=".$this->_helper->url('excluip')."/id/".$id."/acao/".$valor['id_acao']." title='Excluir'><i class='fa fa-trash'> </i></a></td>";
    		echo "</tr>";
    	
    	}
    	echo "</table>";
    	
    	echo "</form>";
    	
    	
    }
    
    public function alterapAction()
    {
    	$requisicao=$this->getRequest();
       	
    	if ($this->getRequest()->isPost())
    	{
    		$alteracao= $_POST['incluir'];
    		$id=$_POST['id'];
    		

    		$model=new Model_PerfilFuncionalidade();
    		
    		
    		$model->permite($alteracao,$id);
    		return $this->_helper->redirector(array('controller' => 'perfis', 'action' => 'perm'));
    	
    	}
    	
    }
   
    
    
    public function _getModel()
    {
    	// action body
    	if(NULL===$this->_model)
    	{
    		require_once APPLICATION_PATH."/models/Perfil.php";
    		$this->_model=new Model_Perfil();
    	}
    	return $this->_model;
    }


}
