<h1> Vaše aktuálne zahlasené abstrakty</h1>
 
	{foreach from=$regbyuser item=reg_row}
	
	
	{if $reg_row.abstract_titul|count_characters == 0}
		{if $reg_row.reg_participation == 'aktiv'}
			<strong>Aktívna účasť</strong>
		{/if}
		
		{if $reg_row.reg_participation == 'pasiv'}
			<strong>Pasívna úcasť</strong>
		{/if}
		
		{if $reg_row.reg_participation == 'visit'}
			<strong>Navštevník</strong>
		{/if}
		
	{else}
	<strong>Aktívna účasť</strong> - 
	<em>{$reg_row.abstract_titul}</em>
	{/if}
	<br />,{$reg_row.congress_titel}, {$reg_row.congress_venue}<br />
	<p>
	<form name ="regabstrform" method="post" action="app.php"> 
		<button name="editAbstr_fnc" value="{$reg_row.registr_id}">Edituj</button>
	
	</form>
	<button  onClick="deleteConfirm('deleteAbstr_fnc;{$reg_row.registr_id}')" >Zmaž</button>
	</p>
		<hr />
	
	{/foreach}
