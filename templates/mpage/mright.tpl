<h1> Dostupné kongresy</h1>
		 		<hr/>
		 			<form method="post" action="app.php">
		 			{foreach from=$data.avakon key=i item=row}	 			
		 					<p>
		 					<strong>{$row.congress_titel}</strong><br />
		 					{$row.congress_venue}, <em>{$row.congress_from|date_format:"%d.%m.%Y"} - {$row.congress_until|date_format:"%d.%m.%Y"}</em><br />	
		 				
		 					<button name="register" value="{$row.item_id}">Prihlásiť</button>
		 					<button name="editcon" value="{$row.item_id}">Upraviť</button>
		 					<button name="getRegisteredCVS_fnc" value="{$row.item_id}">Export Excel</button>
		 					</p>
		 			{/foreach}
				</form>