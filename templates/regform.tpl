<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Abstrakter - Registration form</title>

</head>

<body>




<h1> Registrácia nového užívateľa do aplikácie ABSTRAKTER</h1>
<hr />
<form method='post' action="app.php">
	<input type="hidden" name="afterreg" value="1">
	Email: <input type="text" name="email"><br />
	Heslo: <input type="password" name="password"><br />
	Re-Heslo: <input type="password" name="password2">
	<input type="submit" value="Zaregistruj...">
</form> 
</body>

</html>