<h1> Vaše aktuálne zahlasené abstrakty</h1>
<form method="post" action="app.php">   
	{foreach from=$regbyuser item=reg_row}
	
	<strong>{$reg_row.abstract_titul}</strong><br />,{$reg_row.congress_titel}, {$reg_row.congress_venue}<br />
	
		<button name="editAbstr_fnc" value="{$reg_row.registr_id}">Edituj</button>
		
		<button name="deleteAbstr_fnc" value="{$reg_row.congress_id}" >Zmaž</button>
		<hr />
	
	{/foreach}
</form>