<?php 
require_once './smarty/Smarty.class.php';
require_once 'mysql.class.php';
require_once './phpmailer/class.phpmailer.php';
require_once 'xml.class.php';

session_start();


class abstracter {
	
	var $includeDir = "./include";
	var $iniDir = "./local_settings";
	var $user_id;
	var $user_email;
	
	function __construct ()
	{
		
		$this->user_id = $_SESSION['abstrakter']['user_id'];
		$this->EXml = new Excel_XML();
		$this->mail = new PHPMailer();
		$this->smarty = new Smarty;
		
	
		$this->smarty->template_dir = './templates';
		$this->smarty->compile_dir = './templates/template_c';
		$this->smarty->cache_dir = './templates/cache';
		$this->smarty->config_dir = './templates/configs';
	
		$this->db = new db(new mysqli($_SESSION['abstrakter']['server'],$_SESSION['abstrakter']['user'], $_SESSION['abstrakter']['password'],$_SESSION['abstrakter']['db']));
	}
	
	public function startPage($data)
	{
		
		if ($_SESSION['abstrakter']['session_id'] != session_id())
		{
			session_destroy();
			$this->smarty->display('logout.tpl');
		}
		
		if (!$this->run_app($data))
		{
		
			if (isset($data['run']) && $data['run']==1)
			{
				$result = $this->loginUser($_SESSION['abstrakter']['user_id']);
				
				$insData = array();
				
				$insData['user_id'] 	= $_SESSION['abstrakter']['user_id'];;
				$insData['meno'] 		= $result['meno'];
				$insData['priezvisko'] 	= $result['priezvisko'];
				$insData['titul_pred']	= $result['titul_pred'];
				$insData['titul_za']	= $result['titul_za'];
				$insData['adresa']		= $result['adresa'];
				$insData['contact_email']		= $result['contact_email'];
				
				//$this->getUserRegistrations($_SESSION['abstrakter']['user_id']);
				$this->smarty->assign('data',$insData);
				$this->smarty->assign('regbyuser',$this->getUserRegistrations($_SESSION['abstrakter']['user_id']));
				$this->smarty->assign('avab_kongres',$this->avabKongres());
				$this->smarty->assign('admin',$_SESSION['abstrakter']['is_admin']);
		
				$this->smarty->display("userdata.tpl");
				
			}
			else if (isset($data['logout']) && $data['logout'] == 1)
			{
				if (isset($_SESSION['abstrakter']['session_id']))
				{		
					unset($_SESSION['abstrakter']['session_id']);
					session_destroy();
				}
				
				$this->smarty->display('logout.tpl');
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
				$insData['functions'] = array("fnc"=>"editKongres_fnc", "value"=>intval($data['editcon']));
				$insData['buttons'] = array("insert_new_kongres"=>"Uprav...");
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
				$insData['functions'] = array("fnc"=>"insertKongres_fnc","value"=>1);
				$insData['buttons'] =	array("insert_new_kongres"=>"Vlož nový kongress");
				$this->smarty->assign('data',$insData);
				$this->smarty->display('kongress.tpl');
				//$this->insertKongress($data);
			}
			else if (isset($data['register']) && intval($data['register']) > 0)
			{
				$congress= $this->getKongressByID(intval($data['register']));
				$insData = array();
				$insData['congress'] = $congress;
				$insData['functions'] = array("fnc"=>"insertAbstr_fnc","value"=>1);
				$insData['buttons'] = array("registration_submit"=>"Uložiť");
				$this->smarty->assign('data',$insData);
				$this->smarty->display("abstraktreg.tpl");
			}
			else
			{
				if (isset($_SESSION['abstrakter']['session_id']))
				{		
					unset($_SESSION['abstrakter']['session_id']);
					session_destroy();
				}
				
				$this->smarty->display('logout.tpl');
				
				//$this->smarty->display('index.tpl');
			}
		}
	}
	
	private function run_app($request)
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
	
	private function avabKongres()
	{
		$today = date("Y-m-d");
		$sql = sprintf("SELECT * FROM [kongressdata] WHERE [congress_from] >= '%s' AND [congress_reguntil] > '%s' ",$today,$today);
		//$sql = sprintf("SELECT * FROM `kongressdata` ");
		$table = $this->db->sql_table($sql);
		
		return $table;
	}
	
	
	private function insertKongres_fnc($id, $data)
	{
		$this->insertKongress($data);
	}
	
	private function insUserData_fnc($id,$data)
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
			$insData['message'] = "Aktualizácia prebehla v poriadku....";
			
			$this->smarty->assign('avab_kongres',$this->avabKongres());
			$this->smarty->assign('regbyuser',$this->getUserRegistrations($_SESSION['abstrakter']['user_id']));
			
			$this->smarty->assign("admin",$_SESSION['abstrakter']['is_admin']);
			
			$this->smarty->assign('data',$insData);				
			$this->smarty->display("userdata.tpl");
		}
		else
		{
			$this->smarty->assign('error',$result['error']);
			$this->smarty->display("error.tpl");
		}
	}
	
	private function editKongres_fnc($id, $data)
	{
			
		$insData = array();
		
		$insData['item_id'] = intval($id);
		
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
		
		$today = date("Y-m-d");
		$sql = sprintf("SELECT * FROM `kongressdata` WHERE `congress_from` > '%s'",$today);
		
		$table = $this->db->sql_table($sql);
		$insData['avakon'] = $table;
		$insData['message'] = "Kongres sa uložil...";
		$insData['functions'] = array("fnc"=>"editKongres_fnc","value"=>$id);
		$insData['buttons'] = array("insert_new_kongres"=>"Uprav");
		$this->smarty->assign("admin",$_SESSION['abstrakter']['is_admin']);
		
		//$_SESSION['abstrakter']['selected_congress'] = $res['last_id'];
		//session_commit();
			
		$this->smarty->assign('data',$insData);
		$this->smarty->display('kongress.tpl');
				
		
	}
	
	private function deleteAbstr_fnc($id, $data)
	{
		$sql = sprintf("DELETE FROM [registration] WHERE [item_id] = %d",intval($id));
		if ($this->db->sql_execute($sql))
		{
			$result = $this->loginUser($_SESSION['abstrakter']['user_id']);
			
			/*$this->smarty->assign('contact_email',$result['email']);
			$this->smarty->assign('titul_pred',$result['titul_pred']);
			$this->smarty->assign('titul_za',$result['titul_za']);
			$this->smarty->assign('meno',$result['meno']);
			$this->smarty->assign('priezvisko',$result['priezvisko']);
			$this->smarty->assign('adresa',$result['adresa']);*/
			
			$this->smarty->assign('data',$result);
			
			//$this->getUserRegistrations($_SESSION['abstrakter']['user_id']);
			
			$this->smarty->assign('regbyuser',$this->getUserRegistrations($_SESSION['abstrakter']['user_id']));
			
			$this->smarty->assign('avab_kongres',$this->avabKongres());
			
			$this->smarty->assign("admin",$_SESSION['abstrakter']['is_admin']);
			
			$this->smarty->display("userdata.tpl");
		}
		
	}
	
	private function insertAbstr_fnc($id, $data)
	{
		$insData = array(
				"user_id"			=>$data['user_id'],
				"item_id"			=>$data['registr_id'],
				"congress_id"		=>$data['congress_id'],
				"participation"		=>$data['particip'],
				"abstract_titul"	=>$data['abstract_titul'],
				"abstract_main_autor"=>$data['abstract_main_autor'],
				"abstract_autori"	=>$data['abstract_autori'],
				"abstract_adresy"	=>$data['abstract_adresy'],
				"abstract_text"		=>$data['abstract_text']
				);
		
		if (empty($insData['item_id']))
		{
			unset($insData['item_id']);
		}
		
		$res = $this->db->insert_row("registration",$insData);
		
		if ($res['status'])
		{
			if (intval($res['last_id']) >0)
			{
				$insData['registration_id'] = $res['last_id'];
				$this->sendAbstractEmailInfo($insData);
			}
				
			
			$tmp = array();
			$tmp['congress'] = $this->getKongressByID($data['congress_id']);
			$tmp['abstract'] = $insData;
			$tmp['message'] = "Vasa ucast bol zaregistrovana...";
			$tmp['functions'] =array("fnc"=>"editAbstr_fnc","value"=>$res['last_id']);
			$tmp['buttons'] = array("registration_submit"=>"Uložiť");
			
			$tmp['admin'] = $_SESSION['abstrakter']['is_admin'];
			
			$this->smarty->assign('data',$tmp);
			$this->smarty->display('abstraktreg.tpl');
		}
	}
	
	private function sendAbstractEmailInfo($data)
	{
		$sql = sprintf("SELECT
					[registration].[item_id] AS [registr_id], [kongressdata].[item_id] AS [congress_id],
					[registration].[user_id] AS [reg_user_id], [registration].[participation] AS [reg_participation],
					[registration].[abstract_titul] AS [reg_abstract_titul],  [registration].[abstract_main_autor] AS [reg_main_autor],
					[registration].[abstract_autori] AS [reg_abstract_autori], [registration].[abstract_adresy] AS [reg_abstract_adresy],
					[registration].[abstract_text] AS [reg_abstract_text],[kongressdata].[congress_titel] AS [congress_titel],
					[kongressdata].[congress_subtitel] AS [congress_subtitel],[kongressdata].[congress_venue] AS [congress_venue],
					[kongressdata].[congress_url] AS [congress_url], [kongressdata].[congress_from] AS [congress_from],
					[kongressdata].[congress_until] AS [congress_until],[kongressdata].[congress_reguntil] AS [congress_reguntil],
					[usersdata].[meno] AS [user_meno], [usersdata].[priezvisko] AS [user_priezvisko], [users].[email] AS [email]
				FROM [registration]
					INNER JOIN [users] ON [users].[id] = [registration].[user_id]
					INNER JOIN [usersdata] ON [usersdata].[user_id] = [users].[id]
					INNER JOIN [kongressdata] ON [kongressdata].[item_id] = [registration].[congress_id]
				WHERE [registration].[item_id] = %d
				",intval($data['registration_id']));
		
		$regData = $this->db->sql_row($sql);
		
		if (isset($regData['error']))
		{
			$this->smarty->assign('error',$regData['error']);
			$this->smarty->display('error.tpl');
		}
		
		$regData['subject'] = "Informacia o registracii ucasti";
		$regData['fileName'] = 'emails/registration_info.tpl';
		
		$res = $this->sendMailMsg($regData);
		
		if ($res['status'] == FALSE)
		{
			$this->smarty->assign('error',$res['message']);
			$this->smarty->display('error.tpl');
		}
		
	}
	
	private function regKongresForUser_fnc($kongres_id,$request)
	{
		$insData = array();
		
		$sql = sprintf("SELECT * FROM [kongressdata] WHERE [item_id] = %d ",intval($kongres_id));
		//$sql = sprintf("SELECT * FROM `kongressdata` ");
		$insData['congress'] = $this->db->sql_row($sql);
		$insData['congress']['user_id'] = $_SESSION['abstrakter']['user_id'];
		
		$insData['buttons'] = array("registration_submit"=>"Uložiť");
		$insData['functions'] = array("fnc"=>"insertAbstr_fnc","value"=>1);
		$insData['admin'] = $_SESSION['abstrakter']['is_admin'];
		$this->smarty->assign("admin",$_SESSION['abstrakter']['is_admin']);
		
		$this->smarty->assign('data',$insData);
		$this->smarty->display('abstraktreg.tpl');
				
	}
	
	private function editAbstr_fnc($id,$request)
	{
		//var_dump($data);
		$sql = sprintf("SELECT
				[registration].[item_id] AS [registr_id], [kongressdata].[item_id] AS [congress_id],
				[registration].[user_id] AS [reg_user_id], [registration].[participation] AS [reg_participation],
				[registration].[abstract_titul] AS [reg_abstract_titul],  [registration].[abstract_main_autor] AS [reg_main_autor],
				[registration].[abstract_autori] AS [reg_abstract_autori], [registration].[abstract_adresy] AS [reg_abstract_adresy],
				[registration].[abstract_text] AS [reg_abstract_text],[kongressdata].[congress_titel] AS [congress_titel],
				[kongressdata].[congress_subtitel] AS [congress_subtitel],[kongressdata].[congress_venue] AS [congress_venue],
				[kongressdata].[congress_url] AS [congress_url], [kongressdata].[congress_from] AS [congress_from],
				[kongressdata].[congress_until] AS [congress_until],[kongressdata].[congress_reguntil] AS [congress_reguntil]
				FROM [registration]
				INNER JOIN [users] ON [users].[id] = [registration].[user_id]
				INNER JOIN [kongressdata] ON [kongressdata].[item_id] = [registration].[congress_id]
				WHERE [registration].[item_id] = %d
					
				",intval($id));
		
		$data = $this->db->sql_row($sql);
		
		$abstract = array(
				"user_id"			=>$data['reg_user_id'],
				"registr_id"		=>$data['registr_id'],
				"congress_id"		=>$data['congress_id'],
				"participation"		=>$data['reg_participation'],
				"abstract_titul"	=>$data['reg_abstract_titul'],
				"abstract_main_autor"=>$data['reg_main_autor'],
				"abstract_autori"	=>$data['reg_abstract_autori'],
				"abstract_adresy"	=>$data['reg_abstract_adresy'],
				"abstract_text"		=>$data['reg_abstract_text']
		);
		$congress = array(
				"congress_titel" 	=> $data['congress_titel'],
				"congress_subtitel" => $data['congress_subtitel'],
				"congress_url" 		=> $data['congress_url'],
				"congress_venue" 	=> $data['congress_venue'],
				"congress_from" 	=> $data['congress_from'],
				"congress_until" 	=> $data['congress_until'],
				"item_id"			=> $data['congress_id'],
				"user_id"			=> $data['reg_user_id']
				);
		
		$buttons = array(
				"registration_submit" => "Oprav abstrakt"
				);
		$tmp = array();
		//$tmp['congress'] = $this->getKongressByID($data['congress_id']);
		$tmp['abstract'] = $abstract;
		//$tmp['message'] = "Vasa ucast bol zaregistrovana...";
		$tmp['congress'] = $congress;
		$tmp['buttons'] = $buttons;	
		$tmp['functions'] = array("fnc"=>"insertAbstr_fnc","value"=>$id);
		$tmp['admin'] = $_SESSION['abstrakter']['is_admin'];
		$regDate = time($data['congress_reguntil']);
		$regDate2 = time(date("Y-m-d"));
		
		if ($regDate > $regDate2 )
		{
			$tmp['state'] = 'readonly';
		}
		$this->smarty->assign('data',$tmp);
		$this->smarty->display('abstraktreg.tpl');
	}
	
	private function getUserRegistrations($user_id)
	{
		$today = date("Y-m-d");
		$sql = sprintf("SELECT 
						[registration].[item_id] AS [registr_id], [kongressdata].[item_id] AS [kongr_id],
						[registration].[user_id] AS [reg_user_id], [registration].[participation] AS [reg_participation],
						[registration].[abstract_titul] AS [abstract_titul],  [registration].[abstract_main_autor] AS [reg_main_autor],
						[registration].[abstract_autori] AS [reg_abstract_autori], [registration].[abstract_adresy] AS [reg_abstract_adresy],
						[registration].[abstract_text] AS [reg_abstract_text],[kongressdata].[congress_titel] AS [congress_titel],
						[kongressdata].[congress_subtitel] AS [congress_subtitel],[kongressdata].[congress_venue] AS [congress_venue]
						
					FROM [registration]
							INNER JOIN [users] ON [users].[id] = [registration].[user_id]
							INNER JOIN [kongressdata] ON [kongressdata].[item_id] = [registration].[congress_id]
							WHERE [registration].[user_id] = %d
								AND [kongressdata].[congress_from] > '%s'	
		
							",$user_id,$today);
		
		$res = $this->db->sql_table($sql);
		//var_dump($res);
		return $res;
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
		
		$sql = sprintf("SELECT * FROM [kongressdata] WHERE [congress_from] >= '%s' ",$today);
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
			
			$insData['functions'] = array("fnc"=>"editKongres_fnc","value"=>$id);
			$insData['buttons'] = array("insert_new_kongres"=>"Uprav...");
			
			$this->smarty->assign("admin",$_SESSION['abstrakter']['is_admin']);
			
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
	
	private function getRegisteredCVS_fnc($id,$data)
	{
		$sql = sprintf("SELECT * FROM [registration]
							INNER JOIN [usersdata] ON [usersdata].[user_id] = [registration].[user_id]
					WHERE [registration].[congress_id]=%d",intval($id));
		
		$table = $this->db->sql_table($sql);
		
		$fileName = "./tmp/output_".time().".xls";
		
		if (count($table) == 0)
		{
			$this->EXml->setWorksheetTitle("Zoznam");
			$this->EXml->noData("Neobsahuje žiadne záznamy");
			$this->EXml->generateXML($fileName);
			
		}
		else
		{
			$this->EXml->setWorksheetTitle("Zoznam");
			$this->EXml->addArray($table);
			$this->EXml->generateXML($fileName);
		}
		
		$fh= fopen($fileName,"r");
		$str = fread($fh,filesize($fileName));
		fclose($fh);
			
		header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
		header('Content-Disposition: inline; filename="\.\/tmp\/'.basename($fileName).'"');
		echo $str;
		
	}
	
	function loginUser($id)
	{
		$sql = sprintf("
						SELECT * FROM [usersdata] 
							LEFT JOIN [users] ON [usersdata].[user_id] = [users].[id]
						WHERE [users].[id] = %d"
				,intval($id));
		return $this->db->sql_row($sql);
		
	}
	
	private function sendMailMsg($data)
	{
		$subject = $data['subject'];
		$fileName = $data['fileName'];
		$this->smarty->assign("data",$data);
	
		$message = $this->smarty->fetch($data['fileName']);
	
		$this->mail->isSMTP();                                      // Set mailer to use SMTP
		$this->mail->Host = 'mail.detska-chirurgia.sk';  	// Specify main and backup server
		$this->mail->Port = 25;
		$this->mail->SMTPAuth = true;                               // Enable SMTP authentication
		$this->mail->Username = 'trauma@detska-chirurgia.sk';                            // SMTP username
		$this->mail->Password = 'TraumaPassword';                           // SMTP password
		//$this->mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
	
		$this->mail->From = 'trauma@detska-chirurgia.sk';
		$this->mail->FromName = 'detska-chirurgia.sk';
		//$this->mail->addAddress('josh@example.net', 'Josh Adams');  // Add a recipient
		$this->mail->addAddress($data['email']);               // Name is optional
		$this->mail->addReplyTo('trauma@detska-chirurgia.sk', 'Detska chirurgia Slovenska');
		//	$this->mail->addCC('cc@example.com');
		//	$this->mail->addBCC('bcc@example.com');
	
		$this->mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		//	$this->mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//	$this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$this->mail->isHTML(true);                                  // Set email format to HTML
	
		$this->mail->Subject = $subject;
		$this->mail->Body    = $message;
		$this->mail->CharSet ="UTF-8";
	
		$result = array("status"=>TRUE,"message"=>'');
		if (!$this->mail->send())
		{
			//$this->smarty->assign('error',$this->mail->ErrorInfo);
			//$this->smarty->display('error.tpl');
			$result['message'] = $this->mail->ErrorInfo;
			$result['status'] = FALSE;
		}
	
		return $result;
	}
		
	
}

?>