<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Abstrakter - Pridaj kongress</title>
<script language="javascript">
{literal}

function test(st)
{
	//alert(st);
	var block = document.getElementById("block");
	if (st === '0')
	{
		block.style.visibility = "hidden";
	}
	else
	{
		block.style.visibility = "visible";
	}
}

{/literal}
</script>

</head>

<body>
	<h1>Prihlásenie na kongres</h1>
	<hr />
	<h2>{$data.congress.congress_titel} </h2>
	<h3>{$data.congress.congress_subtitel}</h3>
	<a href="{$data.congress.congress_url}" target="_blank">Web stranka...</a>
	<h3>{$data.congress.congress_venue}</h3>
	<h4>{$data.congress.congress_from|date_format:"%d.%m.%Y"} - {$data.congress.congress_until|date_format:"%d.%m.%Y"}</h4>
	<a href="app.php?addcon=1">Pridaj kongress..</a>
	
	<a href="app.php?logout=1">Logout</a>
	
	{$data.message}<br />
	<form method='post' action="app.php">
	
	<input type="hidden" name="regabstr" value="1">
	<input type="hidden" name="congress_id" value="{$data.congress.item_id}">
	<input type="hidden" name="user_id" value="{$data.congress.user_id}">
		Aktívna účasť (autor) <input type="radio" name="particip" value="aktiv" onClick="test('1');" checked><br/>
		Pasívna účasť (spoluautor)  <input type="radio" name="particip" value ="pasiv" onClick="test('0');"><br/>
		Pasívna účasť (návštevník)	<input type="radio" name="particip"  value ="visit" onClick="test('0');"><br/>
	<div id="block">
		Názov prednášky: <input type="text" name="abstract_titul" value="{$data.abstract.abstract_titul}" style='width:500px;'><br />
		Názov pracoviska: <input type="text" name="abstract_adresy" value="{$data.abstract.abstract_adresy}"  style='width:500px;'><br />
		Prvý autor: <input type="text" name="abstract_main_autor" value="{$data.abstract.abstract_main_autor}"><br />
		Ostatný autori: <input type="text" name="abstract_autori" value="{$data.abstract.abstract_autori}"><br />
		
		Abstrakt:<textarea name="abstract_text" cols="100" rows="20">{$data.abstract.abstract_text}</textarea> <br />
		
	</div>
		<input type="submit" value="Prihlásiť sa....">
	</form>
</body>

</html>