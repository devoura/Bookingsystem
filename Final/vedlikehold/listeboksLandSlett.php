<?php
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM land ORDER BY landNavn;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ingen kontakt med databasen land");
$antallRader=mysqli_num_rows($sqlResultat);
print("<select name='LandID' id='LandID'>");

for($r=1; $r<=$antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$landID=$rad["LandID"];
$landNavn=$rad["LandNavn"];
print("<option value='$landID'>$landID $landNavn</option>");
}
print("</select>");
?> 