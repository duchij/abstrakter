<?php 
class db {
	
	var $dbLink = null;
	var $server = '';
	var $user = '';
	var $passwd = '';
	var $dbase ='';
	
	public function __counstruct($server,$dbase,$user,$passwd)
	{
		$this->server = $server;
		$this->user = $user;
		$this->passwd = $passwd;
		$this->dbase = $dbase;
	}
	
	private function openDb()
	{
		$this->dbLink = mysql_connect($this->server, $this->user ,$this->passwd);
		if (!$this->dbLink)
		{
			die('Spojenie sa nevydarilo: ' . mysql_error());
		}
		mysql_select_db($this->dbase,$this->dbLink);
	}
	
	private function closeDb()
	{
		mysql_close($this->dbLink);
	}
	
	public function sql_table($sql)
	{
		$this->openDb();
		$tmp = mysql_query($sql, $this->dbLink);
		$result = array();
		$num_rows = mysql_num_rows($tmp);
	
		while ($row = mysql_fetch_assoc($tmp))
		{
			for ($i=0; $i<$num_rows; $i++)
			{
				$result[$i] = array();
				foreach ($row as $key=>$value)
				{
					$result[$i][$key] = $value;
				}
			}
		}
		$this->closeDb();
		return $result;
	
	}
	
	public function sql_row($sql)
	{
		$this->openDb();
		$tmp = mysql_query($sql, $this->dbLink);
		$result = array();
		$num_rows = mysql_num_rows($tmp);
	
		if ($num_rows == 1)
		{
			while ($row = mysql_fetch_assoc($tmp))
			{
				foreach ($row as $key=>$value)
				{
				$result[$key] = $value;
				}
			}
					
		}
		$this->closeDb();
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
	
		if (!mysql_query($sql))
		{
			$this->write_page('error',$sql."-".mysql_error());
			$this->closeDb();
			return FALSE;
		}
		else
		{
			$this->closeDb();
			return TRUE;
		}
	
	}
	
	function insert_row($table,$data)
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
		$sql = sprintf("INSERT INTO `%s` (%s) VALUES (%s) ON DUPLICATE KEY UPDATE",$table,$col_str,$col_val);
	
		if (!mysql_query($sql))
		{
			$this->write_page('error',$sql."-".mysql_error());
			$this->closeDb();
			return FALSE;
		}
		else
		{
			$this->closeDb();
			return TRUE;
		}
	}
}

?>