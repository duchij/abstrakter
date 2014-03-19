<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css/layout.css">

<meta charset="UTF-8">
<title>Abstrakter - Pridaj kongress</title>
<script src="js/abstracter.js"></script>

</head>
<body>
<div id="wrapper">
		<div id="header">
			{include file="header.tpl"}
			<h3>{$new_reg_msg}</h3>
			
		</div>

<div id="content">
		<div id="content-left">
			{include file="main_menu.tpl"}
		</div>
	<div id="content-main" style="width:750px;">
			<h1 class="logo">Prihlásenie na kongres</h1>
			<hr />
			<h1>{$data.congress.congress_titel} </h1>
			<h2>{$data.congress.congress_subtitel}</h2>
			<a href="{$data.congress.congress_url}" target="_blank">Web stránka...</a><br><br>
			{$data.congress.congress_venue}<br><br>
			{$data.congress.congress_from|date_format:"%d.%m.%Y"} - {$data.congress.congress_until|date_format:"%d.%m.%Y"}<br><br>
			{$data.message}<hr />
			
			<form name="form1" method='post' action="app.php">
			
			
				<input type="hidden" name="{$data.functions.fnc}" value="{$data.functions.value}">
				<input type="hidden" name="congress_id" value="{$data.congress.item_id}">
				<input type="hidden" name="user_id" value="{$data.congress.user_id}">
				<input type="hidden" name="registr_id" value="{$data.abstract.registr_id}">
				<table>
				<tr><td> Aktívna účasť (autor)</td><td> <input id="aktiv_rb" type="radio" name="particip" value="aktiv"  onClick="test('1');" {$data.state}></td></tr>
				<tr><td>	Pasívna účasť (spoluautor)  </td><td>  <input id="pasiv_rb" type="radio" name="particip" value ="pasiv"  onClick="test('0');"  {$data.state}></td></tr>
				<tr><td>	Pasívna účasť (návštevník)</td><td> 	<input id="visit_rb" type="radio" name="particip"  value ="visit"  onClick="test('0');"  {$data.state}></td></tr>
				</table>
				
				<div id="block" style="border:none;padding:0px;margin:0px">
				<table>
				<!--  <tr><td> <input id="doctor_rb" type="radio" name="section" value="doctor" checked> - Lekárska sekcia</td> <td><input id="nurse_rb" type="radio" name="section" value="nurse" > - Sesterská sekcia</td></tr>--> 
				
				</table>
				
				<table>
					<tr><td width="150px" valign="top">Názov prednášky:</td><td>  <input type="text" name="abstract_titul" value="{$data.abstract.abstract_titul}" style='width:600px;' {$data.state}></td></tr>
					<tr><td width="150px" valign="top">Názov pracoviska:</td><td>  <input type="text" name="abstract_adresy" value="{$data.abstract.abstract_adresy}"  style='width:600px;' {$data.state}></td></tr>
					<tr><td width="150px" valign="top">Prvý autor:</td><td>  <input type="text" name="abstract_main_autor" value="{$data.abstract.abstract_main_autor}" style='width:600px;' {$data.state}></td></tr>
					<tr><td width="150px" valign="top">Ostatní autori:</td><td>  <input type="text" name="abstract_autori" value="{$data.abstract.abstract_autori}"  style='width:600px;' {$data.state}></td></tr>
					
					
				
					<!--  <tr><td width="150px" valign="top">Neclen SKSa:</td><td>  <input type="text" name="skskapa_num" value="{$data.abstract.skskapa_num}"  style='width:600px;' {$data.state}></td></tr>-->
					
					<!--  <tr><td width="150px" valign="top">Abstrakt:</td><td> <textarea name="abstract_text" rows="20"   style='width:600px;' {$data.state}>{$data.abstract.abstract_text}</textarea> </td></tr>-->
					
				
				
			</table>
			</div>
			<table>
			<tr><td width="150px" valign="top">Registračné čislo SKSaPA (ak niečlen nechať prázdne):</td><td>  <input type="text" name="abstract_text" value="{$data.abstract.abstract_text}"  style='width:600px;' {$data.state}></td></tr>
			</table>
			{if $data.state != 'readonly'}
					<input type="submit" value="{$data.buttons.registration_submit}">
				{/if}
	</form>
	<font style="color:green;">{$message}</font><br />
	</div>
	<!-- <div id="content-right">
			 {include file="regbyuser.tpl"}<hr/>
 			{include file="avabkongres.tpl"}
		
		</div> -->
	</div>
	<div id="footer">{include file="footer.tpl"}</div>
	<div id="bottom"></div>
	
</div>
{if $data.abstract.participation == 'aktiv'}
	{literal}
	<script>
		test('1');
		setRadioButtons('aktiv');
	</script>
	{/literal}
{elseif $data.abstract.participation == 'pasiv' }
{literal}
	<script>
		test('0');
		setRadioButtons('pasiv');
	</script>
	{/literal}
{elseif $data.abstract.participation == 'visit'}
	{literal}
	<script>
		test('0');
		setRadioButtons('visit');
	</script>
	{/literal}
{else}
	{literal}
	<script>
		test('1');
		setRadioButtons('aktiv');
	</script>
	{/literal}	
	
{/if}

{if $data.abstract.section === 'doctor'}
	{literal}
	<script>
		setSectionRadios('doctor');
	</script>
	{/literal}
{/if}

{if $data.abstract.section === 'nurse'}
	{literal}
	<script>
		setSectionRadios('nurse');
	</script>
	{/literal}
{/if}

{if $data.abstract.section === 'other'}
	{literal}
	<script>
		setSectionRadios('other');
	</script>
	{/literal}
{/if}

</body>

</html>