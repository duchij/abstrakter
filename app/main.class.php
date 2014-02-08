<?php 
require_once 'init.class.php';

class abstracter extends SuperClass {
	
	var $includeDir = "./include";
	var $iniDir = "./local_settings";
	
	var $dbLink = null;
	
	function abstracter() {
		
		$this->template_dir = './templates';
		$this->compile_dir = './smarty/template_c';
		$this->cache_dir = './smarty/cache';
		$this->config_dir = './smarty/configs';
		
		$_SESSION['abstrakter'] = parse_ini_file("$this->iniDir/database.ini");
		
	}
	
	function start($data)
	{
		//print_r($_SESSION);
		
		if (isset($data['login']) && $data['login'] == 1)
		{
			
			$this->write_page('login',$data);
		}
		else if (isset($data['reg']) && $data['reg'] == 1)
		{
			$this->display('regform.tpl');
		}
		else if (isset($data['registration']) && $data['registration'] == 1)
		{
			
			if (filter_var($data['email'], FILTER_VALIDATE_EMAIL))
			{
				if ($data['password'] !== $data['password2'])
				{
					$this->write_page('error','Hesla sa nerovnaju !!!!');
				}
				else
				{
					$this->insert_new_user($data);
				}
			}
			
			else
			{
				$this->write_page('error','Toto nie je valídna email adresa !!!');
			}
		}
		else
		{
			$this->assign('name', 'ted');
			$this->display('index.tpl');
		}
	}
	
	function write_page($id,$data)
	{
		if ($id === 'login')
		{
			$this->assign('email',$data['email']);
			//$this->assign('new_reg_msg',$data['new_reg_msg']);
			
			$this->display('userdata.tpl');
		}
		if ($id === 'error')
		{
			$this->assign('error_msg', $data);
			$this->display('error.tpl');
		}
		if ($id == 'new_user')
		{
			$this->assign('email',$data['email']);
			$this->assign('new_reg_msg',$data['new_reg_msg']);
			
			$this->display('userdata.tpl');
		}
	}
	
	function insert_new_user($data)
	{
		$sql = sprintf("SELECT COUNT(*) AS pocet FROM `users` WHERE `email` = '%s'",$data['email']);
		$result = $this->sql_row($sql);
		
		if ($result['pocet'] == 0)
		{
			$passwd_hashed = hash('md5', $data['password']);
			$ins = array();
			$ins['email'] = $data['email'];
			$ins['password'] = $passwd_hashed;
			
			$res = $this->sql_new_row('users',$ins);
			if ($res)
			{
				$newData =array(
								"email"=>$data['email'],
								"new_reg_msg" => "Boli ste zaregistrovaný, táto registrácia
								Vám umožnuje vkladať abstrakty na súčasnú aj nasledujúce kongresy, konferencie a pod..."
								);
				$this->write_page("new_user",$newData);
			}
		}
		else
		{
			echo 'tento uzivatel uz existuje....';
		}
		//print_r($result);
		
	}
	
	
	
	
	
	
}

?>