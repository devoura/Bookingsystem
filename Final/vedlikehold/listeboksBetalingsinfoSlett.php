<?php
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM betalingsinfo ORDER BY betalingsID;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>ingen kontakt med databasen betalingsinfo</p>");
$antallRader=mysqli_num_rows($sqlResultat);
print("<select name='betalingsID' id='betalingsID'>");

for($r=1; $r<=$antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$betalingsID=$rad["BetalingsID"];
$kundeID=$rad["KundeID"];
$kortholder=$rad["Kortholder"];
print("<option value='$betalingsID'>BetalingsID: $betalingsID, KundeID: $kundeID, $kortholder</option>");
}
print("</select>");
?> 