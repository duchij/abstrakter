<?php 
require_once 'smarty/Smarty.class.php';
require_once 'mysql.class.php';
require_once 'phpmailer/class.phpmailer.php';

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
		
		$this->mail = new PHPMailer();
		
		$this->smarty = new Smarty();
		$this->smarty->template_dir = './templates';
		$this->smarty->compile_dir = './templates/template_c';
		$this->smarty->cache_dir = './templates/cache';
		$this->smarty->config_dir = './templates/configs';
	}
	
	public function start()
	{
		//var_dump($_REQUEST);
		if (!$this->run_fnc($_REQUEST))
		{	
					
			$this->smarty->assign('avab_kongres',$this->avabKongres());
			$this->smarty->display('index.tpl');
		}
		/*else
		{
			$this->smarty->assign('avab_kongres',$this->avabKongres());
			$this->smarty->display('index.tpl');
		}*/
		
	}
	
	private function avabKongres()
	{
		$today = date("Y-m-d");
		$sql = sprintf("SELECT * FROM [kongressdata] WHERE [congress_from] >= '%s' ",$today);
		//$sql = sprintf("SELECT * FROM `kongressdata` ");
		return $this->db->sql_table($sql);
	}
	
	private function rp_fnc($id,$data)
	{
		$rp = addslashes($data['rp_fnc']);
		
		$sql = sprintf("SELECT * FROM [reset_passwd] WHERE [reset_link] = '%s' ",$rp);
		
		$res = $this->db->sql_row($sql);
		
		if (isset($res['item_id']))
		{
			$this->smarty->assign('email',$res['email']);
			$this->smarty->assign('user_id',$res['user_id']);
			$this->smarty->display('ch_passwd_form.tpl');
		}
		else
		{
			$this->smarty->assign('error','Neplatny link....');
			$this->smarty->display('error.tpl');
		}
	}
	
	private function changePasswdUser_fnc($id,$data)
	{
		if ($data['password'] != $data['password2'])
		{
			$this->smarty->assign('message',"Heslá nie sú rovnaké !!!!");
			$this->smarty->assign('email',$data['email']);
			$this->smarty->assign('user_id',$data['user_id']);
			
			$this->smarty->display('ch_passwd_form.tpl');
		}
		else
		{
			$passwd1 = hash('md5',$data['password']);
				
			
			$insData = array();
			$insData['email'] = $data['email'];
			$insData['password'] = $passwd1;
		
			$res = $this->db->insert_row("users",$insData);
		
			if ($res['status'])
			{
				$del = sprintf("DELETE FROM [reset_passwd] WHERE [email] = '%s'",$data['email']);
				$this->db->sql_execute($del);
				$sql = sprintf("
						SELECT *
							FROM [users]
						LEFT JOIN [usersdata] ON [usersdata].[user_id] = [users].[id]
							WHERE [users].[email] = '%s'
						",$data['email']);
	
				$result = $this->db->sql_row($sql);
		
				$_SESSION['abstrakter']['user_id'] = $data['user_id'];
				$_SESSION['abstrakter']['user_email'] = $data['email'];
				$_SESSION['abstrakter']['session_id'] = session_id();
				
				if ($result['account'] === 'admin')
				{
					$_SESSION['abstrakter']['is_admin'] = TRUE;
				}
		
				session_commit();
		
				header("location:app.php?run=1");
			}
		}
		
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
			else
			{
				$this->smarty->assign("error","Meno a heslo je nesprávne, alebo užívateľ neexistuje.....");
				$this->smarty->display("error.tpl");
				
			}
		}
		else
		{
			$this->smarty->assign("error","Toto nie je emailová adresa.....");
			$this->smarty->display("error.tpl");
		}
	}
	
	private function register_fnc($id,$data)
	{
			
		$this->smarty->display('reguser.tpl');
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
						
						
						$tmpRes = $this->sendMail($data['email']);
						
						if ($tmpRes['status'] == FALSE)
						{
							$this->smarty->assign('error',$this->mail->ErrorInfo);
							$this->smarty->display('error.tpl');
							exit;
						}
						
						session_commit();
						
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
				$this->smarty->assign('error',"Užívateľ je už zaregistrovaný...");
				$this->smarty->display('error.tpl');
			}
		}
		else 
		{
			$this->smarty->assign("error","Toto nie je valídna emailová adresa..");
			$this->smarty->display('error.tpl');
		}
				
	}
	
	function resetExistPasswd_fnc($id,$data)
	{
		if (filter_var($data['email'], FILTER_VALIDATE_EMAIL) == FALSE)
		{
			$this->smarty->assign('error','Toto nie je emailová adresa...');
			$this->smarty->display('error.tpl');
			exit;
		}
		
		$sql = sprintf("SELECT 	
								[users].[id] AS [user_id], [users].[email] AS [user_email],
								[usersdata].[meno] AS [meno], [usersdata].[priezvisko] AS [priezvisko],
								[usersdata].[contact_email] AS [contact_email]
							FROM [users] 
						INNER JOIN [usersdata] ON [usersdata].[user_id] = [users].[id]
						WHERE [users].[email] = '%s'",$data['email']);
		
		$res = $this->db->sql_row($sql);
		
		if(!isset($res['user_id']))
		{
			$this->smarty->assign('error','Takáto emailová adresa nie je zaregistrovaná...');
			$this->smarty->display('error.tpl');
			exit;
		}
		else
		{
			$valid_from = time();
			$valid_until = time()+(1*24*60*60);
			
			$hash_link = hash('sha1',"{$data['email']}-{$valid_from}");
			
			$insData = array(
						"email"=>$data['email'],
						"reset_link"=>$hash_link,
						"valid_from"=>$valid_from,
						"valid_until"=>$valid_until
					);
			
			$this->db->insert_row('reset_passwd',$insData);

			$emailData = array(
						"email"=>$data['email'],
						"reset_link" => $hash_link,
						"meno"=>$res['meno'],
						"priezvisko"=>$res['priezvisko']
					);
			
			$tmp = $this->sendMailMsg($emailData);
			if ($tmp['status'] == FALSE)
			{
				$this->smarty->assign('error',$tmp['message']);
				$this->smarty->display('error.tpl');
				exit;
			}
			else
			{
				$this->smarty->assign("message","Na uvedený mail ste obdržali link na resetovanie Vášho hesla");
				$this->smarty->display('message.tpl');
				exit;
			}
			//var_dump($res);
		}
	}
	
	private function sendMailMsg($data)
	{
		$subject = "Reset hesla na pristup do abstrakter.detska-chirurgia.sk";
		$this->smarty->assign("data",$data);
		
		$message = $this->smarty->fetch("emails/resetpasswd.tpl");
		
		$this->mail->isSMTP();                                      // Set mailer to use SMTP
		$this->mail->Host = 'mail.detska-chirurgia.sk';  	// Specify main and backup server
		$this->mail->Port = 25;
		$this->mail->SMTPAuth = true;                               // Enable SMTP authentication
		$this->mail->Username = 'info@detska-chirurgia.sk';                            // SMTP username
		$this->mail->Password = 'InfoPassword';                           // SMTP password
		//$this->mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
		
		$this->mail->From = 'Info@detska-chirurgia.sk';
		$this->mail->FromName = 'detska-chirurgia.sk';
		//$this->mail->addAddress('josh@example.net', 'Josh Adams');  // Add a recipient
		$this->mail->addAddress($data['email']);               // Name is optional
		$this->mail->addReplyTo('info@detska-chirurgia.sk', 'Detska chirurgia Slovenska');
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
	
	
	private function reset_fnc($id,$data)
	{
		$this->smarty->display('resetpas.tpl');
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
		$subject = "Informacia o uspesnej registracii do aplikacie Abstrakter na webe detska-chirurgia.sk";
		
		$message = $this->smarty->fetch("emails/newuser_html_mail.tpl");
		
		$this->mail->isSMTP();                                      // Set mailer to use SMTP
		$this->mail->Host = 'mail.detska-chirurgia.sk';  	// Specify main and backup server
		$this->mail->Port = 25;
		$this->mail->SMTPAuth = true;                               // Enable SMTP authentication
		$this->mail->Username = 'trauma@detska-chirurgia.sk';                            // SMTP username
		$this->mail->Password = 'TraumaPassword';                           // SMTP password
		//$this->mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
		
		$this->mail->From = 'trauma@detska-chirurgia.sk';
		$this->mail->FromName = 'trauma@detska-chirurgia.sk';
		//$this->mail->addAddress('josh@example.net', 'Josh Adams');  // Add a recipient
		$this->mail->addAddress($email);               // Name is optional
		$this->mail->addReplyTo('trauma@detska-chirurgia.sk', 'Trauma v detskom veku');
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
		
		//$this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		
// 		$headers = 'From: trauma@detska-chirurgia.sk'."\r\n";
// 		$headers .= 'MIME-Version: 1.0'."\r\n";
// 		$headers .= 'Content-Type: text/html; charset=utf-8'."\r\n";
		
		
		
		//$to = $email;
					
		
		
		//return mail($to,$subject,$message,$headers);
		
	}
	
}


?>