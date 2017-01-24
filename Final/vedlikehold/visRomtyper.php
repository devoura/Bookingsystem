<?php 
/*
session_start();
*/

include("start.html"); 
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM romtyper;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen.");
$antallRader=mysqli_num_rows($sqlResultat);

print("<table border=1>");
print
("<tr><th>Romtype-ID</th><th>Romtype</th><th>Pris per døgn</th></tr>");
for($r=1; $r <= $antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$romtypeID=$rad["romtypeID"];
$romtype=$rad["romtype"];
$prisPerDogn=$rad["prisPerDogn"];


print("<tr><td>$romtypeID</td><td>$romtype</td><td>$prisPerDogn</td></tr>");
}

print("</table>");

include("slutt.html");

?>