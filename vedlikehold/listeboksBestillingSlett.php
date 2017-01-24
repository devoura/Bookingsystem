<?php
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM bestilling ORDER BY bestillingID;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>ingen kontakt med databasen bestilling</p>");
$antallRader=mysqli_num_rows($sqlResultat);
print("<select name='bestillingID' id='bestillingID'>");

for($r=1; $r<=$antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$bestillingID=$rad["BestillingID"];
$hotellID=$rad["HotellID"];
$kundeID=$rad["KundeID"];
$betalingsID=$rad["BetalingsID"];
print("<option value='$bestillingID'>BestillingID: $bestillingID, HotellID: $hotellID, KundeID: $kundeID, BetalingsID: $betalingsID</option>");
}
print("</select>");
?> 