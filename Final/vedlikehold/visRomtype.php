<?php 
include("start.html"); 
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM romtyper;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>Ikke mulig å hente fra databasen.</p>");
$antallRader=mysqli_num_rows($sqlResultat);

print ("<h2>Romtyper</h2>");
print ("<p id='melding'>");
print("<table border=1 align='center'>");
print("<tr><th>Romtype-ID</th><th>Romtype</th><th>Pris per døgn</th></tr>");
for($r=1; $r <= $antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$romtypeID=$rad["RomtypeID"];
$romtype=$rad["Romtype"];
$prisPerDogn=$rad["PrisPerDogn"];


print("<tr><td>$romtypeID</td><td>$romtype</td><td>$prisPerDogn</td></tr>");
}

print("</table></p>");

include("slutt.html");

?>