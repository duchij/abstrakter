<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Abstrakter - User Data</title>
</head>

<body>
	<h1>Kontaktne údaje...</h1>
	<a href="app.php?addcon=1">Pridaj kongress..</a>
	<a href="app.php?logout=1">Logout</a>
	<h3>{$new_reg_msg}</h3>
	{$message}<br />
	<form method='post' action="app.php">
	<input type="hidden" name="insdat" value="1">
		Titul pred menom: <input type="text" name="titul_pred" value="{$titul_pred}"><br />
		Meno: <input type="text" name="meno" value="{$meno}"><br />
		Priezvisko: <input type="text" name="priezvisko" value="{$priezvisko}"><br />
		Titul za menom: <input type="text" name="titul_za" value="{$titul_za}"><br />
		Kontaktný email: <input type="text" name="contact_email" value="{$contact_email}" ><br />
		Adresa pracoviska: <textarea cols="100" rows="5" name="adresa">{$adresa}</textarea>
		<input type="submit" value="Vloz">
	</form>
 
</body>

</html>