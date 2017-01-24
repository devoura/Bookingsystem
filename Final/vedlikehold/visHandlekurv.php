<?php 
include("start.html");
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM handlekurv;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>Ikke mulig å hente fra databasen.</p>");
$antallRader=mysqli_num_rows($sqlResultat);

print ("<h2>Handlekurver</h2>");
print ("<p id='melding'>");
print("<table border=1 align='center'>");
print("<tr><th>Handlekurv-ID</th><th>Kunde-ID</th><th>Totalpris</th></tr>");
for($r=1; $r <= $antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$handlekurvID=$rad["HandlekurvID"];
$kundeID=$rad["KundeID"];
$totalPris=$rad["TotalPris"];



print("<tr><td>$handlekurvID</td><td>$kundeID</td><td>$totalPris</td></tr>");
}

print("</table></p>");

include("slutt.html");

?>