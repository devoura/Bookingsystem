<?php
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM Betalingsmetode ORDER BY MetodeID;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ingen kontakt med databasen");
$antallRader=mysqli_num_rows($sqlResultat);
print("<select name='metodeID' id='metodeID'>");
print("<option value='tom'> </option>");
for($r=1; $r<=$antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$metodeID=$rad["MetodeID"];
$metodeNavn=$rad["MetodeNavn"];
print("<option value='$metodeID'>$metodeNavn</option>");
}
print("</select>");
?>