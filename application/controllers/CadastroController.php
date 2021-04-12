<?php

class CadastroController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	
    	  	
    	
    }

    public function indexAction()
    {
        // action body
    	
    	
    $perfil = Zend_Auth::getInstance()->getIdentity()->getRoleId();
    	if ($perfil==1) {return $this->_helper->redirector('admin');}
    	if ($perfil==2) {return $this->_helper->redirector('admin');}
    	if ($perfil>2) {return $this->_helper->redirector('alt');}
		
    }
    public function adminAction()
    {
    	// action body
    	 
    	$model=new Model_Cadastro();
    	if(!$_POST['busca']): $dados=$model->listaCadastro();
    	else:	$dados=$model->listaCadastroLike($_POST['busca']);
    	endif;
    	$url=$this->_helper->url('excluiarray');
    	$novo=$this->_helper->url('inclui');
    	$mult=$this->_helper->url('cadmult');
    	$base=$this->view->baseUrl();
        	

    	echo "<div class='comandos'>";
    	echo "<a class='btn btn-primary' href='$novo' title='Adicionar Novo'><i class='fa fa-2x fa-plus'> </i></a>&nbsp;";
    	echo "<a class='btn btn-primary' href='$mult'title='Adicionar Múltiplos'><i class='fa fa-2x fa-list'> </i></a>&nbsp;";
    	    	echo "<a class='btn btn-danger' href='javascript:void(0)' title='Remover Selecionados' onclick='document.form1.submit();'><i class='fa fa-2x fa-trash'> </i></a>";
    	echo "</div>";
    	echo "<div id='search'><form action='' method='post' id='busca' >	<input type='text' placeholder='Pesquisar...' id='q' name='busca' /></div>";
		//echo "<input type='submit'   name='buscar' /></form>";
    	echo "</form>";
    
		echo "<form id='form1' name='form1' method='post' action='$url'>";
    		echo "<table class='sample'>";
    	echo "<tr><th>Seleção</th><th>Login</th><th>Nome</th><th>ID</th><th>Ações</th></tr>";
    
    
    
    $page = $this->_getParam('pg', 1);
    $bootstrap = $this->getInvokeArg('bootstrap');
    $lines=$bootstrap->getOptions()['aplicativo']['paginator']['lines'];
    $paginator=new Aplicacao_Paginador_Monta();
    $paginator=$paginator->constructor($dados,$page,$lines);
    $this->view->assign('paginator', $paginator);
    
	if(sizeof($paginator)):
    	foreach($paginator as $c=>$valor):
    	if($valor['senhaRedefinida']!=NULL )
    	{$redef="<br />Senha Temporária : <b>".$valor['senhaRedefinida']."</b>";
    	}else{$redef="";	}
    
    		echo "<tr>";
    	echo "<td> <input type='checkbox' name='incluir[]' id='incluir[]' value='".$valor['id']."' /></td><td>".$valor['login']."</td><td>".$valor['nome_completo'].'</td><td>'.$valor['id']
    			. "</td><td>&nbsp;&nbsp;<a href='".$this->_helper->url('altera')."/id/".$valor['id']."'>Alterar</a>&nbsp;&nbsp;";
    		echo $valor['group_ldap_map']==''?"&nbsp;&nbsp;<a href='".$this->_helper->url('redefinir')."/id/".$valor['id']."'>Redefinir senha</a>&nbsp;&nbsp;":'';
    		echo $redef."</td></tr>";
		
		
     endforeach;
    					else:
    	echo "<p>Nenhum usuário encontrado.</p>";
    	endif;
    	echo "</table>";
   
    	echo "</form>";
 echo $paginator;
    	//---------------- fim paginacao-----
    
    	}
    public function cadmultAction()
    {
    	// action body
    $this->view->headScript()
    
    ->offsetSetFile(10,$this->view->baseUrl('script/jquery.validate.js')) 
    ->appendFile( $this->view->baseUrl('script/md5.js')) 
    ->appendFile( $this->view->baseUrl('script/base.js'));


    	
    	$url=$this->_helper->url('exclui');
    	$novo=$this->_helper->url('inclui');
    	$base=$this->view->baseUrl();
    	echo "<a><b>Operações com linhas: </b></a>";
    	echo "<a class='mouseOn' id='mais' href='#'><img  src='$base/src/img/table_row_insert.png' alt='Adicionar Linha' title='Adicionar Linha'/></a>";
    	echo "<a class='mouseOn' id='menos' href='#'><img  src='$base/src/img/table_row_delete.png' alt='Excluir Linha' title='Excluir Linha'/></a>";
    	echo "<div class='enviar'><a class='btn btn-primary' id='enviar' href='#'><i class='fa fa-2x fa-caret-right'></i> Enviar</a></div>";
    	
    	
    	$sn=$this->_menuPerfil();
    	
    	
    ?>
    <form id="formulario" name="formulario" method="post" action="<?php echo $this->_helper->url('processa'); ?>">
    <table id="lista">
    <thead>
        <tr>
        <th>Linha</th>
            <th>Login</th>
            <th>&nbsp;</th>
            <th>Nome</th>
            <th>email</th>
            <th>Perfil</th>
            <th>Senha</th>
        </tr>
    </thead>
    <tbody >
        <tr id="incluir0">
        <td>1</td>
            <td><input type="text" id="nome0" class="nome required" name="incluir[0][login]" size="5" autocomplete="off"   /></td>
            <td> <span id="result0" ></span> </td>
            <td><input type="text" class="required" name="incluir[0][nome_completo]" size="20" /></td>
            <td><input type="text" id="senha" class="required email" name="incluir[0][email]" size="15" /></td>
            <td id="select-linha0" >
            <select id="perfil_id" class="required" name="incluir[0][perfil_id]" size="" >
            <?php   
            foreach ($sn as $v=>$d) {
            			echo "<option value='".$d['id']."' label='".$d['nome']."'>".$d['nome']."</option>\n";
           							}
            ?>
    			
			</select>
           </td>
            <td><input type="text" class="requer" name="incluir[0][senha]" size="8" /></td>
        </tr>
        
    </tbody>
</table>
<!--Irá armazenar a quantidade de linhas-->
<input type='hidden' value='1' name='quantidade_itens' />

</form>

    <?php 
    		
    
    }
    public function processaAction()
    {
    $array= $_POST['incluir'];
    
    $model=$this->_getModel();
    $model->incluiMult($array);
    return $this->_helper->redirector('index');
   
   }
   
   public function testeAction()
   {
   		$this->_helper->layout->disableLayout();
   	
   		$this->_helper->viewRenderer->setNoRender(true);
   		
   		echo "<script src='../../public/script/jquery.js' type='text/javascript' charset='utf-8'></script>";
   		echo "<script src='../../public/script/base.js' type='text/javascript' charset='utf-8'></script>";
   		
   		$nome=$_POST['nome'];
   	echo "<a class='dado' href='#'>".$nome."11</a><br>
   	<a  class='dado mouseon' href='#'>  ".$nome."22<a><br>
   	<a class='dado mouseon' href='#'>  ".$nome."33<a><br>
   	<a class='dado mouseon' href='#'> ".$nome."44<a><br>
   	<a class='dado mouseon' href='#'>  ".$nome."555<a>";
   	//echo "este";
   
   }
   public function existeAction()
   {
    	$this->_helper->layout->disableLayout();
   
   	$this->_helper->viewRenderer->setNoRender(true);
   
   		$nome=$_POST['nome'];
   		
   		$model=$this->_getModel();
   		
   		$n=$model->confirmaLogin($nome);
   		
   		if($n>=1){
   	echo "<span style='color:#FF0000' >*Usuário já existe</span>";}
   	else {echo "<span  style='color:#4876FF' >Usuário disponível</span>";}
   	
  
   
   }
    
    public function incluiAction()
    {
    	// action body
    	$requisicao=$this->getRequest();
    	  $form = new Form_IncluiCadastro();
    	
    	
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
   $this->view->headScript()
    	//->appendFile( $this->view->baseUrl('script/jquery.js'))
    	->offsetSetFile(10, $this->view->baseUrl('script/jquery.maskedinput-1.3.js'))
    	->appendFile( $this->view->baseUrl('script/base_cadastros.js'))
	->appendFile( $this->view->baseUrl('script/taggin/js/jquery.amsify.suggestags.js'))
	->appendFile( $this->view->baseUrl('script/multiselecttag.js'))
;
$this->view->headLink()->offsetSetStylesheet(10,$this->view->baseUrl('script/taggin/css/amsify.suggestags.css'));
    	
    	$requisicao=$this->getRequest();
    	$form = new Form_AlteraCadastro();
    	    
    	if ($this->getRequest()->isPost())
    	{
    
    		if ($form->isValid($requisicao->getPost()))
    		{
    
    			$model=$this->_getModel();
    			$dados=$form->getValues();
    			$dados['data_nascimento']=$this->datamysql($dados['data_nascimento']);
    			$model->altera($dados,$dados['id']);
    			return $this->_helper->redirector('index');
    		}
    	}
    
    	$id = $this->_request->getParam('id');
    	$this->view->form=$form;
    	$data=new Model_Cadastro();
    	$data= $data->verCadastro($id);
    	$data['data_nascimento']=$this->dataPtBr($data['data_nascimento']);
	if($data['perfil_id']!=null && $data['perfil_id']!=''){
		$array_group=explode(',',$data['perfil_id']);
		$perfis_ad=new Model_Perfil();

		$perfis_ad=$perfis_ad->verOrigem('LDAP');
		$element=$form->getElement('perfil_id');
		foreach($perfis_ad as $ad){ 
			
	if(in_array($ad['nome'],$array_group)) $element->addMultiOption($ad['id'], $ad['nome']);
		}
	}
    	$form->populate($data);
   
    }
    public function altAction()
    {
    	// action body
    	echo $this->view->headScript()
    	->appendFile( $this->view->baseUrl('script/jquery.js'))
    	->appendFile( $this->view->baseUrl('script/jquery.maskedinput-1.3.js'))
    	->appendFile( $this->view->baseUrl('script/base_cadastros.js'));
    	
    	$requisicao=$this->getRequest();
    	$form = new Form_AlteraCadastro();
    	    
    	if ($this->getRequest()->isPost())
    	{
    
    		if ($form->isValid($requisicao->getPost()))
    		{
    
    			$model=$this->_getModel();
    			$dados=$form->getValues();
    			$dados['data_nascimento']=$this->datamysql($dados['data_nascimento']);
    			$model->altera($dados,$dados['id']);
    			 return $this->_helper->_redirector->gotoUrl('index');
    		}
    	}
    
    	$id =Zend_Auth::getInstance()->getIdentity()->getUserId();
    	$this->view->form=$form;
    	$data=new Model_Cadastro();
    	$data= $data->verCadastro($id);
    $data['data_nascimento']=$this->dataPtBr($data['data_nascimento']);
    	$form->populate($data);
    
    }
    
    public function excluiarrayAction()
    {
    	// action body
    	$requisicao=$this->getRequest();
    	    
    	if ($this->getRequest()->isPost())
    	{
    		$caca= $_POST['incluir'];
    		$model=$this->_getModel();
      		$model->exclui($caca);
    		return $this->_helper->redirector('index');
    
    	}
    
    }
    
    public function alterasenhaAction()
    {
    	// action body
    		$requisicao=$this->getRequest();
    	  $form = new Form_AlteraSenha();
    	 
    	if ($this->getRequest()->isPost())
    	{
    
    		if ($form->isValid($requisicao->getPost()))
    		{
    			
    			$id2 = Zend_Auth::getInstance()->getIdentity()->getUserId();
    			$model=$this->_getModel();
    			$dados=$form->getValues();
    			$nr=$model->confirmaSenha($dados['pass'], $id2);
    			if($nr==1){	
    				
    				$model->alteraSenha($dados,$id2);
    			    return $this->_helper->redirector('index');
    			}else {echo "<br /> <li><b>Sua senha atual está incorreta</b> ";
    					
    			
    			}
    						
    			
    		}
    	}
    
    	$this->view->form=$form;
    	
    
    	
    
    }
    
    public function redefinirAction()
    {
    	// action body
    			$pass=new Aplicacao_GeradorSenha_GeradorSenha();
    			$pass=$pass->_constructor('eder');
    			
    			$id = $this->_request->getParam('id');
    			$model=$this->_getModel();
    			
    			$nr=$model->redefineSenha($pass, $id);
    		
    		$this->_helper->redirector('index');
    }
    
   
    
    
    
    public function _getModel()
    {
    	// action body
    	if(null===$this->_model)
    	{
    		$this->_model=new Model_Cadastro();
    	}
    	return $this->_model;
    }
	
    public function _menuPerfil()
    {
    	$perfil = Zend_Auth::getInstance()->getIdentity()->getRoleId();
    	$modelo=new Model_Perfil();
    	$modelo=$modelo->verMaior($perfil);
    	return $modelo;
    }
    public function datamysql($data)
    {
   
		if ($data)
		{  
		$d= explode("/",$data);
		$data=$d[2]."-".$d[1]."-".$d[0];
		return $data;
		}
		else{ return null;}
		 
    }
 public function dataPtBr($data)
    {
   
		if ($data)
		{  
		$d= explode("-",$data);
		$data=$d[2]."/".$d[1]."/".$d[0];
		return $data;
		}
		else{ return null;}
		 
    }
}

