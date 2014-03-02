<?php

class FormDes {
	
	function __construct()
	{
		
	}


	
	function fform_fnc()
	{
		//$this->smarty->display('admin/form_templater.tpl');
		
		$string=<<<string
		input_text;Meno;200;auto;meno;text|
		input_text;Priezvisko;200;auto;priezvisko;text|
		radio;Aktivna;auto;auto;participation;text|
		radio;Pasivna;auto;auto;participation;text|
		textarea;Adresa;100;20;adresa;text|
string;
		return $this->parseString($string);
		
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
		return $forms; 
	}
	
	
}


