<?php
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM kundeinfo ORDER BY kundeID;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ingen kontakt med databasen");
$antallRader=mysqli_num_rows($sqlResultat);
print("<select name='kundeID' id='kundeID'>");

for($r=1; $r<=$antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$kundeID=$rad["KundeID"];
$tittel=$rad["Tittel"];
$fornavn=$rad["Fornavn"];
$etternavn=$rad["Etternavn"];
print("<option value='$kundeID'>$kundeID, $tittel $fornavn $etternavn</option>");
}
print("</select>");
?>