
		{$data.message}
<div id="tabs">
    <ul>
	   <li><a href="#tab1">Info kongress</a></li>
	   <li><a href="#tab2">Info stranka</a></li>
	</ul>
	<div id="tab1">
				<h1>Akcia / Seminár / Konferencia / Kongress...</h1>
				<table class="responsive" data-max="15">
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
					<tr><td>Verejne viditeľný:</td><td> <input type="checkbox" name="public" value="1" {$data.public}></td></tr>
					
					
					<tr><td colspan="2"><button class="green button">Ulozit</button></tr>
				</table>
	</div>
	<div id="tab2">
	<textarea class="dtextbox">Popis</textarea>
	</div>
	
</div>

	