<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Abstrakter - User Data</title>
</head>

<body>
	<h1>Kontaktn údaje...</h1>
	<h3>{$new_reg_msg}</h3>
	<form method='post' action="index.php?registration=1">
		Titul pred menom: <input type="text" name="titul_pred"><br />
		Meno: <input type="text" name="meno"><br />
		Priezvisko: <input type="text" name="priezvisko"><br />
		Titul za menom: <input type="text" name="titul_za"><br />
		email: <input type="text" name="" value="{$email}"><br />
		Adresa pracoviska: <textarea cols="100" rows="5" name="adresa"></textarea>
		<input type="submit" value="Vloz">
	</form>
 
</body>

</html>