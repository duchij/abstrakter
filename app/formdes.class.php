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
		input_text;Meno;200;auto;meno;text|
		input_text;Priezvisko;200;auto;priezvisko;text|
		radio;Aktivna;auto;auto;participation;text|
		radio;Pasivna;auto;auto;participation;text|
		textarea;Adresa;100;20;adresa;text|
string;
		
		
		//var_dump($this->parseString($string));
		
	}
	
	function parseString($string)
	{
		$rows = explode("|", $string);
		
		$forms = array();
		
		foreach ($rows as $row)
		{
			$tmp = explode(";",$row);
			array_push($forms,$tmp);
		}
		
		$this->fforms->smarty->display('error.tpl');
		
		//$this->logData($forms,5555);
		return $forms; 
	}
	
	
	
	
	
}


