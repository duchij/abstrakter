<?php 
session_start();
require_once 'app.class.php';

class abstracter extends app {
	
	function __construct ()
	{
		parent::__construct();
	}

	
	public function startPage($data)
	{
		
		if ($_SESSION['abstrakter']['session_id'] != session_id())
		{
			$this->logOut();
			
		}
		
		if (!$this->run_app($data, $this)) //this calls a function in main class 
		{
			if (isset($data['run']) && $data['run']==1)
			{
				$this->firstRun();
			}
			else if (isset($data['logout']) && $data['logout'] == 1)
			{
				$this->logOut();
			}
			else if (isset($data['editcon']) && intval($data['editcon']) > 0)
			{
				$this->_editCongress($data);
			}
			else if (isset($data['addcon']) && intval($data['addcon']) == 1)
			{
				$this->_addCongress($data);
			}
			else if (isset($data['register']) && intval($data['register']) > 0)
			{
				$this->_registerAbstract($data);
			}
			else
			{
				$this->logOut();
			}
		}
	}
	
	private function logOut()
	{
		$logut_html = $this->smarty->fetch('logout.tpl');
			
		$fp = fopen("logout.html","w+");
			
		fwrite($fp,$logut_html);
		fclose($fp);
			
		unset($_SESSION['abstrakter']);
		session_destroy();
			
		header("location:logout.html");
	}
	
	private function firstRun()
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
	
	private function _editCongress($data)
	{
		$insData = array();
		$today = date("Y-m-d");
		$sql = sprintf("SELECT * FROM [kongressdata] WHERE [item_id] = %d",intval($data['editcon']));
		$table = $this->db->sql_row($sql);
		foreach ($table as $key=>$value)
		{
			$insData[$key]=$value;
		}
		$insData['avakon'] = array();
			
		$sql = sprintf("SELECT * FROM [kongressdata] WHERE [congress_from] > '%s'",$today);
		$table = $this->db->sql_table($sql);
		$insData['avakon'] = $table['table'];
		
		$insData['functions'] = array("fnc"=>"editKongres_fnc", "value"=>intval($data['editcon']));
		$insData['buttons'] = array("insert_new_kongres"=>"Uprav...");
		$this->smarty->assign('data',$insData);
		$this->smarty->display('kongress.tpl');
	}
	
	private function _addCongress($data)
	{
		$insData = array();
		$insData['avakon'] = array();
		
		$today = date("Y-m-d");
		$sql = sprintf("SELECT * FROM [kongressdata] WHERE [congress_from] > '%s'",$today);
		
		$table = $this->db->sql_table($sql);
		$insData['avakon'] = $table['table'];
		
		$insData['functions'] = array("fnc"=>"insertKongres_fnc","value"=>1);
		$insData['buttons'] =	array("insert_new_kongres"=>"Vlož nový kongress");
		
		$this->smarty->assign('data',$insData);
		$this->smarty->display('kongress.tpl');
	}
	
	private function _registerAbstract($data)
	{
		$congress= $this->getKongressByID(intval($data['register']));
		$insData = array();
		$insData['congress'] = $congress;
		$insData['functions'] = array("fnc"=>"insertAbstr_fnc","value"=>1);
		$insData['buttons'] = array("registration_submit"=>"Uložiť");
		$this->smarty->assign('data',$insData);
		$this->smarty->display("abstraktreg.tpl");
	}
	

	public function avabKongres()
	{
		$today = date("Y-m-d");
		$sql = sprintf("SELECT * FROM [kongressdata] WHERE [congress_from] >= '%s' AND [congress_reguntil] > '%s' ",$today,$today);
		//$sql = sprintf("SELECT * FROM `kongressdata` ");
		$table = $this->db->sql_table($sql);
		
		return $table['table'];
	}
	
	public function fform_fnc($id, $data)
	{
		$this->forms->fform_fnc(); //calls formdes.class.php and uses this class for creating of simple formulars 
	}
	
	public function insertKongres_fnc($id, $data)
	{
		$this->insertKongress($data);
	}
	
	public function insUserData_fnc($id,$data)
	{
		$insData = array();
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
	
	public function editKongres_fnc($id, $data)
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
		$sql = sprintf("SELECT * FROM [kongressdata] WHERE [congress_from] > '%s'",$today);
		
		$table = $this->db->sql_table($sql);
		$insData['avakon'] = $table['table'];
		$insData['message'] = "Kongres sa uložil...";
		$insData['functions'] = array("fnc"=>"editKongres_fnc","value"=>$id);
		$insData['buttons'] = array("insert_new_kongres"=>"Uprav");
		$this->smarty->assign("admin",$_SESSION['abstrakter']['is_admin']);
		
		//$_SESSION['abstrakter']['selected_congress'] = $res['last_id'];
		//session_commit();
			
		$this->smarty->assign('data',$insData);
		$this->smarty->display('kongress.tpl');
				
		
	}
	
	public function deleteAbstr_fnc($id, $data)
	{
		$sql = sprintf("DELETE FROM [registration] WHERE [item_id] = %d",intval($id));
		if ($this->db->sql_execute($sql))
		{
			$result = $this->loginUser($_SESSION['abstrakter']['user_id']);
					
			$this->smarty->assign('data',$result);
			$this->smarty->assign('regbyuser',$this->getUserRegistrations($_SESSION['abstrakter']['user_id']));
			$this->smarty->assign('avab_kongres',$this->avabKongres());
			$this->smarty->assign("admin",$_SESSION['abstrakter']['is_admin']);
			
			$this->smarty->display("userdata.tpl");
		}
		
	}
	
	public function insertAbstr_fnc($id, $data)
	{
		//var_dump($data);
		//exit;
		$insData = array(
				"user_id"			=>$data['user_id'],
				"item_id"			=>$data['registr_id'],
				"congress_id"		=>$data['congress_id'],
				"participation"		=>$data['particip'],
				"section"			=>$data['section'],
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
			if (empty($insData['item_id']))
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
			$tmp['check_activ']="checked";
			
			$this->smarty->assign('data',$tmp);
			$this->smarty->display('abstraktreg.tpl');
		}
	}
	
	public function sendAbstractEmailInfo($data)
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
	
	public function regKongresForUser_fnc($kongres_id,$request)
	{
		$insData = array();
		
		$sql = sprintf("SELECT * FROM [kongressdata] WHERE [item_id] = %d ",intval($kongres_id));
		//$sql = sprintf("SELECT * FROM `kongressdata` ");
		$insData['congress'] = $this->db->sql_row($sql);
		$insData['congress']['user_id'] = $_SESSION['abstrakter']['user_id'];
		
		$insData['buttons'] = array("registration_submit"=>"Uložiť");
		$insData['functions'] = array("fnc"=>"insertAbstr_fnc","value"=>1);
		$insData['admin'] = $_SESSION['abstrakter']['is_admin'];
		$insData['check_activ']="checked";
		
		$this->smarty->assign("admin",$_SESSION['abstrakter']['is_admin']);
		
		$this->smarty->assign('data',$insData);
		$this->smarty->display('abstraktreg.tpl');
				
	}
	
	public function editAbstr_fnc($id,$request)
	{
		//var_dump($data);
		$sql = sprintf("SELECT
				[registration].[item_id] AS [registr_id], [kongressdata].[item_id] AS [congress_id],
				[registration].[user_id] AS [reg_user_id], [registration].[participation] AS [reg_participation],
				[registration].[abstract_titul] AS [reg_abstract_titul],  [registration].[abstract_main_autor] AS [reg_main_autor],
				[registration].[abstract_autori] AS [reg_abstract_autori], [registration].[abstract_adresy] AS [reg_abstract_adresy],
				[registration].[abstract_text] AS [reg_abstract_text],[kongressdata].[congress_titel] AS [congress_titel],
				[registration].[section] AS [section],
				[kongressdata].[congress_subtitel] AS [congress_subtitel],[kongressdata].[congress_venue] AS [congress_venue],
				[kongressdata].[congress_url] AS [congress_url], [kongressdata].[congress_from] AS [congress_from],
				[kongressdata].[congress_until] AS [congress_until],[kongressdata].[congress_reguntil] AS [congress_reguntil]
				FROM [registration]
				INNER JOIN [users] ON [users].[id] = [registration].[user_id]
				INNER JOIN [kongressdata] ON [kongressdata].[item_id] = [registration].[congress_id]
				WHERE [registration].[item_id] = %d
					
				",intval($id));
		
		$data = $this->db->sql_row($sql);
		
		//var_dump($data);
		
		
		$abstract = array(
				"user_id"			=>$data['reg_user_id'],
				"registr_id"		=>$data['registr_id'],
				"congress_id"		=>$data['congress_id'],
				"participation"		=>$data['reg_participation'],
				"section"			=>$data['section'],
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
		//exit;
	}
	
	public function getUserRegistrations($user_id)
	{
		$today = date("Y-m-d");
		$sql = sprintf("SELECT 
						[registration].[item_id] AS [registr_id], [kongressdata].[item_id] AS [kongr_id],
						[registration].[user_id] AS [reg_user_id], [registration].[participation] AS [reg_participation],
						[registration].[abstract_titul] AS [abstract_titul],  [registration].[abstract_main_autor] AS [reg_main_autor],
						[registration].[abstract_autori] AS [reg_abstract_autori], [registration].[abstract_adresy] AS [reg_abstract_adresy],
						[registration].[abstract_text] AS [reg_abstract_text],[kongressdata].[congress_titel] AS [congress_titel],
						[registration].[section] AS [section],
						[kongressdata].[congress_subtitel] AS [congress_subtitel],[kongressdata].[congress_venue] AS [congress_venue]
						
					FROM [registration]
							INNER JOIN [users] ON [users].[id] = [registration].[user_id]
							INNER JOIN [kongressdata] ON [kongressdata].[item_id] = [registration].[congress_id]
							WHERE [registration].[user_id] = %d
								AND [kongressdata].[congress_from] > '%s'	
		
							",$user_id,$today);
		
		$res = $this->db->sql_table($sql);
		//var_dump($res);
		return $res['table'];
	}
	

	
	public function getKongressByID($id)
	{
		$sql = sprintf("SELECT * FROM [kongressdata] WHERE [item_id] = '%s'", $id);
		$row =$this->db->sql_row($sql);
		$congress = array();
		foreach ($row  as $key=>$value)
		{
			$congress[$key]=$value;
		}
		$congress['user_id'] = $_SESSION['abstrakter']['user_id'];
		
		return $congress;
	}
	
	public function insertKongress($data)
	{
		//$this->logData($data,9999);
		
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
			$today = date("Y-m-d");
			$sql = sprintf("SELECT * FROM [kongressdata] WHERE [congress_from] > '%s'",$today);
			$table = $this->db->sql_table($sql);
			$insData['avakon'] = $table['table'];
			
			
			$_SESSION['abstrakter']['selected_congress'] = $res['last_id'];
			session_commit();
			
			$insData['functions'] = array("fnc"=>"editKongres_fnc","value"=>$res['last_id']);
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
	
	public function getRegisteredCVS_fnc($id,$data)
	{
		$sql = sprintf("SELECT 
						[kongressdata].[congress_titel] AS [kongres],
						[usersdata].[titul_pred] AS [titul_pred], [usersdata].[meno] AS [meno], [usersdata].[priezvisko] AS [priezvisko],
						[usersdata].[titul_za] AS [titul_za], [usersdata].[contact_email] AS [contact_email], [usersdata].[adresa] AS [adresa],
						[users].[email] AS [email2], 
						[registration].[participation] AS [ucast], [registration].[section] AS [sekcia],[registration].[abstract_titul] AS [nazov_prezentacie],
						[registration].[abstract_main_autor] AS [hlavny_autor], [registration].[abstract_autori] AS [spoluautori],
						[registration].[abstract_adresy] AS [adresy_pracoviska], [registration].[abstract_text] AS [text_abstraktu]
				FROM [registration]
							INNER JOIN [usersdata] ON [usersdata].[user_id] = [registration].[user_id]
							INNER JOIN [kongressdata] ON [kongressdata].[item_id] = [registration].[congress_id]
							INNER JOIN [users] ON [users].[id] = [registration].[user_id]
					WHERE [registration].[congress_id]=%d",intval($id));
		
		
		$table = $this->db->sql_table($sql);
		//$data = $table['table'];
		if ($table['status'] == false)
		{
			$this->smarty->assign('error',$table['error']);
			$this->smarty->display('error.tpl');
			exit;
		}
		
		$fileName = "./tmp/output_".time().".xls";
		
		if (count($table) == 0)
		{
			$this->EXml->setWorksheetTitle("Zoznam");
			$this->EXml->noData("Neobsahuje žiadne záznamy");
			$this->EXml->generateXML($fileName);
			
		}
		else
		{
			//var_dump($table['table']);
			//exit;
			$this->EXml->setWorksheetTitle("Zoznam");
			$this->EXml->addArray($table['table']);
			$this->EXml->generateXML($fileName);
		}
		
		//$fh= fopen($fileName,"r");
		//$str = fread($fh,filesize($fileName));
		//fclose($fh);
		header("Content-Description: File Transfer");
		header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
		$tmpFl = basename($fileName);
		header("Content-Disposition: attachment; filename={$tmpFl}");
		ob_clean();
		flush();
		readfile($fileName);
		//echo $str;
		
	}
	
	
	
	
		
	
}

?>