<?php 
//require_once '../smarty/Smarty.class.php';
//require_once 'mysql.class.php';
require_once 'main.class.php';

class mainapp extends abstracter{
	
	
	public function __construct ()
	{
		self::startPage();
		
	} 
	
	
	function startPage($data)
	{
		
		print_r($_SESSION['abstrakter']);
		
		if (isset($data['login']) && $data['login'] == 1) {
			$this->write_page('login',$data);
		}
		else if (isset($data['reg']) && $data['reg'] == 1){
			$this->smarty->display('regform.tpl');
		}
		else if (isset($data['insdat']) && $data['insdat'] == 1)
		{
			$insData = array();
			print_r($_SESSION['abstrakter']);
			$insData['user_id'] 	= $_SESSION['abstrakter']['user_id'];
			$insData['meno'] 		= $data['meno'];
			$insData['priezvisko'] 	= $data['priezvisko'];
			$insData['titul_pred']	= $data['titul_pred'];
			$insData['titul_za']	= $data['titul_za'];
			$insData['adresa']		= $data['adresa'];
						
			$this->db->insert_row('usersdata',$insData);
		}
		else if (isset($data['registration']) && $data['registration'] == 1)
		{
			if (filter_var($data['email'], FILTER_VALIDATE_EMAIL))	{
				if ($data['password'] !== $data['password2']){
					$this->write_page('error','Heslá sa nerovnajú !!!!');
				}
				else{
					$this->insert_new_user($data);
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
			if (filter_var($data['email'], FILTER_VALIDATE_EMAIL))
			{
				$result = $this->loginUser($data);
				print_r($result);
				
				if (intval($result['id']) > 0 )
				{
					$_SESSION['abstrakter']['user_id'] = $result['id'];
				//	print_r($_SESSION['abstrakter']);
					$this->smarty->assign('email',$result['email']);
					$this->smarty->assign('titul_pred',$result['titul_pred']);
					$this->smarty->assign('titul_za',$result['titul_za']);
					$this->smarty->assign('meno',$result['meno']);
					$this->smarty->assign('priezvisko',$result['priezvisko']);
					$this->smarty->assign('adresa',$result['adresa']);
						
					$this->smarty->display("userdata.tpl");
				}
			}
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
		if ($id === 'user_data')
		{
			$this->smarty->assign('email',$data['email']);
			$this->smarty->assign('titul_pred',$data['titul_pred']);
			$this->smarty->assign('titul_za',$data['titul_za']);
			$this->smarty->assign('meno',$data['meno']);
			$this->smarty->assign('priezvisko',$data['priezvisko']);
			$this->smarty->assign('adresa',$data['adresa']);
			
			$this->smarty->display("userdata.tpl");
		}
	}
	
	private function loginUser($data)
	{
		$passwd = hash('md5', $data['password']);
		
		$sql = sprintf("
				SELECT * 
					FROM `users` 
						LEFT JOIN `usersdata` ON `usersdata`.`item_id` = `users`.`id`
					WHERE `users`.`email` = '%s'
					AND `users`.`password` = '%s'	
					",$data['email'], $passwd);
		
		$result = $this->db->sql_row($sql);
		
		return $result;
		
		
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
			
			$result = $this->db->insert_row('users',$ins);
			
			//print_r($result);
			if ($result['status'])
			{
				$newData =array(
								"email"=>$data['email'],
								"new_reg_msg" => "Boli ste zaregistrovaný, táto registrácia
								Vám umožnuje vkladať abstrakty na súčasnú aj nasledujúce kongresy, konferencie a pod...",
								
								);
				//echo $result['last_id'];
				if ($result['last_id'] > 0)
				{
					$_SESSION['abstrakter']['user_id'] = $result['last_id'];
					$this->write_page("new_user",$newData);
				}
				else
				{
					$this->write_page("error",'Užívateľ už existuje....');
				}
			}
			else
			{
				$this->write_page("error",$result['error']);
			}
		}
		else
		{
			$this->write_page("error",'Užívateľ už existuje....');
			//echo 'Tento užívateľ už existuje....';
		}
		//print_r($result);
		
	}
	
}

?>