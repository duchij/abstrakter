<h1> Dostupne aktivne kongresy</h1>
 	
 		{foreach from=$avab_kongres key=i item=row}
 			
 			<form method="post" action="app.php">
 			{$row.congress_titel}, {$row.congress_venue}		
 				
 				<button name="regKongresForUser_fnc" value="{$row.item_id}">Prihl‡sié sa... </button>
 				
 			</form>
 			
		{/foreach}