<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/layout.css">
<meta charset="UTF-8">
<title>Abstrakter</title>
</head>

<body>
<div id="wrapper">
	<div id="header">
		{include file="header.tpl"}
	</div>
	<div id="content">
		
		<div id="content-main" style="width:250px;">
			<form method='post' action="index.php">
			<input type='hidden' name='login_fnc' value='1'>
				Email: <input type="text" name="email"><br>
				Heslo: <input type="password" name="password"><br>
				
				<input type="submit" value="Prihlás"><button name='register_fnc' value='1' >Vytvoriť nový účet</button> 
			</form> 
		</div>
		
		<div id="content-right" style="width:700px;">
		<h1>Aktuálne kongresy</h1><hr>
			 		{foreach from=$avab_kongres item=row}
			 			<h1>{$row.congress_title}</h1>
			 			{$row.congres_subtitle},{$row.congress_venue}<br>
			 			<em>{$row.congress_from|date_format:"%d.%m.%Y"} - {$row.congress_until|date_format:"%d.%m.%Y"}</em>
			 			<hr />
			 		{/foreach}
			 		
		</div>
	</div>
	<div id="footer">{include file="footer.tpl"}</div>
	<div id="bottom"></div>
		
</div>

</body>

</html>