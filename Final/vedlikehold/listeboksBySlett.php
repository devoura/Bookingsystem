<?php
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM byer ORDER BY byNavn;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>ingen kontakt med databasen by</p>");
$antallRader=mysqli_num_rows($sqlResultat);
print("<select name='byID' id='byID'>");

for($r=1; $r<=$antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$byID=$rad["ByID"];
$byNavn=$rad["ByNavn"];
print("<option value='$byID'>$byID $byNavn</option>");
}
print("</select>");
?> 