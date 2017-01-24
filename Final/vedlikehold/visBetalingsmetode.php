<?php 
include("start.html");
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM betalingsmetode;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>Ikke mulig å hente fra databasen.</p>");
$antallRader=mysqli_num_rows($sqlResultat);

print ("<h2>Betalingsmetoder</h2>");
print ("<p id='melding'>");
print("<table border=1 align='center'>");
print("<tr><th>Metode-ID</th><th>Metodenavn</th></tr>");
for($r=1; $r <= $antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$metodeID=$rad["MetodeID"];
$metodeNavn=$rad["MetodeNavn"];

print("<tr><td>$metodeID</td><td>$metodeNavn</td></tr>");
}

print("</table></p>");

include("slutt.html");

?>