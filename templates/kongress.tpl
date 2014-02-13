<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/layout.css">
<meta charset="UTF-8">
<title>Abstrakter - Pridaj kongress</title>
</head>

<body>
<div id="wrapper">

	<div id="header">{include file="header.tpl"}
		
	</div>
	
		<div id="content">
			<div id="content-left">
			<ul>
				<li><a href="app.php?run=1">Domov...</a></li>
				<li><a href="app.php?addcon=1">Kongresy</a></li>
				<li><a href="app.php?logout=1">Odhlásiť sa</a></li>
			</ul>
			</div>
		
		<div id="content-main">
		{$data.message}
		
				<h1>Akcia / Seminár / Konferencia / Kongress...</h1>
				<form method='post' action="app.php">
				<input type="hidden" name="{$data.functions.fnc}" value="{$data.functions.value}">
				<table width="100%">
					<tr><td>Názov kongresu:</td><td> <input type="text" name="congress_titel" value="{$data.congress_titel}" style='width:400px'></td></tr>
					<tr><td>Podnázov:</td><td> <input type="text" name="congress_subtitel" value="{$data.congress_subtitel}"  style='width:400px;'></td></tr>
					<tr><td>URL adresa:</td><td> <input type="text" name="congress_url" value="{$data.congress_url}" style='width:400px;'></td></tr>
					<tr><td>Venue: </td><td><input type="text" name="congress_venue" value="{$data.congress_venue}" style='width:400px;'></td></tr>
					<tr><td colspan="2"><hr></td>
					<tr><td>Kongress od:</td><td> {html_select_date prefix='kondateOd_' start_year='2014' end_year='2020' time=$data.congress_from}</td></tr>
					<tr><td>Kongress do:</td><td> {html_select_date prefix='kondateDo_' start_year='2014' end_year='2020' time=$data.congress_until} </td></tr>
					<tr><td colspan="2"><hr></td>
					<tr><td>Registrácia od:</td><td> {html_select_date prefix='dateOd_' start_year='2014' end_year='2020' time=$data.congress_regfrom}</td></tr>
					<tr><td>Registrácia do:</td><td> {html_select_date prefix='dateDo_' start_year='2014' end_year='2020' time=$data.congress_reguntil}</td></tr>
					
					
					<tr><td colspan="2"><input type="submit" value="{$data.buttons.insert_new_kongres}"></td></tr>
				</table>
				</form>
		</div>
		
		<div id="content-right">
		 		<h1> Dostupné kongresy</h1>
		 		<hr/>
		 			<form method="post" action="app.php">
		 			{foreach from=$data.avakon key=i item=row}	 			
		 					<p>
		 					<strong>{$row.congress_titel}</strong><br />
		 					{$row.congress_venue}, <em>{$row.congress_from|date_format:"%d.%m.%Y"} - {$row.congress_until|date_format:"%d.%m.%Y"}</em><br />	
		 				
		 					<button name="register" value="{$row.item_id}">Prihlásiť</button>
		 					<button name="editcon" value="{$row.item_id}">Upraviť</button>
		 					</p>
		 			{/foreach}
				</form>
		</div>
		
		
	</div>
	<div id="footer">{include file="footer.tpl"}</div>
		<div id="bottom"></div>
		 </div>	
 </body>

</html>