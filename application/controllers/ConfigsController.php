<?php

class ConfigsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
$user = Zend_Auth::getInstance()->getIdentity()->getUserId();
    	$configs=new Model_Configs();
    	$teste=$configs->testaConfigs($user);
print_r( $teste);
if(!$teste){
    		$basicos=array('id_usuario_rel_config'=>$user,
    				'verMeus' => 1 ,
    				'verQuantosMeus' => 10,
    				'acompanhar_radicais' => 0,
    				'quais_radicais' => null,
    				'verQuantosRadicais' => null);
    		$model=new Model_Configs();
    		$model=$model->inclui($basicos);
    		$this->_helper->redirector('altera');
    		
		}

		
    	$this->_helper->redirector('altera');
		
	

    }

    public function alteraAction()
    {
    	// action body
    	 
    	$this->view->headScript()    	 
    	->appendFile( $this->view->baseUrl('script/jquery.maskedinput-1.3.js' ))
    	->appendFile( $this->view->baseUrl('script/mascaras.js' ));
    	$requisicao=$this->getRequest();
    
    	$form = new Form_AlteraConfigs();
    	 
    	if ($this->getRequest()->isPost())
    	{
    
    		if ($form->isValid($requisicao->getPost()))
    		{
    			 
    			$model=new Model_Configs();
    			$dados=$form->getValues();
    			$model->altera($dados,$dados['id_usuario_rel_config']);
    			$this->view->assign('content',"<p class='erroMsg'>Configurações modificadas com sucesso</p>");
    			
    			 
    		}
    		 
    	}
    	 
    	$id = Zend_Auth::getInstance()->getIdentity()->getUserId();
    	$this->view->form=$form;
    	$data=new Model_Configs();
    	$data= $data->verConfigs($id);
    	
    	 
    	$form->populate($data);
    	 
    }
    
   
    
public function backupAction()
    {
        // action body
         echo "<p><em>* Procure realizar o backup de dados periodicamente, <b>pelo menos uma vez por semana</b>, salvando os arquivos gerados em uma 
         		outra mídia, como pendrive ou CD gravável</em></p>";
     $base=$this->view->baseUrl();
     
     $requisicao=$this->getRequest();
     if ($this->getRequest()->isPost())
     {
     
     
     
     		$back=new Aplicacao_Backup_BackupZend();
     		$back->_constructor();
     		 echo "backup realizado com sucesso";
     		return $this->_helper->redirector->gotoUrl('configs/backup');
     	
     }
     ?>
      <form id="backup" enctype="application/x-www-form-urlencoded" action="" method="post">
      <input type='hidden' value= 'sim'/>
      <input type="submit" name="submit" id="submitbutton" value="Realizar backup" />
      </form>
     
     <?php
     $diretorio=getcwd();
     $ponteiro=opendir($diretorio.'/backup_SQL'); 
     while ($nome_itens = readdir($ponteiro))
     	
     {
     	if($nome_itens!='.' && $nome_itens!='..' ) $itens[]=$nome_itens;
     }
    	

    rsort($itens);
    echo "<table class='sample'>";
    echo "<tr><th>Backups realizados</th><th>Opções</th></tr>";
    if(sizeof($itens)){
    foreach($itens as $d=>$valor){
				
echo "<tr><td><a style='display:block;' href='$base/backup_SQL/$valor' >$valor</a>
</td><td><a class='btn btn-danger' title='Excluir' href='$base/configs/delbackup/arq/$valor' ><i class='fa fa-trash' ></i></a></td></tr>";

				}
				}
				else{echo"<tr><td colspan='2'>Não foi realizado nenhum backup</td></tr>"; }
    echo "</table>";
    }
   
    public function delbackupAction()
    {
    
    	$arq = $this->_request->getParam('arq');
    	//$base=$this->view->baseUrl();
    	//if(!file_exists("backup_SQL/$arq")){echo "<p>o arquivo não existe</p>";}
    	
    	$diretorio=getcwd();
    	
    	
    	
    	unlink("$diretorio/backup_SQL/$arq");
    	//echo "$base/backup_SQL/".$arq;
    	return $this->_helper->redirector->gotoUrl('configs/backup');
    }
   

}

