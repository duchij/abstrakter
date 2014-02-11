<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Abstrakter - Pridaj kongress</title>
</head>

<body>
	<h1>Pridaj kongress...</h1>
	<a href="app.php?addcon=1">Pridaj kongress..</a>
	
	<a href="app.php?logout=1">Logout</a>
	
	
	{$message}<br />
	<form method='post' action="app.php">
	<input type="hidden" name="inscongress" value="1">
		Názov kongresu: <input type="text" name="congress_titel" value="{$data.congress_titel}" style='width:500px'"><br />
		Podnázov: <input type="text" name="congress_subtitel" value="{$data.congress_subtitel}"  style='width:500px;'"><br />
		URL adresa: <input type="text" name="congress_url" value="{$data.congress_url}"><br />
		Venue: <input type="text" name="congress_venue" value="{$data.congress_venue}"><br />
		
		Kongress od: {html_select_date prefix='kondateOd_' start_year='2014' end_year='2020' time=$data.congress_from} <br />
		Kongress do: {html_select_date prefix='kondateDo_' start_year='2014' end_year='2020' time=$data.congress_until} <br />
		
		Registrácia od: {html_select_date prefix='dateOd_' start_year='2014' end_year='2020' time=$data.congress_regfrom} <br />
		Registrácia do: {html_select_date prefix='dateDo_' start_year='2014' end_year='2020' time=$data.congress_reguntil} <br />
		
		
		<input type="submit" value="Vloz">
	</form>
 	<h1> Dostupne aktivne kongresy</h1>
 	
 		{foreach from=$data.avakon key=i item=row}
 			
 			<form method="post" action="app.php">
 			{$row.congress_titel}, {$row.congress_venue}		
 				<!--<input type="hidden" name="editcon" value="{$row.item_id}">  -->
 				<button name="register" value="{$row.item_id}">Prihlas sa </button>
 				<button name="editcon" value="{$row.item_id}">Edituj kongress </button>
 				<!-- <a href="app.php?register={$row.item_id}">Prihlas sa....</a> -->
 				<!--<input type="submit" value="Edituj">  -->
 			</form>
 			
		{/foreach}
 	
 	
 	
 
 
</body>

</html>