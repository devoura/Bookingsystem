<?php 
include("start.html"); 
include("eksamentilkobling.php");

$sqlSetning="SELECT * FROM kundeinfo;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen.");
$antallRader=mysqli_num_rows($sqlResultat);


print ("<h2>Kunder</h2>");
print ("<p id='melding'>");
print("<table border=1 align='center'>");
print
("<tr><th>KundeID</th><th>Tittel</th><th>Fornavn</th><th>Etternavn</th><th>Land</th><th>By</th><th>Postnr</th><th>Adresse</th><th>Alt. adresse</th><th>Tlfnr.</th><th>Email</th></tr>");
for($r=1; $r <= $antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$kundeID=$rad["KundeID"];
$tittel=$rad["Tittel"];
$fornavn=$rad["Fornavn"];
$etternavn=$rad["Etternavn"];
$land=$rad["Land"];
$hjemby=$rad["Hjemby"];
$postnr=$rad["postnr"];
$adresse=$rad["Adresse"];
$adresse2=$rad["Adresse2"];
$tlfnr=$rad["TlfNr"];
$email=$rad["Email"];
print("<tr><td>$kundeID</td><td>$tittel</td><td>$fornavn</td><td>$etternavn</td><td>$land</td><td>$hjemby</td><td>$postnr</td><td>$adresse</td><td>$adresse2</td><td>$tlfnr</td><td>$email</td></tr>");
}

print("</table></p>");

include("slutt.html");

?>