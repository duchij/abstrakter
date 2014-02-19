<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css/layout.css">

<meta charset="UTF-8">
<title>Abstrakter - Pridaj kongress</title>


</head>
<script src="js/abstracter.js"></script>
<body>
lol {$checkactiv}
{$data|@var_dump}
{assign name="pokus" value="checked"}
{$checkactiv|@var_dump}
<div id="wrapper">
		<div id="header">
			{include file="header.tpl"}
			<h3>{$new_reg_msg}</h3>
			{$message}<br />
		</div>

<div id="content">
		<div id="content-left">
		<ul>
			<li><a href="app.php?run=1">Domov...</a></li>
			{if $data.admin}
			<li><a href="app.php?addcon=1">Kongress..</a></li>
			{/if}
			<li><a href="app.php?logout=1">Odhlasiť sa</a></li>
		</ul>
		</div>
	<div id="content-main" style="width:750px;">
			<h1 class="logo">Prihlásenie na kongres</h1>
			<hr />
			<h2>{$data.congress.congress_titel} </h2>
			{$data.congress.congress_subtitel}<br>
			<a href="{$data.congress.congress_url}" target="_blank">Web stranka...</a><br>
			{$data.congress.congress_venue}<br>
			{$data.congress.congress_from|date_format:"%d.%m.%Y"} - {$data.congress.congress_until|date_format:"%d.%m.%Y"}<br>
			{$data.message}<hr />
			
			<form method='post' action="app.php">
			
			
				<input type="hidden" name="{$data.functions.fnc}" value="{$data.functions.value}">
				<input type="hidden" name="congress_id" value="{$data.congress.item_id}">
				<input type="hidden" name="user_id" value="{$data.congress.user_id}">
				<input type="hidden" name="registr_id" value="{$data.abstract.registr_id}">
				<table>
				<tr><td> Aktívna účasť (autor)</td><td> <input type="radio" name="particip" value="aktiv"  {$data.check_activ} onClick="test('1');" {$data.state}></td></tr>
				<tr><td>	Pasívna účasť (spoluautor) </td><td>  <input type="radio" name="particip" value ="pasiv" {$data.check_pasiv} onClick="test('0');"  {$data.state}></td></tr>
				<tr><td>	Pasívna účasť (návštevník)</td><td> 	<input type="radio" name="particip"  value ="visit" {$data.check_visit} onClick="test('0');"  {$data.state}></td></tr>
				</table>
				
				<div id="block" style="border:none;padding:0px;margin:0px">
				<table>
				<tr><td> <input type="radio" name="section" value="doctor"> - Lekárska sekcia</td> <td><input type="radio" name="section" value="nurse" > - Sesterská sekcia</td></tr> 
				
				</table>
				
				<table>
					<tr><td width="150px" valign="top">Názov prednášky:</td><td>  <input type="text" name="abstract_titul" value="{$data.abstract.abstract_titul}" style='width:600px;' {$data.state}></td></tr>
					<tr><td width="150px" valign="top">Názov pracoviska:</td><td>  <input type="text" name="abstract_adresy" value="{$data.abstract.abstract_adresy}"  style='width:600px;' {$data.state}></td></tr>
					<tr><td width="150px" valign="top">Prvý autor:</td><td>  <input type="text" name="abstract_main_autor" value="{$data.abstract.abstract_main_autor}" style='width:600px;' {$data.state}></td></tr>
					<tr><td width="150px" valign="top">Ostatný autori:</td><td>  <input type="text" name="abstract_autori" value="{$data.abstract.abstract_autori}"  style='width:600px;' {$data.state}></td></tr>
					
					<tr><td width="150px" valign="top">Abstrakt:</td><td> <textarea name="abstract_text" rows="20"   style='width:600px;' {$data.state}>{$data.abstract.abstract_text}</textarea> </td></tr>
					
				
				
			</table>
			</div>
			{if $data.state != 'readonly'}
					<input type="submit" value="{$data.buttons.registration_submit}">
				{/if}
	</form>
	</div>
	<!-- <div id="content-right">
			 {include file="regbyuser.tpl"}<hr/>
 			{include file="avabkongres.tpl"}
		
		</div> -->
	</div>
	<div id="footer">{include file="footer.tpl"}</div>
	<div id="bottom"></div>
	
</div>
</body>

</html>