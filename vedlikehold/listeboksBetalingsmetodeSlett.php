<?php
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM betalingsmetode ORDER BY metodeID;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>ingen kontakt med databasen betalingsmetode</p>");
$antallRader=mysqli_num_rows($sqlResultat);
print("<select name='metodeID' id='metodeID'>");

for($r=1; $r<=$antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$metodeID=$rad["MetodeID"];
$metodeNavn=$rad["MetodeNavn"];
print("<option value='$metodeID'>$metodeID $metodeNavn</option>");
}
print("</select>");
?> 