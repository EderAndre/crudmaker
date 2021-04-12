<?php
class Model_PerfilUsuario 
{
	private $_userId;
	

	public function getPerfisUsuario($userId)
	{
		return $this->_userId;
	}

	public function setPerfisusuario($userId)
	{
		$this->_userName = (string) $userId;
	}

	
}