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
			<table>
				<tr><td>Email:</td><td> <input type="text" name="email"></td></tr>
				<tr><td>Heslo:</td><td> <input type="password" name="password"></td></tr>
				
			
			<tr><td colspan="2"><button formaction="index.php?login_fnc=1" type="submit">Prihlás</button> 
			<button formaction="index.php?register_fnc=1"  >Vytvoriť nový účet</button>
			<button formaction="index.php?reset_fnc=1">Zabudnuté heslo?</button></td></tr>	
			</table>
			</form> 
			
		</div>
		 
		<div id="content-right" style="width:700px;">
		<h1>Aktuálne kongresy</h1><hr>
			 		{foreach from=$avab_kongres item=row key=i}
			 			<strong>{$row.congress_titel}</strong><br>
			 			{$row.congress_subtitel},{$row.congress_venue}<br>
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