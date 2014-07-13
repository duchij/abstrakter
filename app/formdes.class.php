<?php
require_once "app.class.php";

class FormDes extends app {
	
	var $fforms;
	
	function __construct()
	{
		//parent::__construct();
	}


	
	function fform_fnc($data)
	{
		$app = new app();				
		$this->fforms = $app->app_init();
		
		if ($data['include'] == 'formDes' && isset($data['include']))
		{
			//echo is_array($data['formDesDataFnc']);
				
			$this->showForm($data['formDesDataFnc']);
			
		}
		else
		{
			//$this->fforms->smarty->assign("data",$forms);
			
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
	
	function showForm($form)
	{
		$this->fforms->app->logData($form,666);
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
						$i++;
					}
					
					if (strpos($key,"textarea_") !== FALSE)
					{
						$arrTmp = array(
								"type"		=>"textarea",
								"label"		=>$form[$key]['label_text'],
								"width"		=>$form[$key]['textarea_width'],
								"height"	=>$form[$key]['textarea_width'],
								"field"		=>$form[$key]['column_name'],
								"value"		=>$form[$key]['textarea_text'],
								"variable"	=>'longtext',
								//"size"		=>$form[$key]['column_size']
								);
						array_push($defForm,$arrTmp);
					}
					
					if (strpos($key,"selectList_") !== FALSE)
					{
							$arrTmp = array(
								"type"		=>"selectlist",
								"label"		=>$form[$key]['label_text'],
								"width"		=>$form[$key]['selectlist_width'],
								"height"	=>$form[$key]['selectlist_width'],
								"field"		=>$form[$key]['column_name'],
								"value"		=>$this->makeItemValues_selectList($form[$key]['selectlist_items']),
								"variable"	=>'longtext',
								//"size"		=>$form[$key]['column_size']
								);
						array_push($defForm,$arrTmp);
					}
					
							
				}
				
			}
			
			$this->fforms->app->logData($defForm,777);
			$this->fforms->app->logData($i,888);
			$this->fforms->smarty->assign("data",$defForm);
			
			$this->fforms->smarty->display('formdes/formdes.tpl');
			exit;
		}
	}
	
	function makeItemValues_selectList($text)
	{
		$tmpArr1 = array();
		$tmpArr1 = explode(";",$text);
		$cnt = count($tmpArr1);
		$result = array();
		
		for ($i=0; $i<$cnt; $i++)
		{
			$tmpArr2 = explode(",",$row[$i])
			$result[$tmpArr2[0]] = $tmpArr2[1];
		} 
		
		$this->fforms->app->logData($result,3333);
		
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
