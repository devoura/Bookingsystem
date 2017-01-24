<?php 
/*
session_start();
*/

include("start.html"); 
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM bestilling;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen.");
$antallRader=mysqli_num_rows($sqlResultat);

print("<table border=1>");
print
("<tr><th>Bestillings-ID</th><th>Hotell-ID</th><th>Kunde-ID</th><th>Romtype-ID</th><th>Pris</th><th>Ankomst</th><th>Avreise</th><th>Frokost (1 ja, 0 nei)</th></tr>");
for($r=1; $r <= $antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$bestillingID=$rad["BestillingID"];
$hotellID=$rad["HotellID"];
$kundeID=$rad["KundeID"];
//$handlekurvID=$rad["HandlekurvID"];
$romtypeID=$rad["RomtypeID"];
$pris=$rad["Pris"];
$datoAnkomst=$rad["DatoAnkomst"];
$datoAvreise=$rad["DatoAvreise"];
$frokost=$rad["Frokost"];

print("<tr><td>$bestillingID</td><td>$hotellID</td><td>$kundeID</td><td>$romtypeID</td><td>$pris</td><td>$datoAnkomst</td><td>$datoAvreise</td><td>$frokost</td></tr>");
}

print("</table>");

include("slutt.html");

?>