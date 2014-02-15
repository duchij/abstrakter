<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css/layout.css">
<meta charset="UTF-8">
<title>Abstrakter - Registration form</title>

</head>

<body>
<div id="wrapper">
	<div id="header">
		{include file="header.tpl"}
	</div>
	
	<div id="content">
		
			<div id="content-main" style="width:900px;">
				<h1> Registrácia nového užívateľa do aplikácie ABSTRAKTER</h1>
				<hr />
				<form method='post' action="index.php">
					<input type="hidden" name="registerNewUser_fnc" value="1">
					<table>
						<tr><td>Email:</td><td> <input type="text" name="email"></td></tr>
						<tr><td>Heslo: </td><td> <input type="password" name="password"></td></tr>
						<tr><td>Re-Heslo:</td><td>  <input type="password" name="password2"></td></tr>
						<tr><td colspan="2"><input type="submit" value="Zaregistruj..."></td></tr>
						
					</table>
				</form> 
			</div>
	</div>
	<div id="footer">{include file="footer.tpl"}</div>
	<div id="bottom"></div>
</div>
</body>

</html>