<h1 class="red">Kongresy</h1>
{$links}
{*$avab_kongress|@var_dump*}
 	<form method="post" action="app.php">
 	
 		{foreach from=$avab_kongress key=i item=row}
 		<p>
 			<h3>{$row.congress_titel}</h3> {$row.congress_venue}<br><br>
 			<em>{$row.congress_from|date_format:"%d.%m.%Y"} - {$row.congress_until|date_format:"%d.%m.%Y"}</em><br>
 			<button name="regKongresForUser_fnc" value="{$row.item_id}">Prihlásiť sa... </button>
 		</p>	
 			
 			
		{/foreach}
		</form>