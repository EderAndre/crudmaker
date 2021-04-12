<?php
//require_once APPLICATION_PATH.'/models/Cadastro.php';
class Model_Usuario implements Zend_Acl_Role_Interface
{
	public $_userName;
	private $_roleId;
	private $_roles;
	private $_fullName;
	private $_mail;
	private $_userId;
	private $_empresa;
	private $_senha_alterada;
	private $_img;
	private $_group_map;
	
	public function getGroupMap()
	{
		return $this->_group_map;
	}

	public function setGroupMap($group_map)
	{
		$this->_group_map = (string) $group_map;
	}
		
	public function getUserId()
	{
		return $this->_userId;
	}

	public function setUserId($userId)
	{
		$this->_userId = (string) $userId;
	}

	public function getUserName()
	{
		return $this->_userName;
	}
	

	public function setUserName($userName)
	{
		$this->_userName = (string) $userName;
	}

	public function getFullName()
	{
		return $this->_fullName;
	}

	public function setFullName($fullName)
	{
		$this->_fullName = (string) $fullName;
	}
	public function getmail()
	{
		return $this->_mail;
	}
	public function setMail($mail)
	{
		$this->_mail = (string) $mail;
	}
	/**
	 *
	 */
	public function getRoleId()
	{
		return $this->_roleId;
	}

	public function setRoleId($roleId)
	{
		$this->_roleId = (string) $roleId;
	}
	public function getRolesId()
	{
		return $this->_roles;
	}

	public function setRoles($roles)
	{
		$this->_roles= (array) $roles;
	}
	
	public function getEmpresa()
	{
		return $this->_empresa;
	}
	
	
	public function setEmpresa($empresa)
	{
		$this->_empresa = (string) $empresa;
	}
	
	public function getImg()
	{
		return $this->_img;
	}
	
	
	public function setImg($img)
	{
		$this->_img = (string) $img;
	}
	
	public function getSenhaAlterada()
	{
		return $this->_senha_alterada;
	}
	
	
	public function setSenhaAlterada($senha)
	{
		$this->_senha_alterada = (string) $senha;
	}
	public function save()
	{
	$data=array('login'=>$this->_userName,'nome_completo'=>$this->_fullName,'email'=>$this->_mail,'perfil_id'=> $this->_roleId,'group_ldap_map'=> $this->_group_map,'perfis_concedidos'=>$this->_group_map);

		
	$new=new Model_Cadastro();
	if($new->confirmaLogin($this->_userName)==0){
		//$res=$new->incluiLdap($data);
		$new->incluiLdap($data);
	}
	else{	//$res=$new->infoLoginGetId($this->_userName);
		$new->alteraLDAP($data,$new->infoLoginGetId($this->_userName));
	}
	//return $res;
	}
public function getIdConta()
	{

		
	$new=new Model_Cadastro();
	return $new->infoLoginGetId($this->_userName);
	

	}
public function roleId()
	{

		
	$new=new Model_Cadastro();
	return $new->roleId($this->_userName);
	

	}
	
}
