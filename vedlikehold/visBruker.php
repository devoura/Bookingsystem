<?php 
/*
session_start();
*/

include("start.html"); 
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM admin;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen.");
$antallRader=mysqli_num_rows($sqlResultat);


print("<table border=1>");
print("<tr><th>Brukernavn</th><th>Passord</th></tr>");
for($r=1; $r <= $antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$brukernavn=$rad["BrukerNavn"];
$passord=$rad["Passord"];


$endretPassord=substr($passord, 0, 0) . str_repeat("*", strlen($passord) - 0);



print("<tr><td>$brukernavn</td><td>$endretPassord</td></tr>");
}

print("</table>");

include("slutt.html");

?>