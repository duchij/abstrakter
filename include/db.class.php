<?php 

class db {
	
    var $log;
    
    var $mysqli;
	var $server = '';
	var $user = '';
	var $passwd = '';
	var $dbase ='';
	//var $conn = new stdClass();
	
	function __construct()
	{
	    
	    $this->log = &$GLOBALS["log"];
	   //var_dump($mysqli);
	   
	    $dbData  = require_once CONF_DIR.'mysql.ini.php';
	    
		$this->mysqli = $this->initDb($dbData);
		//$GLOBALS["app"][] = $this->mysqli;
	}
	
	public function initDb($mysqli)
	{
	    //var_dump($mysqli);
	    $this->mysqli = mysqli_connect($mysqli["server"],$mysqli["user"],$mysqli["password"] , $mysqli["db"]);
	    return $this->mysqli;
	}
	
	private function modifStr($sql)
	{
		$patterns = array(
	                       0=>"#\[([a-z_0-9]+)\.([a-z_0-9]+)\]#",
	                       1=>"#\[([a-z_0-9]+)\]#"
	    );
	    
	    $replacements = array(
                           0=>"`$1`.`$2`",
	                       1=>"`$1`"
	    );
	    
	    $sql =preg_replace($patterns, $replacements, $sql);
	    return $sql;
	}
	
	
	
	public function sql_execute($sql)
	{
		$res = true;
		$sql = $this->modifStr($sql);
		
		
		$tmp = $this->mysqli->real_query($sql);
		$this->logData($sql,'');
		
		if (!$tmp)
		{
			//trigger_error('Chyba SQL: ' . $sql . ' Error: ' . $this->mysqli->error, E_USER_ERROR);
			$this->logData('Chyba SQL: ' . $sql .'  Error: ' . $this->mysqli->error,000,true);
			
			$res = false;
		}
		
		return $res;
		
	}
	/**
	 * Nacita tabulku
	 * 
	 * @param unknown $sql
	 * @return multitype:boolean multitype: string
	 */
	public function sql_table($sql)
	{
		$result = array("status"=>TRUE,"table"=>array(),"error"=>'');
		
		$sql = $this->modifStr($sql);
		
		if ($tmp = $this->mysqli->query($sql))
		{
			$this->log->logData($sql);
			$num_rows =$tmp->num_rows;
			
			for ($i=0; $i<$tmp->num_rows; $i++)
			{
				$tmp->data_seek($i);
				$row = $tmp->fetch_array(MYSQL_ASSOC);
				array_push($result['table'],$row);
			}
			
			$tmp->free_result();
		}
		else
		{
			
			//trigger_error('Chyba SQL: <p>' . $sql . '</p> Error: ' . $this->mysqli->error);
			$result['status'] = false;
			$result['error'] = "SQL:<p>{$sql}</p>, error:<p>{$this->mysqli->error}</p>";
			
			$this->logData('Chyba SQL: ' . $sql . ' Error: ' . $this->mysqli->error,000,true);
			
			//$tmp->free_result();
		}
		
		//$tmp->close();
		return $result;
	
	}
	
	public function sql_count_rows($sql)
	{
		$result = array();
		$sql = $this->modifStr($sql);
		if ($tmp = $this->mysqli->query($sql))
		{
			$this->log->logData($sql);
			$result['rows'] = $tmp->num_rows;
			
		}
		else
		{
			trigger_error('Chyba SQL: ' . $sql . ' Error: ' . $this->mysqli->error, E_USER_ERROR);
			$result['error'] = "Error SQL: {$sql}, ".$this->mysqli->error;
			$this->logData('Chyba SQL: ' . $sql . ' Error: ' . $this->mysqli->error,000,true);
		}
		
		//print_r($result);
		return $result;
	}
	
	public function sql_row($sql)
	{
		$result = array();
		$sql = $this->modifStr($sql);
		
		$tmp = $this->mysqli->query($sql);
		if ($tmp)
		{
			$this->logData($sql);
			$row = $tmp->fetch_assoc();
			if (is_array($row))
			{
				foreach ($row as $key=>$value)
				{
					$result[$key] = $value;
				}
			}
		}
		else
		{
			trigger_error("Error SQL: {$sql} <br> ".$this->mysqli->error);
			$result['error'] = "Error SQL: {$sql}<br> ".$this->mysqli->error;
			$this->logData('Chyba SQL: ' . $sql . ' Error: ' . $this->mysqli->error,000,true);
		}
		$tmp->free_result();
		//print_r($result);
		return $result;
	
	}
	/** vlozi novy riadok bez kontroly ci existuje **/
	public function sql_new_row($table,$data)
	{
		$this->openDb();
		$colLen = count($data);
		$col_str = "";
		$col_val = "";
		$i=0;
		foreach ($data as $key=>$value)
		{
			if (($i+1) < $colLen)
			{
				$col_str .="`{$key}`,";
				$col_val .= "'{$value}',";
			}
			else
			{
				$col_str .="`{$key}`";
				$col_val .= "'{$value}'";
			}
		
			$i++;
		}
		$sql = sprintf("INSERT INTO `%s` (%s) VALUES (%s)",$table,$col_str,$col_val);
	
		if (!mysqli_query($this->dbLink,$sql))
		{
			$this->write_page('error',$sql."-".mysqli_error());
			$this->logData('Chyba SQL: ' . $sql . ' Error: ' . $this->mysqli->error,000,true);
			$this->closeDb();
			return FALSE;
		}
		else
		{
			$this->logData($sql);
			$this->closeDb();
			return TRUE;
		}
	
	}
	
	function insert_row($table,$data)
	{
		
		$result = array();
		$colLen = count($data);
		$col_str = "";
		$col_val = "";
		$col_update = "";
		$i=0;
		
		foreach ($data as $key=>$value)
		{
			if (($i+1) < $colLen)
			{
				$col_str .="`{$key}`,";
				$col_val .= "'{$this->mysqli->real_escape_string($value)}',";
				$col_update .= sprintf(" `%s` = VALUES(`%s`), ",$key,$key);
			}
			else
			{
				$col_str .="`{$key}`";
				$col_val .= "'{$this->mysqli->real_escape_string($value)}'";
				$col_update .= sprintf(" `%s` = VALUES(`%s`)",$key,$key);
			}
			$i++;
		}
		
		$sql = sprintf("INSERT INTO `%s` (%s) VALUES (%s) ON DUPLICATE KEY UPDATE %s",$table,$col_str,$col_val,$col_update);
		
		//$sql = $this->mysqli->real_escape_string($sql);
		
		//echo $sql;
		//return;
		
		if (!$tmp = $this->mysqli->query($sql))
		{
			$result['error'] = trigger_error('Chyba SQL: ' . $sql . ' Error: ' . $this->mysqli->error, E_USER_ERROR);
			$this->logData('Chyba SQL: ' . $sql . ' Error: ' . $this->mysqli->error,000,true);
			$result['status'] = FALSE;
			//$this->closeDb();
		}
		else
		{
			$this->logData($sql);
			$result['status'] = TRUE;
			$result['last_id'] = $this->mysqli->insert_id;
			//$this->closeDb();
		}
		
		//$tmp->free_result();
		return $result;
	}
}

return "db";
?>