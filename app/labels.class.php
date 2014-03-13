<?php
class Labels {
	
	function __construct()
	{
		
	}
	
	function getLabels()
	{
		$labels = array();
		
		$labels['sendmail'] = array(
										"new_user_subject_mail"=>"Informacia o uspesnej registracii do aplikacie Abstrakter",
										"password_reset"=>"Reset hesla na pristup do aplikacie Abstrakter",
				
				);
		
		$labels['web_data'] = array(
										"web_title"=>"Abstrakter v1.0",
										"web_subtitle"=>"Registrácie na vzdelávacie aktivity, kongresy a pod",
				
				);
		
		$labels['footer'] = array(
									"app_title"=>"Asbtrakter v 1.0.",
									"footer_text"=>"Registrácie na vzdelácie akcie, kongresy a pod....",
				
				);
		
		return $labels;
		
	}
	
}