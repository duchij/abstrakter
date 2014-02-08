<?php 
require_once './smarty/Smarty.class.php';
require_once 'mysql.class.php';

class mainapp {
	
	var $includeDir = "./include";
	var $iniDir = "./local_settings";
	
	public function __construct ()
	{
		$_SESSION['abstrakter'] = parse_ini_file("$this->iniDir/database.ini");
		$this->db = new db($_SESSION['abstrakter']['server'],$_SESSION['abstrakter']['user'],$_SESSION['abstrakter']['password']);
		
		$this->smarty = new Smarty;
		$this->smarty->template_dir = './templates';
		$this->smarty->compile_dir = './templates/template_c';
		$this->smarty->cache_dir = './templates/cache';
		$this->smarty->config_dir = './templates/configs';
	} 
	
	
	public function start($data)
	{
		//print_r($_SESSION);
		
		if (isset($data['login']) && $data['login'] == 1) {
			$this->write_page('login',$data);
		}
		else if (isset($data['reg']) && $data['reg'] == 1){
			$this->smarty->display('regform.tpl');
		}
		else if (isset($data['registration']) && $data['registration'] == 1){
			if (filter_var($data['email'], FILTER_VALIDATE_EMAIL))	{
				if ($data['password'] !== $data['password2']){
					$this->write_page('error','Heslá sa nerovnajú !!!!');
				}
				else{
					$this->db->insert_new_user($data);
				}
			}
			else{
				$this->write_page('error','Toto nie je valídna email adresa !!!');
			}
		}
		else{
			$this->smarty->assign('name', 'ted');
			$this->smarty->display('index.tpl');
		}
	}
	
	private function write_page($id,$data)
	{
		if ($id === 'login')
		{
			$this->smarty->assign('email',$data['email']);
			//$this->assign('new_reg_msg',$data['new_reg_msg']);
			
			$this->smarty->display('userdata.tpl');
		}
		if ($id === 'error')
		{
			$this->smarty->assign('error_msg', $data);
			$this->smarty->display('error.tpl');
		}
		if ($id == 'new_user')
		{
			$this->smarty->assign('email',$data['email']);
			$this->smarty->assign('new_reg_msg',$data['new_reg_msg']);
			
			$this->smarty->display('userdata.tpl');
		}
	}
	
	private function insert_new_user($data)
	{
		$sql = sprintf("SELECT COUNT(*) AS pocet FROM `users` WHERE `email` = '%s'",$data['email']);
		
		$result = $this->db->sql_row($sql);
		
		if ($result['pocet'] == 0)
		{
			$passwd_hashed = hash('md5', $data['password']);
			$ins = array();
			$ins['email'] = $data['email'];
			$ins['password'] = $passwd_hashed;
			
			$res = $this->db->sql_new_row('users',$ins);
			
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
			echo 'Tento užívateľ už existuje....';
		}
		//print_r($result);
		
	}
	
}

?>