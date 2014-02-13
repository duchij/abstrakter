<?php
//ini_set('SMTP','mail.detska-chirurgia.sk');
$headers = "From: trauma@detska-chirurgia.sk"."\r\n";
$headers .= 'MIME-Version: 1.0'."\r\n";
$headers .= 'Content-Type: text/html; charset=utf-8'."\r\n";



$to = "bduchaj@gmail.com";
$from = 'postmaster@detska-chirurgia.sk';
$subject = "test";
$message = "<html>
<body>
<h3> Vážená pani, Vážený pán !</h3>

<p>Úspešne ste sa zaregistrovali do aplikácie <strong>Abstrakter</strong>, táto aplikácia umožňuje registráciu, správu a odovzdávanie abstraktov na vybranú vzdelávaciu aktivitu 
Kliniky detskej chirurgie LF UK a DFNsP </p>
<p>
Prosíme Vás vyplňte si Vaše kontaktné údaje, tak aby sme Vás vedeli v prípade potreby kontaktovať a vystaviť Vám na konci akcie certifikát o úspešnom absolvovaní. 
V aplikácii je možné sa prihlásiť ako autor, spoluautor, alebo návštevník vzdelávacej akcie. 
V prípade aktívnej účasti je potrebné odovzdať aj kompletný abstrakt prednášky/postera</p>
<p>
Heslo, ktoré ste zadali pri registrácii si dobre zapamätajte, pretože len pomocou neho sa dostanenete do aplikácie, v ktorej bude dostupná prvá infromácia, program ev zborník abstraktov.
<strong>Upozornenie</strong> heslo si od Vás nikdy nebudeme pýtať...</p>

<p>Aplikácie umožňuje v čase otvorenej registrácie úpravu alebo zmazanie už existujúceho Vami zadaného abstraktu (<strong>abstrakty ostatných účastníkov sa nezobrazujú!!!</strong>), v prípade uzavierky sa už abstrakt nedá editovať, ale je dostupný na prezeranie.</p>

<p>Vaše pripomienky, ev. problémy s aplikáciou, ale ďaľšie otázky poprosíme posielajte na adresu trauma@detska-chirurgia.sk</p>

Web kongresu: http://www.detska-chirurgia.sk/trauma<br />

<p>Na tento mail prosím neodpovedajte.</p>

<p>S pozdravom</p>

<p>Organizačný team VI. trauma v detskom veku</p>

</body>

</html>";
 
//if(mail($to,$subject,strip_tags($message),$headers))
if(mail($to,$subject,$message,$headers))
{
	echo "Message Sent";
}
else
{
	echo "Message Not Sent";
}