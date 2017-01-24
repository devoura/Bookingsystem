<?php
include("eksamentilkobling.php");
$sqlSetning="SELECT byNavn FROM byer ORDER BY byNavn;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ingen kontakt med databasen by");
$antallRader=mysqli_num_rows($sqlResultat);
print("<select name='byID' id='byID'>");
print("<option value='tom'> </option>");
for($r=1; $r<=$antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$byID=$rad["ByID"];
$byNavn=$rad["ByNavn"];
print("<option value='$byID'>$byID $byNavn</option>");
}
print("</select>");
?>