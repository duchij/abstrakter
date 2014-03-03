<?php 
//session_start();

require_once 'formdes.class.php';
require_once './smarty/Smarty.class.php';
require_once 'mysql.class.php';
require_once './phpmailer/class.phpmailer.php';
require_once 'xml.class.php';


class app {
	
	var $includeDir = "./include";
	var $iniDir = "./local_settings";
	var $user_id;
	var $user_email;
	
	var $db;
	var $smarty;
	
	//var $formdes;
	
	
	public function __construct()
	{
	
		$this->user_id = $_SESSION['abstrakter']['user_id'];
		$this->EXml = new Excel_XML();
		$this->mail = new PHPMailer();
		$this->smarty = new Smarty;
		
		$this->forms = new FormDes();
	
		$this->smarty->template_dir = './templates';
		$this->smarty->compile_dir = './templates/template_c';
		$this->smarty->cache_dir = './templates/cache';
		$this->smarty->config_dir = './templates/configs';
	
		$this->db = new db(new mysqli($_SESSION['abstrakter']['server'],$_SESSION['abstrakter']['user'], $_SESSION['abstrakter']['password'],$_SESSION['abstrakter']['db']));
	}
	
	public function loginUser($id)
	{
		$sql = sprintf("
				SELECT * FROM [usersdata]
				LEFT JOIN [users] ON [usersdata].[user_id] = [users].[id]
				WHERE [users].[id] = %d"
				,intval($id));
		return $this->db->sql_row($sql);
	
	}
	
	
	function logData($what,$debug)
	{
		$datum  = date("dmY");
		$fp = fopen("./log/{$datum}.log","a+");
		
		$str = date("d.m.Y H.i.s")."..........>{$debug} \r\n";
		$str .= var_export($what,true);
		
		fwrite($fp,$str);
		fclose($fp);
		
		
	}
		
	public function run_app($request,$caller)
	{
		//var_dump($caller);
	
		$result = false;
		foreach ($request as $key=>$value)
		{
			if (strpos($key,"_fnc") !== false)
			{
				$fnc = str_replace(array("_fnc_x","_fnc_y"),"_fnc",$key);
				//var_dump($caller);
				$result = true;
				$caller->$fnc($value,$request);
				//break;
			}
		}
		return $result;
	}
	
	
	function sendMailMsg($data)
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