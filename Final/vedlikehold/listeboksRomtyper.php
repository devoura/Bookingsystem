<?php
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM romtyper ORDER BY RomtypeID;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ingen kontakt med databasen.");
$antallRader=mysqli_num_rows($sqlResultat);
print("<select name='romtypeID' id='romtypeID'>");

for($r=1; $r<=$antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$romtypeID=$rad["RomtypeID"];
$romtype=$rad["Romtype"];
print("<option value='$romtypeID'>$romtype</option>");
}
print("</select>");
?>