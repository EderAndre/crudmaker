<?php
class Model_Relatorios
{
  	
	protected $_table;
	
	
	
	
	
	public function totalPerfis()
	{
	
		
		$table=new Model_DbTable_Usuario;
		$consulta=$table->select()
		->from('usuario',array('perfil_id'=>'perfil_id','total'=>'count(id)'))
		->group('perfil_id')
		;
	
		return $table=$table->fetchAll($consulta)->toArray();
	
	
	}
			
}
