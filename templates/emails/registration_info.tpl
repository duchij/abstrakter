<html>
<body>

<h3>Vážená kolegyňa, Vážený kolega {$data.user_meno} {$data.user_priezvisko}</h3>

<p>Dovoľujeme si Vás informovať o úspešnej registrácii na <strong><br>
{$data.congress_titel}</strong>, <br>
ktorý sa koná v dňoch
<em>{$data.congress_from|date_format:"%d.%m.%Y"} - {$data.congress_until|date_format:"%d.%m.%Y"}, {$data.congress_venue}</em>
</p> 
<strong>Formou:</strong><br>
{if $data.reg_participation === 'aktiv'}
<p>Aktívnou:</p>
<p><strong>{$data.reg_abstract_titul}</strong><br>
Autor:<strong> {$data.reg_main_autor}</strong><br>
Spoluautori:<strong> {$data.reg_abstract_autori}</strong><br>
Pracovisko:<strong> {$data.reg_abstract_adresy}</strong><br></p>
{/if}
{if $data.reg_participation === 'pasiv'}
<p>Ako spoluautor</p>
{/if}
{if $data.reg_participation === 'visit'}
<p>Ako návštevník</p>
{/if}

<p>
ďakujeme za Vašu účasť, pri aktívnej účasti si môžete Vašu prednášku/poster opraviť ev. zmazať do dátumu uzavierky.
</p>
s pozdravom<br>

organizačným tím <em>{$data.congress_titel}</em>
</body>
</html>