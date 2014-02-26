<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/layout.css">
<meta charset="UTF-8">
<title>Abstrakter - User Data</title>
</head>
<script src="js/abstracter.js"></script>
<body>

<div id="wrapper">
	<div id="header">
		{include file="header.tpl"}
		
	</div>
	
	<div id="content">
		<div id="content-left">
		<ul>
		{if $admin}
			<li><a href="app.php?addcon=1">Kongresy</a></li>
			<li><a href="app.php?fform_fnc=1">FORM Designer</a></li>
		{/if}
			<li><a href="app.php?logout=1">Odhlásiť sa</a></li>
			</ul>
		</div>
		<div id="content-main">
		
		<h1>Kontaktne údaje...</h1>
		{$data.message}
				<form method='post' action="app.php">
				<input type="hidden" name="insUserData_fnc" value="1">
				<table>
					
					<tr> 
					<td width="200px" valign="top">Titul pred menom: </td>
					
					<td><input type="text" name="titul_pred" value="{$data.titul_pred}"  style="width:400px;"></td>
					
					</tr>
					
					<tr><td width="200px" valign="top">Meno:</td> <td><input type="text" name="meno" value="{$data.meno}" style="width:400px;"></td></tr>
					<tr><td width="200px" valign="top">Priezvisko:</td> <td><input type="text" name="priezvisko" value="{$data.priezvisko}"  style="width:400px;"></td></tr>
					<tr><td width="200px" valign="top">Titul za menom:</td> <td> <input type="text" name="titul_za" value="{$data.titul_za}"  style="width:400px;"></td></tr>
					<tr><td width="200px" valign="top">Kontaktný email:</td> <td> <input type="text" name="contact_email" value="{$data.contact_email}"  style="width:400px;"></td></tr>
					<tr><td width="200px" valign="top">Adresa pracoviska:</td> <td> <textarea rows="10" name="adresa" style="width:400px;" >{$data.adresa}</textarea></td></tr>
					<tr><td colspan="2"><input type="submit" value="Ulož"></td></tr>
								
			
		</table>
		</form>
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