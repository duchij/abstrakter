<h1> Vaše aktuálne zahlasené abstrakty</h1>
<hr>
 
	{foreach from=$regbyuser item=reg_row}
	
	
	{if $reg_row.abstract_titul|count_characters == 0}
		{if $reg_row.reg_participation == 'aktiv'}
			<h3>Aktívna účasť</h3>
		{/if}
		
		{if $reg_row.reg_participation == 'pasiv'}
			<h3>Pasívna úcasť</h3>
		{/if}
		
		{if $reg_row.reg_participation == 'visit'}
			<h3>Navštevník</h3>
		{/if}
		
	{else}
	<h3>Aktívna účasť</h3> 
	<h2>{$reg_row.abstract_titul}</h2>
	{/if}
	<strong>{$reg_row.congress_titel}</strong><br> {$reg_row.congress_venue}<br />
	<p>
	<form name ="regabstrform" method="post" action="app.php"> 
		<button name="editAbstr_fnc" value="{$reg_row.registr_id}">Edituj</button>
	
	</form>
	<button  onClick="deleteConfirm('deleteAbstr_fnc;{$reg_row.registr_id}')" >Zmaž</button>
	</p>
		<hr />
	
	{/foreach}
