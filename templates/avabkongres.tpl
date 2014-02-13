<h1> Dostupné aktívne kongresy</h1>
 	<form method="post" action="app.php">
 	
 		{foreach from=$avab_kongres key=i item=row}
 		<p>
 			<strong>{$row.congress_titel}</strong>, {$row.congress_venue}<br>
 			<em>{$row.congress_from|date_format:"%d.%m.%Y"} - {$row.congress_until|date_format:"%d.%m.%Y"}</em><br>
 			<button name="regKongresForUser_fnc" value="{$row.item_id}">Prihlásiť sa... </button>
 		</p>	
 			
 			
		{/foreach}
		</form>