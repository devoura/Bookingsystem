<?php 
include("start.html");
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM betalingsinfo ORDER BY betalingsID ASC;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen.");
$antallRader=mysqli_num_rows($sqlResultat);

print("<table border=1>");
print
("<tr><th>Betalings-ID</th><th>Metode-ID</th><th>Kortholder</th><th>Kortnummer</th><th>Totalpris</th></tr>");
for($r=1; $r <= $antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$betalingsID=$rad["BetalingsID"];
//$handlekurvID=$rad["HandlekurvID"];
$metodeID=$rad["MetodeID"];
$kortholder=$rad["Kortholder"];
$kortnr=$rad["Kortnummer"];
$totalpris=$rad["TotalPris"];


$endretKortnr=substr($kortnr, 0, 4) . str_repeat("*", strlen($kortnr) - 8) . substr($kortnr, -4);


print("<tr><td>$betalingsID</td><td>$metodeID</td><td>$kortholder</td><td>$endretKortnr</td><td>$totalpris</td></tr>");
}

print("</table>");

include("slutt.html");

?>