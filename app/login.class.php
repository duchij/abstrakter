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
		$_SESSION['abstrakter']['session_id'] = '';
		$_SESSION['abstrakter']['is_admin'] = FALSE;
		
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
		
		if (!$this->run_fnc($_REQUEST))
		{	
			$this->smarty->assign('avab_kongres',$this->avabKOngres());
			$this->smarty->display('index.tpl');
		}
		
	}
	
	private function avabKongres()
	{
		$today = date("Y-m-d");
		$sql = sprintf("SELECT * FROM [kongressdata] WHERE [congress_from] >= '%s' ",$today);
		//$sql = sprintf("SELECT * FROM `kongressdata` ");
		return $this->db->sql_table($sql);
	}
	
	private function login_fnc($id,$data)
	{
		if (filter_var($data['email'], FILTER_VALIDATE_EMAIL))
		{
			$res = $this->loginUser($data);
		
			if (intval($res['id']) > 0)
			{
				$_SESSION['abstrakter']['user_id'] = $res['id'];
				$_SESSION['abstrakter']['user_email'] = $res['email'];
				$_SESSION['abstrakter']['session_id'] = session_id();
					
				if ($res['account'] === 'admin')
				{
					$_SESSION['abstrakter']['is_admin'] = TRUE;
				}
						
				session_commit();
				header("location:app.php?run=1");
			}
		}
	}
	
	private function register_fnc($id,$data)
	{
		
		
		$this->smarty->display('regform.tpl');
	}
	
	private function checkReg($email)
	{
		$result = false;
		$sql = sprintf("SELECT * FROM [users] WHERE [email] = '%s'",$email);
		$res = $this->db->sql_count_rows($sql);
	
		if (intval($res['rows']) > 0)
		{
			$result = true;
		}
		return $result;
	}
	
	private function registerNewUser_fnc($id,$data)
	{
		
		if (filter_var($data['email'], FILTER_VALIDATE_EMAIL) == true)
		{
			//var_dump($data);
			if (!$this->checkReg($data['email'])) 
			{
				$passwd1 = hash('md5',$data['password']);
				$passwd2 = hash('md5',$data['password2']);
					
				if ($passwd1 === $passwd2) 
				{
					$insData = array();
					$insData['email'] = $data['email'];
					$insData['password'] = $passwd1;
						
					$res = $this->db->insert_row("users",$insData);
						
					if ($res['status'])	
					{
						$tmp=array();
						$tmp['user_id'] = $res['last_id'];
						$tmp['contact_email'] = $data['email'];
							
						$this->db->insert_row('usersdata',$tmp);
						
						$_SESSION['abstrakter']['user_id'] = $res['last_id'];
						$_SESSION['abstrakter']['user_email'] = $data['email'];
						$_SESSION['abstrakter']['session_id'] = session_id();
						$this->sendMail($data['email']);
						
						session_commit();
						
						header("location:app.php?run=1");
					}
					else 
					{
						$this->smarty->assign('error_msg',$res['error']);
						$this->smarty->display('error.tpl');
					}
				}
				else 
				{
					$this->smarty->assign('error_msg',"Heslá sa nerovnajú");
					$this->smarty->display('error.tpl');
				}
			}
			else 
			{
				$this->smarty->assign('error_msg',"Užívateľ je už zaregistrovaný...");
				$this->smarty->display('error.tpl');
			}
		}
		else 
		{
			$this->smarty->assign("error_msg","Toto nie je valídna emailová adresa..");
			$this->smarty->display('error.tpl');
		}
				
	}
	
	private function run_fnc($request)
	{
		$result = false;
		foreach ($request as $key=>$value)
		{
			if (strpos($key,"_fnc")!==false)
			{
				$fnc = str_replace(array("_fnc_x","_fnc_y"),"_fnc",$key);
	
				$result = true;
				$this->$fnc($value,$request);
			}
		}
		return $result;
	}
	
	
	private function loginUser($data)
	{
		$passwd = hash('md5', $data['password']);
	
		$sql = sprintf("
				SELECT *
					FROM [users]
				LEFT JOIN [usersdata] ON [usersdata].[user_id] = [users].[id]
					WHERE [users].[email] = '%s'
					AND [users].[password] = '%s'
				",$data['email'], $passwd);
	
		$result = $this->db->sql_row($sql);
		
	
		return $result;
	}
	
	private function sendMail($email)
	{
		$headers = 'From: trauma@detska-chirurgia.sk'."\r\n";
		$headers .= 'MIME-Version: 1.0'."\r\n";
		$headers .= 'Content-Type: text/html; charset=utf-8'."\r\n";
		
		
		$message = $this->smarty->fetch("newuser_html_mail.tpl");
		$to = $email;
		
		
		$subject = "Informácia o úspešnej registrácii do aplikácie Abstrakter na webe detska-chirurgia.sk";
		
		return mail($to,$subject,$message,$headers);
		
	}
	
}


?>