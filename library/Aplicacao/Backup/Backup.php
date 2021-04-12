<?php
class Aplicacao_Backup_Backup
{
    /**
     * @var Zend_Acl
     */
   /**
	
	*/
    public function _constructor()
    {	
		
		$this->backup_tables('localhost','root','f3rr31r0','academia');
		
		
    }
	
   	
    protected function backup_tables($host,$user,$pass,$name,$tables = '*')
	{
	
		$link = mysql_connect($host,$user,$pass);
		mysql_select_db($name,$link);
	
		//get all of the tables
		if($tables == '*')
		{
			$tables = array();
			$result = mysql_query('SHOW TABLES');
			while($row = mysql_fetch_row($result))
			{
				$tables[] = $row[0];
			}
		}
		else
		{
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
	
		//cycle through
		foreach($tables as $table)
		{
			$result = mysql_query('SELECT * FROM '.$table);
			$num_fields = mysql_num_fields($result);
	
			$return.= '-- tabela '.$table."\n";
			$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";
	
			for ($i = 0; $i < $num_fields; $i++)
			{
			while($row = mysql_fetch_row($result))
			{
			$return.= 'INSERT INTO '.$table.' VALUES(';
			for($j=0; $j<$num_fields; $j++)
			{
			$row[$j] = addslashes($row[$j]);
				$row[$j] = ereg_replace("\n","\\n",$row[$j]);
				if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
				if ($j<($num_fields-1)) { $return.= ','; }
			}
			$return.= ");\n";
			}
			}
				$return.="\n\n\n";
			}
			$return=utf8_encode($return);
	
			//save file
		//	$handle = fopen('backup_SQL/_backup_em_'.date('Y-m-d_as_H:i:s').'.sql','w+');
		$data=date('Y').'-'.date('m').'-'.date('d').'_as_'.date('H_\h\s_\,_i_\m\i\n_\e_s_\s');
			$handle = fopen('backup_SQL/Backup_em_'.$data.'.sql','w+');
			fwrite($handle,$return);
					fclose($handle);
					chmod($handle, 0777);
					chmod('backup_SQL', 0777);
					return $handle;
	
	
 }
	
}
