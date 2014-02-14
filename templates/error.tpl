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
			<!--  <form method='post' action="index.php">
			<input type='hidden' name='login_fnc' value='1'>
				Email: <input type="text" name="email"><br>
				Heslo: <input type="password" name="password"><br>
				
				<input type="submit" value="Prihlás"><button name='register_fnc' value='1' >Vytvoriť nový účet</button> 
			</form> -->
		</div>
		
		<div id="content-right" style="width:700px;">
		<h1 style="color:red;">Chyba....</h1>
		{$error}<br>
		Naspäť na <a href="index.php">login....</a>
			 		
		</div>
	</div>
	<div id="footer">{include file="footer.tpl"}</div>
	<div id="bottom"></div>
		
</div>

</body>

</html>