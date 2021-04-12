<?php

class ConexoesController extends Zend_Controller_Action
{
	protected $_model;
	
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
	$modelo1=new Model_Conexoes();
	$list=$modelo1->listAll();
	$this->view->assign('items',$list);
/*	
$array=$modelo1->getTableInfo();

	foreach ($array as $col){ print_r($col['COLUMN_NAME'].'-'.$col['DATA_TYPE'].'-'.($col['NULLABLE']==1?'true':'false').'-'.$col['LENGTH'].'-'.$col['DEFAULT'].'-'.$col['PRIMARY']."<br>");};
*/

/* MSSQL
try{
	$db1=$this->_conectaMSSQL();


	$select1 = $db1->select()->from('VIEWOLAPPESSOAL_RHE_ONLINE')		
		->where('MATRICULA = ?',4245121);
		$result = $db1->fetchRow($select1);
		print_r(array_map('utf8_encode',$result));
}catch(Exception $e){echo $e->getMessage();}
*/
/* PGSQL
try{
$db1=$this->_conectaPGSQL();


	$select1 = $db1->select()->from('auth_user');
		$result = $db1->fetchRow($select1);
		print_r($result);
}catch(Exception $e){echo $e->getMessage();}

*/
    }
	
    public function insertAction()
    {
	$requisicao=$this->getRequest();
    	  $form = new Form_ConexoesInsert();
    	
    	
    	if ($this->getRequest()->isPost())
    	{
    		if ($form->isValid($requisicao->getPost()))
    		{
    			$model1=$this->_getModel();
    			$model1->insert($form->getValues());
    			return $this->_helper->redirector('index');
    		}
    	}

	$this->view->form=$form;
    }
    public function updateAction()
	    {
  	$request=$this->getRequest();
	$id=$request->getParam('id');
	$model=$this->_getModel();
	$item=$model->getOne($id);
    	$form = new Form_ConexoesInsert();
	
    	if ($request->isPost()&& $request->getParam('submit')=='Enviar')
    	{
    		if ($form->isValid($request->getPost()))
    		{
    
    			 $model->update($form->getValues(),$id);
    			return $this->_helper->redirector('index');
    		}
    	}
	$form->populate($item);
	$this->view->form=$form;
	

	    }
   public function deleteAction()
	    {
		$request=$this->getRequest();
	  	$id=$request->getParam('id');
	 	$model=$this->_getModel();
		$item=$model->getOne($id);
		$this->view->assign('item',$item);
		if ($request->isPost()&& $request->getParam('ConfirmAction')=='DELETE')
		    	{
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
   protected function _conectaMSSQL()
	{
	require_once 'Zend/Db.php';
		try{
			$config =array(
				'host'=>'10.244.168.87'
				, 'username'=>'user_relatorios'
				,'password'=>'user@relatorios'
				,'dbname'=>'PUB'
				,'pdoType'=>'dblib'
				,'charset'=>'UTF-8'
				);
			$db = Zend_Db::factory('Pdo_Mssql',$config);
		}catch(Exception $e){	
			echo $e->getMessage();exit;
		}
	
	return $db;

	}
protected function _conectaPGSQL()
	{
	require_once 'Zend/Db.php';
		try{
			$config =array(
				'host'=>'172.20.120.73'
			, 'username'=>'helios'
			,'password'=>'H3l105'
				,'dbname'=>'helios'
				//,'pdoType'=>'dblib'
				,'charset'=>'UTF-8'
				);
			$db = Zend_Db::factory('Pdo_Pgsql',$config);
		}catch(Exception $e){	
			echo $e->getMessage();exit;
		}
	
	return $db;

	}
 public function _getModel()
    {
    	// action body
    	if(null===$this->_model)
    	{
    		$this->_model=new Model_Conexoes();
    	}
    	return $this->_model;
    }


}

