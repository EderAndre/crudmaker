<?php

class CrudController extends Zend_Controller_Action
{
	protected $_model;
	protected $_name='VIEWOLAPPESSOAL_RHE_ONLINE';
	
    public function init()
    {
      
    }

    public function indexAction()
    {
$request=$this->getRequest();
	$model=$this->_getModel();
if ($request->isPost()&& $request->getParam('submit')=='Search'){
$list=$model->listLikeNome($request->getParam('searchWord'));
}else{
	$list=$model->listAll();
}
	$page = $this->_getParam('pg', 1);
	$bootstrap = $this->getInvokeArg('bootstrap');
	$lines=$bootstrap->getOptions()['aplicativo']['paginator']['lines'];
	$paginator=new Aplicacao_Paginador_Monta();
	$paginator=$paginator->constructor($list,$page,$lines);
	$this->view->assign('items', $paginator);
   
    }
public function existsfeatureAction(){

	$this->_helper->layout->disableLayout();
	$this->_helper->viewRenderer->setNoRender(true);
	$request=$this->getRequest();

	echo json_encode($this->_preConditions($request->name));
   
    }
    protected function _cleanFiles($name){
    	$name=ucfirst(strToLower($name));
	$filenameC=dir('../application/controllers/');
	$filenameM=dir('../application/models/');
	$filenameF=dir('../application/forms/');
	$filenameV=dir('../application/views/scripts/');

	$filenameC=$filenameC->path.ucfirst(strToLower($name)).'Controller.php';
	$filenameM=$filenameM->path.ucfirst(strToLower($name)).'.php';
	$filenameF=$filenameF->path.ucfirst(strToLower($name)).'Insert.php';
	$filenameV=$filenameV->path.strToLower($name);

	if(file_exists($filenameC)){ unlink($filenameC);}
	if(file_exists($filenameM)){ unlink($filenameM);}
	if(file_exists($filenameF)){ unlink($filenameF);}
	if(file_exists($filenameV)){ 
		array_map('unlink',glob($filenameV.'/*.phtml'));
		rmdir($filenameV);
	}
	
    }
    protected function _preConditions($name){
	$result=[];
	$messages=[];
	$name=ucfirst(strToLower($name));
	$filenameC=dir('../application/controllers/');
	$filenameV=dir('../application/views/scripts/');
	$filenameM=dir('../application/models/');
	$filenameF=dir('../application/forms/');

	$filenameC=$filenameC->path.ucfirst(strToLower($name)).'Controller.php';
	$filenameV=$filenameV->path.strToLower($name);
	$filenameM=$filenameM->path.ucfirst(strToLower($name)).'.php';
	$filenameF=$filenameF->path.ucfirst(strToLower($name)).'Insert.php';
	if(!file_exists($filenameC)){
		$result[]=true;
		}else{
		$result[]=false; 
		$messages[]='Controler já existe!';
	}
	if(!file_exists($filenameV)){
		$result[]=true;
		}else{
		$result[]=false; 
		$messages[]='Views já existem!';
	}
	if(!file_exists($filenameM)){
		$result[]=true;
		}else{
		$result[]=false; 
		$messages[]='Model já existe!';
	}
	if(!file_exists($filenameF)){
		$result[]=true;
		}else{
		$result[]=false; 
		$messages[]='Formulário já existe!';
	}
	$modelP=new Model_Permissoes();
	$count=count($modelP->exists(strToLower($name)));
	if($count<1){
		$result[]=true;
		}else{
		$result[]=false; 
		$messages[]='Já existe esta funcionalidade na base de dados!';
	}

	return array('result'=>!in_array(false,$result)?'true':'false','messages'=>$messages);
    }
    public function insertAction()
    {
		  echo $this->view->headScript()
    ->appendFile( $this->view->baseUrl('script/crudmaker/base_insert.js'));
	$requisicao=$this->getRequest();
    	  $form = new Form_CrudInsert();
    	
    	
    	if ($this->getRequest()->isPost())
    	{
    		if ($form->isValid($requisicao->getPost()))
    		{
			$re=$form->getValues(); 
			$descriptor=json_decode($re['descriptor']);
			$name=$re['name'];  
			$roleDefault=$re['role_default']; 
			$model1=$this->_getModel();
			$cond=$this->_preConditions($name);
			if($cond['result']=='false'){
				
				$this->view->assign('messages',$cond['messages']);
				
			}else{
			$this->_createAssets($name);
			$this->_createController($name,$descriptor);
			$this->_createViews($name,$descriptor);
			$this->_createForms($name,$descriptor);
			$this->_createModel($name,$descriptor);
			$this->_syncDatabase($name,$roleDefault);
    			$model1->insert($form->getValues());			
    			return $this->_helper->redirector('index');


			}
			
    		}

    	}

	$this->view->form=$form;
    }
    public function updateAction()
	    {
	echo $this->view->headScript()
    ->appendFile( $this->view->baseUrl('script/crudmaker/base_update.js'));
  	$request=$this->getRequest();
	$id=$request->getParam('id');
	$roleDefault=$request->getParam('role_default'); 
	$name=$request->getParam('name');  
	$descriptor=json_decode($request->getParam('descriptor'));
	$model=$this->_getModel();
	$item=$model->getOne($id);
    	$form = new Form_CrudInsert();
	
    	if ($request->isPost()&& $request->getParam('send')=='update')
    	{
    		if ($form->isValid($request->getPost()))
    		{	
			//$this->_cleanFiles($name);
			$this->_createAssets($name);
			$this->_createController($name,$descriptor);
			$this->_createViews($name,$descriptor);
			$this->_createForms($name,$descriptor);
			$this->_createModel($name,$descriptor);
			$this->_cleanDatabase($name);
			$this->_syncDatabase($name,$roleDefault);
    			
    			 $model->update($form->getValues(),$id);
    			return $this->_helper->redirector('index');
			//print_r($form->getValues());
			//exit;
    		}
    	}
	$form->populate($item);
	$this->view->form=$form;
	

	    }
   public function deleteAction()
	    {
		$request=$this->getRequest();
	  	$id=$request->getParam('id');
		$name=$request->getParam('name');
	 	$model=$this->_getModel();
		$item=$model->getOne($id);
		$this->view->assign('item',$item);
		if ($request->isPost()&& $request->getParam('ConfirmAction')=='DELETE')
		    	{
			$this->_cleanFiles($name);
			$this->_cleanDatabase($name);
		    	$model->delete($id);
		    	return $this->_helper->redirector('index');
		    		
		    	}
	    }
public function viewAction()
	    {
		$request=$this->getRequest();
	   	$id=$request->getParam('id');
		$model=$this->_getModel();
		$item=$model->getOne($id);
		$this->view->assign('item',$item);
	}
public function editassetsAction()
	    {
	 $this->view->headScript()
    ->offsetSetFile(4, $this->view->baseUrl('script/CodeMirror/lib/codemirror.js'));
	 $this->view->headScript()
    ->offsetSetFile(5, $this->view->baseUrl('script/CodeMirror/mode/javascript/javascript.js'));
 $this->view->headScript()
    ->offsetSetFile(6, $this->view->baseUrl('script/CodeMirror/mode/css/css.js'));
 $this->view->headLink()->offsetSetStylesheet(4,$this->view->baseUrl('script/CodeMirror/lib/codemirror.css'));
 $this->view->headLink()->offsetSetStylesheet(5,$this->view->baseUrl('script/CodeMirror/theme/cobalt.css'));
	$request=$this->getRequest();
	   	$id=$request->getParam('id');
		$model=$this->_getModel();
		$item=$model->getOne($id);
		$name=$item['name'];

	$filenameCSS=dir('../public/css/_CRUD/');
	$directoryCSS=$filenameCSS->path.strToLower($name);
	$filenameCSS=$filenameCSS->path.strToLower($name).'/styleCustom.css';

	
	$filenameJS=dir('../public/script/_CRUD/');	
	$directoryJS=$filenameJS->path.strToLower($name);
	$filenameJS=$filenameJS->path.strToLower($name).'/scriptCustom.js';

	if ($request->getPost()){
		$js=$request->getParam('js');
		$css=$request->getParam('css');
		$handleCSS=file_put_contents($filenameCSS,$css);	
		$handleJS =file_put_contents($filenameJS,$js);
		return $this->_helper->redirector('index');	

	}else{
		$cssContent=file_get_contents($filenameCSS);
		$jsContent=file_get_contents($filenameJS);
		$assets['css']=$cssContent;
		$assets['js']=$jsContent;
		$this->view->assign('assets',$assets);
	}

}
public function fieldsAction()
	    {
$this->_helper->layout->disableLayout();
	$this->_helper->viewRenderer->setNoRender(true);
try{
		$request=$this->getRequest();
	   	$id=$request->getParam('id');
		$table=$request->getParam('table');
		$md=new Model_Conexoes();
		$configs=$md->getOne($id);
		$result=$this->_getTableInfo($configs,$table);
		$result=$this->_getTableInfo($configs,$table)?$result:null;
	
	echo json_encode($result);
}catch(Exception $e){
	echo json_encode($e->getMessage());
}
	


	}
   public function tbexistsAction()
	    {
$this->_helper->layout->disableLayout();
	$this->_helper->viewRenderer->setNoRender(true);
try{
		$request=$this->getRequest();
	   	$id=$request->getParam('id');
		$table=$request->getParam('table');
		$md=new Model_Conexoes();
		$configs=$md->getOne($id);
		$result=$this->	_getTableInfo($configs,$table);
		$hasPrimaryKey=false;
		
		foreach($result as $k=> $field){
			if($field['PRIMARY']=='true'){
					$hasPrimaryKey=true;
					$result['messages']=$k;
					break;				
				}	
			}
		if(count($result)>0 && $hasPrimaryKey){
			$result['result']=true;
			$result['messages']='Existe chave primária : '.$result['messages'];
		}elseif(count($result)==0 ){
			$result['result']=false;
			$result['messages']='Tabela inexistente ou conexão inválida';
		}else{
			$result['result']='false';
			$result['messages']='Tabela existente inválida, chave primária não detectada';}
		

	

	
	echo json_encode( $result);
}catch(Exception $e){
	echo json_encode(array('result'=>false,'messages'=>'Tabela inexistente ou conexão inválida'));
}
		

	}
 protected function _getModel()
    {

    	if(null===$this->_model)
    	{
    		$this->_model=new Model_Crud();
    	}
    	return $this->_model;
    }
protected function _createController($name,$descriptor){
	$filename=dirname(__FILE__).'/'.ucfirst($name).'Controller.php';
	$content=file_get_contents(dirname(__FILE__).'/TEMPLATES/CONTROLLERS/CONTROLLER.phtml');
	$search=array('[__CONTROLLER_CRUD_NAME__]'
			,'[__CRUD_KEY_PARAM__]'
			,'[__FIELD_SEARCHEABLE__]'
		);
	$replace=array(
		ucfirst(strToLower($name)),
		$descriptor->generalConfigs->primaryKey,
		$descriptor->generalConfigs->searcheable
		
		);
	$content=str_replace($search,$replace,$content);
	$handle=file_put_contents($filename,$content);
	}

protected function _createViews($name,$descriptor){
	$files=scandir(dirname(__FILE__).'/TEMPLATES/VIEWS');
	$files=array_diff($files,array('.','..','for_td.phtml','for_th.phtml'));
	$content_list_th=file_get_contents(dirname(__FILE__).'/TEMPLATES/VIEWS/for_th.phtml');
	$content_list_td=file_get_contents(dirname(__FILE__).'/TEMPLATES/VIEWS/for_td.phtml');
	$th='';
	$td='';
	$edit=array();
	foreach($descriptor->elements as $el){ 
		$el->listable==1?$th.=str_replace('[__TH_LIST_FIELD__]',$el->label,$content_list_th):'';	
		$el->listable==1?$td.=str_replace('[__TD_LIST_NAME__]',$el->name,$content_list_td):'';	
		$el->editable==1?$edit[]=$el->name:'';
	}

	foreach($files as $f){
	$filename=dir('../application/views/scripts/');
	$directory=$filename->path.strToLower($name);
	!is_dir($directory)?mkdir($directory,0755):false;
	$filename=$filename->path.strToLower($name).'/'.$f;
	$content=file_get_contents(dirname(__FILE__).'/TEMPLATES/VIEWS/'.$f);
	$search=array(	'[__CONTROLLER_CRUD_NAME__]'
			,'[__CRUD_KEY_PARAM__]'
			,'[__CONTROLLER_CRUD_LABEL__]'
			,'[__TH_LIST_FIELDS__]'
			,'[__TD_LIST_NAMES__]'
			,'[__LIST_NAMES_ARRAY__]'
		     );
	$replace=array(
			strToLower($name)
			,$descriptor->generalConfigs->primaryKey
			,ucfirst(strToLower($name))
			,$th
			,$td
			,"array('".join("','",$edit)."')"
			);
	$content=str_replace($search,$replace,$content);
	$handle=file_put_contents($filename,$content);

	}

}
protected function _createForms($name,$descriptor){
	$content_body=file_get_contents(dirname(__FILE__).'/TEMPLATES/FORMS/BODY.phtml');
	$content_list_fields='';
	$content_body_fields='';

	foreach($descriptor->elements as $el){ 
		$content_temp="";
		$variable_name='__v_'.$el->name;
		if($el->editable==1){	
			$content_temp=file_get_contents(dirname(__FILE__).'/TEMPLATES/FORMS/INPUT_'.strToUpper($el->type).'.phtml');
			$arr=implode("','",explode(',',$el->array));
			$required=$el->required?'':'//';
			$repl=array($variable_name,$el->name,$el->label,$arr,$required);
			$srch=array('[__FIELD_VAR_NAME__]','[__FIELD_NAME__]','[__FIELD_LABEL__]','[__FIELD_ARRAY__]','[__FIELD_IS REQUIRED__]');	
			$content_temp=str_replace($srch,$repl,$content_temp);
			$content_body_fields.=$content_temp;
			$content_list_fields.='$'.$variable_name.','.PHP_EOL;
		}
			
	}

	
	$filename=dir('../application/forms/');
	$filename=$filename->path.ucfirst(strToLower($name)).'Insert.php';
	$content=$content_body;
	$search=array(	'[__CONTROLLER_CRUD_NAME__]'
			,'[__CRUD_KEY_PARAM__]'
			,'[__CONTROLLER_CRUD_LABEL__]'
			,'[__FORM_CONTENT__]'
			,'[__ELEMENTS_LIST__]'

		     );
	$replace=array(
			ucfirst(strToLower($name))
			,$descriptor->generalConfigs->primaryKey
			,ucfirst(strToLower($name))
			,$content_body_fields
			,$content_list_fields
			);
	$content=str_replace($search,$replace,$content);
	$handle=file_put_contents($filename,$content);



}
protected function _createModel($name,$descriptor){
	$content_body=file_get_contents(dirname(__FILE__).'/TEMPLATES/MODELS/SAMPLE_MODEL.phtml');

	
	$filename=dir('../application/models/');
	$filename=$filename->path.ucfirst(strToLower($name)).'.php';
	$content=$content_body;
	$search=array(	'[__CONTROLLER_CRUD_NAME__]'
			,'[__CRUD_KEY_PARAM__]'
			,'[__FIELD_SEARCHEABLE__]'
			,'[__CRUD_TABLE_NAME__]'
			,'[__CRUD_ID_CONNECTION__]'

		     );
	$replace=array(
			ucfirst(strToLower($name))
			,$descriptor->generalConfigs->primaryKey
			,$descriptor->generalConfigs->searcheable
			,$descriptor->generalConfigs->tableName
			,$descriptor->generalConfigs->connectionId
			);
	$content=str_replace($search,$replace,$content);
	$handle=file_put_contents($filename,$content);



}

protected function _createAssets($name){

	$filenameCSS=dir('../public/css/_CRUD/');
	$directoryCSS=$filenameCSS->path.strToLower($name);
	!is_dir($directoryCSS)?mkdir($directoryCSS,0755):false;
	$filenameCSS=$filenameCSS->path.strToLower($name).'/styleCustom.css';
	$cssContent=file_get_contents(dirname(__FILE__).'/TEMPLATES/ASSETS/styleCustom.css');
	$handleCSS=file_put_contents($filenameCSS,$cssContent);
	$filenameJS=dir('../public/script/_CRUD/');	
	$directoryJS=$filenameJS->path.strToLower($name);
	!is_dir($directoryJS)?mkdir($directoryJS,0755):false;
	$filenameJS=$filenameJS->path.strToLower($name).'/scriptCustom.js';
	$jsContent=file_get_contents(dirname(__FILE__).'/TEMPLATES/ASSETS/scriptCustom.js');
	$handleJS=file_put_contents($filenameJS,$jsContent);

}

protected function _syncDatabase($name,$idProfileDefault){
	
try{

		$idFeature=$this->_insertFeature($name);
		$listActions=$this->_insertActions($idFeature);
		$this->_insertPermissions($listActions,$idProfileDefault);



		return true;

	}catch(Exception $e){

		return false;	
	
		}

}
protected function _cleanDatabase($nameCrud){
	
		$mdP=new Model_Permissoes();
		$feature=$mdP->exists($nameCrud);
		$idFeature=$feature[0]['id_funcionalidade'];
		
		$mdA=new Model_Acoes();
		$mdPF=new Model_PerfilFuncionalidade();
		$listAction= $mdA->getAllActionByFeature($idFeature);
		$vetor=array();
		foreach($listAction as $k=>$data){
			$vetor[]=$data['id_acao'];
			$mdPF->deleteFromAllProfiles($data['id_acao']);//exlui permissoes
		}

		$mdA->exclui($vetor);//exclui acoes
		$mdP->exclui(array($idFeature));//exclui permissao

}

protected function _insertFeature($name){
	$md=new Model_Permissoes();
	$idFeature=$md->incluiPermissoes(array('descricao'=>ucfirst(strToLower($name)),'funcionalidade'=>strToLower($name),'ordem_controles'=>1000));
	return $idFeature;

}

protected function _insertActions($idFeature){
	$arrayResponse=array();	
	$ac=new Model_Acoes();
	$arrayResponse[0]=$ac->inclui(array('id_controle'=>$idFeature,'acao'=>'index','rotulo_acao'=>'Lista','ordem_acao'=>0,'mostraMenu'=>0));
	$arrayResponse[1]=$ac->inclui(array('id_controle'=>$idFeature,'acao'=>'insert','rotulo_acao'=>'Novo','ordem_acao'=>1,'mostraMenu'=>0));
	$arrayResponse[2]=$ac->inclui(array('id_controle'=>$idFeature,'acao'=>'update','rotulo_acao'=>'Atualizar','ordem_acao'=>2));
	$arrayResponse[3]=$ac->inclui(array('id_controle'=>$idFeature,'acao'=>'delete','rotulo_acao'=>'Excluir','ordem_acao'=>3));
	$arrayResponse[4]=$ac->inclui(array('id_controle'=>$idFeature,'acao'=>'view','rotulo_acao'=>'Visualizar','ordem_acao'=>4));
	return $arrayResponse;


}

protected function _insertPermissions($listActions=array(),$idProfile){
	$md=new Model_PerfilFuncionalidade();
 	$md->permite($listActions,$idProfile);


}


public function _connectionGeneric($config)
	{
	require_once 'Zend/Db.php';
		try{
			
			$db = Zend_Db::factory($config['factory'],$config);
		}catch(Exception $e){	
			$db= $e->getMessage();
			
		}
	
	return $db;

	}
public function _getTableInfo($config,$table){
		$db1=$this->_connectionGeneric($config);
		$result =$db1->describeTable($table);
		return $result;	
	}
public function _getLineOne($config,$table){
		$db1=$this->_connectionGeneric($config);
		$select=$db1->select($table)->from(array('t'=>$table))->limit(1);
		$result =$db1->fetchRow($select);
		return $result;	
	}
  

 

}

