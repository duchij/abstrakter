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
		radio;Aktivna;auto;auto;participation;aktiv;text|
		radio;Pasivna;auto;auto;participation;pasiv;text|
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
		
		//var_dump($forms);
		$this->fforms->app->logData($forms,666);
		$this->fforms->smarty->assign("data",$forms);
		
		$this->fforms->smarty->display('formdes/formdes.tpl');
		
		//$this->logData($forms,5555);
		return $forms; 
	}
	
	
	
	
	
}


