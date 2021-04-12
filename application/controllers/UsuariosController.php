<?php

class UsuariosController extends Zend_Controller_Action
{
	protected $_model;
	
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
		require_once APPLICATION_PATH."/models/UsuarioTab.php";
		$escola = Zend_Auth::getInstance()->getIdentity()->getEscola();
		 $this->_model=new Model_UsuarioTab();
		 $b=$this->_model->listaUsuarioFEscola($escola);
		foreach($b as $valor){ echo '<br>'.$valor['id'].' - '.$valor['nome_completo'];}
		
		   $usuario = Zend_Auth::getInstance()->getIdentity();
    	$idPerfil=$usuario->getRoleID();
		//----------------------------
		
		
		
		
		$profes=new Model_Cadastro();
		$profes=$profes->listaProfessores();
		echo "<br>-----------------professores de sua escola-------------------";
		foreach ($profes as $l=>$v)
		{
			echo "<br>".$v['id'].' - '.$v['nome_completo'];
		}
		
		
		
		
    }
	
    public function adicionarAction()
    {
    	// action body
    }

}

