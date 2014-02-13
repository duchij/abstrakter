<h1> Vaše aktuálne zahlasené abstrakty</h1>
 
	{foreach from=$regbyuser item=reg_row}
	
	<strong>{$reg_row.abstract_titul}</strong><br />,{$reg_row.congress_titel}, {$reg_row.congress_venue}<br />
	<form method="post" action="app.php">  
		<button name="editAbstr_fnc" value="{$reg_row.registr_id}">Edituj</button>
		</form>
		<button  onClick="deleteConfirm('deleteAbstr_fnc;{$reg_row.registr_id}')" >Zmaž</button>
		
		<hr />
	
	{/foreach}
