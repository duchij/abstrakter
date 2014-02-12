<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/layout.css">
<meta charset="UTF-8">
<title>Abstrakter - User Data</title>
</head>

<body>

<div id="wrapper">
	<div id="header">
		{include file="header.tpl"}
		<h3>{$new_reg_msg}</h3>
		{$message}<br />
	</div>
	
	<div id="content">
		<div id="content-left">
			<li><a href="app.php?addcon=1">Pridaj kongress..</a></li>
			<li><a href="app.php?logout=1">Logout</a></li>
		
		</div>
		<div id="content-main">
		<h1>Kontaktne údaje...</h1>
				<form method='post' action="app.php">
				<table width="auto">
					<input type="hidden" name="insdat" value="1">
					<tr> 
					<td width="200px" valign="top">Titul pred menom: </td>
					
					<td><input type="text" name="titul_pred" value="{$titul_pred}"  style="width:400px;"></td>
					
					</tr>
					
					<tr><td width="200px" valign="top">Meno:</td> <td><input type="text" name="meno" value="{$meno}" style="width:400px;"></td></tr>
					<tr><td width="200px" valign="top">Priezvisko:</td> <td><input type="text" name="priezvisko" value="{$priezvisko}"  style="width:400px;"></td></tr>
					<tr><td width="200px" valign="top">Titul za menom:</td> <td> <input type="text" name="titul_za" value="{$titul_za}"  style="width:400px;"></td></tr>
					<tr><td width="200px" valign="top">Kontaktný email:</td> <td> <input type="text" name="contact_email" value="{$contact_email}"  style="width:400px;"></td></tr>
					<tr><td width="200px" valign="top">Adresa pracoviska:</td> <td> <textarea rows="10" name="adresa" style="width:400px;" >{$adresa}</textarea></td></tr>
					<tr><td colspan="2"><input type="submit" value="Vloz"></td></tr>
								
			</form>
		</table>
		</div>
		<div id="content-right">
			 {include file="regbyuser.tpl"}<hr/>
 			{include file="avabkongres.tpl"}
		
		</div>
	</div>
	<div id="footer">{include file="footer.tpl"}</div>
	<div id="bottom"></div>
</div>

	
	
	
	
	

</body>

</html>