<?php
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM admin ORDER BY brukerNavn;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>ingen kontakt med databasen admin</p>");
$antallRader=mysqli_num_rows($sqlResultat);

if($antallRader==1)
{
	print("Det er kun registrert én bruker. Om denne slettes vil du ikke kunne logge inn igjen! Slett med omhu.");
}
print("<select name='brukernavn' id='brukernavn'>");

for($r=1; $r<=$antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$brukernavn=$rad["BrukerNavn"];

print("<option value='$brukernavn'>Brukernavn: $brukernavn </option>");
}
print("</select>");
?> 