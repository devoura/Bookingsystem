<?php
include("eksamentilkobling.php");
$sqlSetning="SELECT HotellNavn FROM Hotell ORDER BY HotellNavn;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ingen kontakt med databasen hotell");
$antallRader=mysqli_num_rows($sqlResultat);
print("<select name='landListe' id='landListe'>");
for($r=1; $r<=$antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$hotellID=$rad["HotellID"];
$hotellNavn=$rad["HotellNavn"];
print("<option value='$hotellID'>$hotellNavn</option>");
}
print("</select>");
?>