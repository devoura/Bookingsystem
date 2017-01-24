<?php
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM Land ORDER BY LandNavn;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ingen kontakt med databasen land");
$antallRader=mysqli_num_rows($sqlResultat);
print("<select name='landListe' id='landListe'>");
for($r=1; $r<=$antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$landID=$rad["LandID"];
$landNavn=$rad["LandNavn"];
print("<option value='$landID'>$landID $landNavn</option>");
}
print("</select>");
?>




