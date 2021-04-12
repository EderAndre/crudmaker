<?php

class ConexoesController extends Zend_Controller_Action
{
	protected $_model;
	
    public function init()
    {
      
    }

    public function indexAction()
    {
$request=$this->getRequest();
	$model=new Model_Conexoes();
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
   
 protected function _getModel()
    {

    	if(null===$this->_model)
    	{
    		$this->_model=new Model_Conexoes();
    	}
    	return $this->_model;
    }


}

