<?php
require_once "app.class.php";

class FormDes extends app {
	
	var $fforms;
	
	var $enumObj = array();
	
	function __construct()
	{
		//parent::__construct();
	}


	
	function fform_fnc($data)
	{
		$app = new app();				
		$this->fforms = $app->app_init();
		
		$this->fforms->app->logData($_SESSION);
		
		if (isset($data['include']))
		{
			if ($data['include'] == 'formDes')
			{
				//echo is_array($data['formDesDataFnc']);
				$this->showForm($data);
			}
			if ($data['include'] == 'setTableName')
			{
				$this->setTableName($data['tableName']);
			}
		}
		else
		{
			//$this->fforms->smarty->assign("data",$forms);
			$data = array();
			$tmp =  $this->getUserCongress();
			
			$this->fforms->app->logData($tmp,6666);
			$this->fforms->smarty->assign("congress",$tmp);
			$this->fforms->smarty->display('formdes/formdes2.tpl');
		}
		
		//$this->smarty->display('admin/form_templater.tpl');
		
		$string=<<<string
		input_text;Meno;200;auto;meno;;text|
		input_text;Priezvisko;200;auto;priezvisko;;text|
		radio;Aktivna,Pasivna,Navsteva;auto;auto;participation;aktiv,pasiv,visit;enum|
		textarea;Adresa;100;20;adresa;;text
string;
		
		//$this->parseString(trim($string));
		//var_dump($this->parseString($string));
		
	}
	
	function getUserCongress()
	{
		$sql = sprintf("SELECT * FROM [kongressdata] WHERE [user_id]=%d ORDER BY [congress_created] DESC",intval($_SESSION['abstrakter']['user_id']));
		
		$tmp = $this->fforms->db->sql_table($sql);
		$result = array();
		if ($tmp['status']!=FALSE)
		{
			$result = $tmp['table'];
		}
		
		return $result;
		
	}
	
	function showForm($data)
	{
		
		$this->fforms->db->sql_execute('DROP TABLE IF EXISTS [test]');
		
		$sqlStart = "CREATE TABLE [test] (";
		$sqlArr = array();
		//$this->fforms->app->logData($data,666);
		
		$form = $data['formDesDataFnc'];
		$enumObj = $data['enumObj'];
		
		//$this->fforms->app->logData($enumObj,666);
		
		
		$defForm = array();
		$i=0;
		if (is_array($form))
		{
			foreach($form as $key=>$value)
			{
				$arrTmp = array();
				
				if (!empty($form[$key]))
				{
				
					if (strpos($key,"input_text_") !== FALSE)
					{
						$arrTmp = array(
								"type"		=>"input_text",
								"label"		=>$form[$key]['label_text'],
								"width"		=>$form[$key]['input_text_width'],
								//"height"	=>$tmp[3],
								"field"		=>$form[$key]['column_name'],
								"value"		=>$form[$key]['input_text'],
								"variable"	=>'text',
								"size"		=>$form[$key]['column_size']
								
								);
						array_push($defForm,$arrTmp);
						$colSize = intval($form[$key]['column_size']);
						array_push($sqlArr,"[{$form[$key]['column_name']}] TEXT({$colSize}) COLLATE 'utf8_general_ci' NULL");
						$i++;
					}
					
					if (strpos($key,"textarea_") !== FALSE)
					{
						$arrTmp = array(
								"type"		=>"textarea",
								"label"		=>$form[$key]['label_text'],
								"width"		=>$form[$key]['textarea_width'],
								"height"	=>$form[$key]['textarea_height'],
								"field"		=>$form[$key]['column_name'],
								"value"		=>$form[$key]['textarea_text'],
								"variable"	=>'longtext',
								//"size"		=>$form[$key]['column_size']
								);
						array_push($defForm,$arrTmp);
						array_push($sqlArr,"[{$form[$key]['column_name']}] LONGTEXT COLLATE 'utf8_general_ci' NULL");
					}
					
					if (strpos($key,"selectList_") !== FALSE)
					{
							$arrTmp = array(
								"type"		=>"selectlist",
								"label"		=>$form[$key]['label_text'],
								"width"		=>$form[$key]['selectlist_width'],
								"height"	=>$form[$key]['selectlist_width'],
								"field"		=>$form[$key]['column_name'],
								"value"		=>$this->parseKeyItem($form[$key]['selectlist_items']),
								"variable"	=>'enum',
								//"size"		=>$form[$key]['column_size']
								);
							
							$this->enumObj[$key] = $this->parseKeyItem($form[$key]['selectlist_items']);
						array_push($defForm,$arrTmp);
						array_push($sqlArr,"[{$form[$key]['column_name']}] TEXT(255) COLLATE 'utf8_general_ci' NULL");
					}
					if (strpos($key,"radio_") !== FALSE)
					{
						$arrTmp = array(
								"type"		=>"radio",
								"label"		=>$form[$key]['label_text'],
								//"width"		=>$form[$key]['selectlist_width'],
								//"height"	=>$form[$key]['selectlist_width'],
								"group"		=>$form[$key]['radio_group'],
								"value"		=>$form[$key]['radio_value'],
								"variable"	=>'enum',
								//"size"		=>$form[$key]['column_size']
						);
						//$this->enumObj[$key] = array()
						array_push($defForm,$arrTmp);
						if (isset($enumObj[$form[$key]['radio_group']]))
						{
							$eStr =$this->makeEnumStr($enumObj[$form[$key]['radio_group']]); 
							
							array_push($sqlArr,"[{$form[$key]['radio_group']}] ENUM ({$eStr}) COLLATE 'utf8_general_ci' NULL");
							unset($enumObj[$form[$key]['radio_group']]);
						}
					}
					
				}
			}
			
			$sqlMid = implode(",",$sqlArr);
			$sqlEnd =") COMMENT='' ENGINE='InnoDB' COLLATE 'utf8_general_ci'";
			
			$sqlStr = $sqlStart.$sqlMid.$sqlEnd;
			
			$this->fforms->smarty->assign("data",$defForm);
			//$this->fforms->smarty->assign("sqlStr",$sqlStr);
			//$this->fforms->db->sql_execute($sqlStr);
			$this->fforms->smarty->display('formdes/formdes.tpl');
			exit;
		}
	}
	
	function makeEnumStr($arr)
	{
		$cnt = count($arr);
		$result = "";
		for ($i=0; $i<$cnt; $i++)
		{
			$arr[$i] = "'{$arr[$i]}'";
		}
		$result = implode(",",$arr);
		
		return $result;
	}
	
	function parseKeyItem($text)
	{
		$tmpArr1 = array();
		$tmpArr2 = array();
		$result = array();
		if (strpos($text,";") !== FALSE)
		{
			$tmpArr1 = explode(";",$text);
			$cnt = count($tmpArr1);
			
			for ($i=0; $i<$cnt; $i++)
			{
				if (strpos($tmpArr1[$i],",") !== FALSE)
				{
					$tmpArr2 = explode(",",$tmpArr1[$i]);
					$result[trim($tmpArr2[0])] = trim($tmpArr2[1]);
				}
			} 
		}
		
		//$this->fforms->app->logData($result,3333);
		return $result;
	}
	
	function parseString($string)
	{
		$rows = explode("|", $string);
		//var_dump($rows);
		
		$forms = array();
		
		foreach ($rows as $row)
		{
			$tmp = explode(";",trim($row));
			//$tmpLen = count($tmp);
			
			if ($tmp[0] == 'radio')
			{
				$labArr = explode(",",$tmp[1]);
				$valArr = explode(",",$tmp[5]);
				
				$cntArr = count($labArr);
				
				for ($i=0; $i<$cntArr; $i++)
				{
					$asAr = array (
							"type"		=>$tmp[0],
							"label"		=>$labArr[$i],
							"width"		=>$tmp[2],
							"height"	=>$tmp[3],
							"field"		=>$tmp[4],
							"value"		=>$valArr[$i],
							"variable"	=>$tmp[6],
								
					);
					array_push($forms,$asAr);
				}
				
			}
			else
			{
				$asAr = array (
							"type"		=>$tmp[0],
							"label"		=>$tmp[1],
							"width"		=>$tmp[2],
							"height"	=>$tmp[3],
							"field"		=>$tmp[4],
							"value"		=>$tmp[5],
							"variable"	=>$tmp[6],
					
					);
				array_push($forms,$asAr);
			}
		}
		
		//var_dump($forms);
		$this->fforms->app->logData($forms,666);
		$this->fforms->smarty->assign("data",$forms);
		
		$this->fforms->smarty->display('formdes/formdes2.tpl');
		
		//$this->logData($forms,5555);
		return $forms; 
	}
	
	function makeSQLTable($data)
	{
	
		$rows = explode(";", $data);
		$sql = "";
		foreach ($rows as $row)
		{
			if ($row[0] == 'input_text'){
				$sql .= sprintf("[%s] longtext COLLATE 'utf_slovak_ci' NULL",$row[4]);
			}
			if ($row[0] == 'radio'){
				$enum = sprintf("");
			}
		}
		
	}
}

$str = <<<str
CREATE TABLE `pokus` (
  `item_id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `congress_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `meno` longtext COLLATE 'utf8_slovak_ci' NOT NULL,
  `priezvisko` longtext COLLATE 'utf8_slovak_ci' NOT NULL,
  `particip` enum('visit','pasiv','aktiv') COLLATE 'utf8_slovak_ci' NOT NULL
) COMMENT='' COLLATE 'utf8_slovak_ci';

str;
