<?php
require_once "app.class.php";

class FormDes extends app {
	
	var $fforms;
	
	function __construct()
	{
		//parent::__construct();
	}


	
	function fform_fnc()
	{
		$app = new app();				
		$this->fforms = $app->app_init();
		
		//$this->smarty->display('admin/form_templater.tpl');
		
		$string=<<<string
		input_text;Meno;200;auto;meno;;text|
		input_text;Priezvisko;200;auto;priezvisko;;text|
		radio;Aktivna,Pasivna,Navsteva;auto;auto;participation;aktiv,pasiv,visit;text|
		textarea;Adresa;100;20;adresa;;text
string;
		
		$this->parseString(trim($string));
		//var_dump($this->parseString($string));
		
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
		
		var_dump($forms);
		$this->fforms->app->logData($forms,666);
		$this->fforms->smarty->assign("data",$forms);
		
		$this->fforms->smarty->display('formdes/formdes.tpl');
		
		//$this->logData($forms,5555);
		return $forms; 
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
