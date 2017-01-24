<?php
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM romtyper ORDER BY romtypeID;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>ingen kontakt med databasen romtyper</p>");
$antallRader=mysqli_num_rows($sqlResultat);
print("<select name='romtypeID' id='romtypeID'>");

for($r=1; $r<=$antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$romtypeID=$rad["RomtypeID"];
$romtype=$rad["Romtype"];
print("<option value='$romtypeID'>$romtypeID $romtype</option>");
}
print("</select>");
?> 