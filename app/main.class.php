<?php 
require_once './smarty/Smarty.class.php';
require_once 'mysql.class.php';
session_start();


class abstracter {
	
	var $includeDir = "./include";
	var $iniDir = "./local_settings";
	var $user_id;
	var $user_email;
	
	function __construct ()
	{
		
		$this->user_id = $_SESSION['abstrakter']['user_id'];
		
			
		$this->smarty = new Smarty;
	
		$this->smarty->template_dir = './templates';
		$this->smarty->compile_dir = './templates/template_c';
		$this->smarty->cache_dir = './templates/cache';
		$this->smarty->config_dir = './templates/configs';
	
		$this->db = new db(new mysqli($_SESSION['abstrakter']['server'],$_SESSION['abstrakter']['user'], $_SESSION['abstrakter']['password'],$_SESSION['abstrakter']['db']));
	}
	
	function startPage($data)
	{
		
		$this->run_fnc($data);
		
		if (isset($data['run']) && $data['run']==1)
		{
			$result = $this->loginUser($_SESSION['abstrakter']['user_id']);
			
			$this->smarty->assign('contact_email',$result['email']);
			$this->smarty->assign('titul_pred',$result['titul_pred']);
			$this->smarty->assign('titul_za',$result['titul_za']);
			$this->smarty->assign('meno',$result['meno']);
			$this->smarty->assign('priezvisko',$result['priezvisko']);
			$this->smarty->assign('adresa',$result['adresa']);
			
			//$this->getUserRegistrations($_SESSION['abstrakter']['user_id']);
			
			$this->smarty->assign('regbyuser',$this->getUserRegistrations($_SESSION['abstrakter']['user_id']));
					
	
			$this->smarty->display("userdata.tpl");
			
		}
		else if (isset($data['logout']) && $data['logout'] == 1)
		{
			//session_start();
			session_destroy();
			$this->smarty->display('index.tpl');
		}
			
		else if (isset($data['insdat']) && $data['insdat'] == 1)
		{
			$insData = array();
			//print_r($_SESSION['abstrakter']);
			$insData['user_id'] 	= $_SESSION['abstrakter']['user_id'];;
			$insData['meno'] 		= $data['meno'];
			$insData['priezvisko'] 	= $data['priezvisko'];
			$insData['titul_pred']	= $data['titul_pred'];
			$insData['titul_za']	= $data['titul_za'];
			$insData['adresa']		= $data['adresa'];
			$insData['contact_email']		= $data['contact_email'];
			
			$result = $this->db->insert_row('usersdata',$insData);
			
			if ($result['status'])
			{
				$this->smarty->assign('contact_email',$insData['contact_email']);
				$this->smarty->assign('titul_pred',$insData['titul_pred']);
				$this->smarty->assign('titul_za',$insData['titul_za']);
				$this->smarty->assign('meno',$insData['meno']);
				$this->smarty->assign('priezvisko',$insData['priezvisko']);
				$this->smarty->assign('adresa',$insData['adresa']);
				$this->smarty->assign('message',"Aktualizácia prebehla v poriadku....");
				
				$this->smarty->display("userdata.tpl");
			}
			else
			{
				$this->smarty->assign('error',$result['error']);
				$this->smarty->display("error.tpl");
			}
		}
		else if (isset($data['editcon']) && intval($data['editcon']) > 0)
		{
		
			$insData = array();
			
				
			$today = date("Y-m-d");
				
			$sql = sprintf("SELECT * FROM `kongressdata` WHERE `item_id` = %d",intval($data['editcon']));
			$table = $this->db->sql_row($sql);
			foreach ($table as $key=>$value)
			{
				$insData[$key]=$value;
			}
			
			$insData['avakon'] = array();
				
			$sql = sprintf("SELECT * FROM `kongressdata` WHERE `congress_from` > '%s'",$today);
			$table = $this->db->sql_table($sql);
			$insData['avakon'] = $table;
			$this->smarty->assign('data',$insData);
			$this->smarty->display('kongress.tpl');
		}
		else if (isset($data['addcon']) && intval($data['addcon']) == 1)
		{
			$insData = array();
			$insData['avakon'] = array();
			
			$today = date("Y-m-d");
			
			$sql = sprintf("SELECT * FROM `kongressdata` WHERE `congress_from` > '%s'",$today);
			$table = $this->db->sql_table($sql);
			$insData['avakon'] = $table;
			$this->smarty->assign('data',$insData);
			$this->smarty->display('kongress.tpl');
			//$this->insertKongress($data);
		}
		
		else if (isset($data['inscongress']) && intval($data['inscongress']) == 1)
		{
			$this->insertKongress($data);
		}
		else if (isset($data['register']) && intval($data['register']) > 0)
		{
			$congress= $this->getKongressByID(intval($data['register']));
			$insData = array();
			$insData['congress'] = $congress;
			$this->smarty->assign('data',$insData);
			$this->smarty->display("abstraktreg.tpl");
		}
		else if (isset($data['regabstr']) && intval($data['regabstr']) == 1 )
		{
			$insData = array(
					"user_id"			=>$data['user_id'],
					"congress_id"		=>$data['congress_id'],
					"participation"		=>$data['particip'],
					"abstract_titul"	=>$data['abstract_titul'],
					"abstract_main_autor"=>$data['abstract_main_autor'],
					"abstract_autori"	=>$data['abstract_autori'],
					"abstract_adresy"	=>$data['abstract_adresy'],
					"abstract_text"		=>$data['abstract_text']
					);
			$res = $this->db->insert_row("registration",$insData);
			
			if ($res['status'])
			{
				$tmp = array();
				$tmp['congress'] = $this->getKongressByID($data['congress_id']);
				$tmp['abstract'] = $insData;
				$tmp['message'] = "Vasa ucast bol zaregistrovana...";
				
				$this->smarty->assign('data',$tmp);
				$this->smarty->display('abstraktreg.tpl');
			}
			
			
		}
		
		else if (isset($data['afterreg']) && intval($data['afterreg']) == 1)
		{
			//print_r($_REQUEST);
			if (filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL))
			{
				if (!$this->checkReg($_REQUEST['email']) == true)
				{
					$passwd1 = hash('md5',$_REQUEST['password']);
					$passwd2 = hash('md5',$_REQUEST['password2']);
						
					if ($passwd1 === $passwd2)
					{
						$insData = array();
		
						$insData['email'] = $_REQUEST['email'];
						$insData['password'] = $passwd1;
		
						$res = $this->db->insert_row("users",$insData);
		
						if ($res['status'])
						{
							//var_dump($res);
							//return;
							$_SESSION['abstrakter']['user_id'] = $res['last_id'];
								
							header("location:app.php?run=1");
						}
						else
						{
							$this->smarty->assign('error',$res['error']);
							$this->smarty->display('error.tpl');
						}
		
					}
					else
					{
						$this->smarty->assign('error',"Heslá sa nerovnajú");
						$this->smarty->display('error.tpl');
					}
				}
				else
				{
					$this->smarty->assign('error',"Toto nie je správna email adresa");
					$this->smarty->display('error.tpl');
				}
			}
			else{
				$this->smarty->assign('error',"Emailová adresa je už zaregistrovaná, alebo má nesprávny formát");
				$this->smarty->display('error.tpl');
			}
		}
		else
		{
			
			$this->smarty->display('index.tpl');
		}
	}
	
	private function run_fnc($data)
	{
		foreach ($data as $key=>$value)
		{
			if (strpos($key,"_fnc")!==false)
			{
				$this->$key($value);
			}
		}
	}
	
	private function editAbstr_fnc($data)
	{
		
		
		$this->smarty->assign('error',$data);
		$this->smarty->display('error.tpl');
	}
	
	private function getUserRegistrations($user_id)
	{
		$today = date("Y-m-d");
		$sql = sprintf(" SELECT * FROM `registration`
							INNER JOIN `users` ON `users`.`id` = `registration`.`user_id`
							INNER JOIN `kongressdata` ON `kongressdata`.`item_id` = `registration`.`congress_id`
							WHERE `registration`.`user_id` = %d
								AND `kongressdata`.`congress_from` > '%s'	
		
							",$user_id,$today);
		
		$res = $this->db->sql_table($sql);
		
		return $res;
	}
	
	private function checkReg($email)
	{
		$result = false;
		$sql = sprintf("SELECT * FROM `users` WHERE `email` = '%s'",$email);
		$res = $this->db->sql_count_rows($sql);
	
		if (intval($res['rows']) > 0)
		{
			$result = true;
		}
		return $result;
	}
	
	private function getKongressByID($id)
	{
		$sql = sprintf("SELECT * FROM `kongressdata` WHERE `item_id` = '%s'", $id);
		$row =$this->db->sql_row($sql);
		$congress = array();
		foreach ($row  as $key=>$value)
		{
			$congress[$key]=$value;
		}
		$congress['user_id'] = $_SESSION['abstrakter']['user_id'];
		
		return $congress;
	}
	
	private function insertKongress($data)
	{
		
		$today = date("Y-m-d");
		
		$sql = sprintf("SELECT * FROM `kongressdata` WHERE `congress_from` >= '%s' ",$today);
		//$sql = sprintf("SELECT * FROM `kongressdata` ");
		$table = $this->db->sql_table($sql);
		
		$insData = array();

		$insData['congress_titel'] = $data['congress_titel'];
		$insData['congress_subtitel'] = $data['congress_subtitel'];
		$insData['congress_url'] = $data['congress_url'];
		$insData['congress_url'] = $data['congress_url'];
		$insData['congress_venue'] = $data['congress_venue'];
		
		$insData['congress_from'] = "{$data['kondateOd_Year']}-{$data['kondateOd_Month']}-{$data['kondateOd_Day']}";
		$insData['congress_until'] = "{$data['kondateDo_Year']}-{$data['kondateDo_Month']}-{$data['kondateDo_Day']}";
		
		
		$insData['congress_regfrom'] = "{$data['dateOd_Year']}-{$data['dateOd_Month']}-{$data['dateOd_Day']}";
		$insData['congress_reguntil'] = "{$data['dateDo_Year']}-{$data['dateDo_Month']}-{$data['dateDo_Day']}";
		
		$res = $this->db->insert_row('kongressdata',$insData);
		
		if ($res['status'])
		{
			$_SESSION['abstrakter']['selected_congress'] = $res['last_id'];
			session_commit();
			$this->smarty->assign('data',$insData);
			$this->smarty->display('kongress.tpl');
					
		}
		else
		{
			$this->assign('error',$res['error']);
			$this->display('error.tpl');
		}
		
		//var_dump($_SESSION['abstrakter']);
		
	}
	private function write_page($id,$data)
	{
		if ($id === 'login')
		{
			if (filter_var($data['email'], FILTER_VALIDATE_EMAIL))
			{
				$result = $this->loginUser($data);
				//000print_r($result);
	
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
	
	private function loginUser($id)
	{
		$sql = sprintf("
				SELECT *
				FROM `users`
				LEFT JOIN `usersdata` ON `usersdata`.`user_id` = `users`.`id`
				WHERE `users`.`id` = %d
				",$id);
	
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