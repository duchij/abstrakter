<?php 
require_once 'smarty/Smarty.class.php';
require_once 'mysql.class.php';
session_start();
class login{
	
	var $includeDir = "./include";
	var $iniDir = "./local_settings";
	
	function __construct()
	{
		
		$_SESSION['abstrakter'] = parse_ini_file("$this->iniDir/database.ini");
		$_SESSION['abstrakter']['item_id'] = 0;
		$_SESSION['abstrakter']['user_email'] = '';
		//$_SESSION['abstrakter'] = parse_ini_file("$this->iniDir/database.ini");
		$this->db = new db(new mysqli($_SESSION['abstrakter']['server'],$_SESSION['abstrakter']['user'], $_SESSION['abstrakter']['password'],$_SESSION['abstrakter']['db']));
		
		$this->smarty = new Smarty();
		$this->smarty->template_dir = './templates';
		$this->smarty->compile_dir = './templates/template_c';
		$this->smarty->cache_dir = './templates/cache';
		$this->smarty->config_dir = './templates/configs';
	}
	
	public function start()
	{
		if (isset($_REQUEST['login']) &&  intval($_REQUEST['login']) == 1)
		{
			if (filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL))
			{
				$res = $this->loginUser($_REQUEST);
				if (intval($res['id']) > 0)
				{
					$_SESSION['abstrakter']['user_id'] = $res['id'];
					$_SESSION['abstrakter']['user_email'] = $res['email'];
					$_SESSION['abstrakter']['session_id'] = session_id();
					session_commit();
					header("location:app.php?run=1");
				}
			}
		}
		else if (isset($_REQUEST['register']) && intval($_REQUEST['register']) == 1)
		{
			$this->smarty->display('regform.tpl');
		}
		else
		{
			$this->smarty->display('index.tpl');
		}
		
	}
	
	private function loginUser($data)
	{
		$passwd = hash('md5', $data['password']);
	
		$sql = sprintf("
				SELECT *
				FROM `users`
				LEFT JOIN `usersdata` ON `usersdata`.`user_id` = `users`.`id`
				WHERE `users`.`email` = '%s'
				AND `users`.`password` = '%s'
				",$data['email'], $passwd);
	
		$result = $this->db->sql_row($sql);
		
		//print_r($result);
	
		return $result;
	}
}


?>