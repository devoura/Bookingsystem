<?php 
/*
session_start();
*/

include("start.html"); 

?>

<form action="" method="post" id="tekstfelt" name="tekstfelt">
Velg hotell <?php include("listeboksHotell.php"); ?>
<input type="submit" id="fortsett" name="fortsett" value="Vis bestillinger" />
</form>



<?php
@$fortsett=$_POST["fortsett"];

if($fortsett)
{
$hotellID=$_POST["HotellID"];

include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM bestilling WHERE hotellID='$hotellID';";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen.");
$antallRader=mysqli_num_rows($sqlResultat);

	if($antallRader==0)
	{
		print("Ingen bestillinger på dette hotellet.");
	}

else{
print("<table border=1>");
print
("<tr><th>Bestillings-ID</th><th>Hotell-ID</th><th>Kunde-ID</th><th>Romtype-ID</th><th>Pris</th><th>Ankomst</th><th>Avreise</th><th>Frokost (1 ja, 0 nei)</th></tr>");
for($r=1; $r <= $antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$bestillingID=$rad["BestillingID"];
$hotellID=$rad["HotellID"];
$kundeID=$rad["KundeID"];
//$handlekurvID=$rad["HandlekurvID"];
$romtypeID=$rad["RomtypeID"];
$pris=$rad["Pris"];
$datoAnkomst=$rad["DatoAnkomst"];
$datoAvreise=$rad["DatoAvreise"];
$frokost=$rad["Frokost"];

print("<tr><td>$bestillingID</td><td>$hotellID</td><td>$kundeID</td><td>$romtypeID</td><td>$pris</td><td>$datoAnkomst</td><td>$datoAvreise</td><td>$frokost</td></tr>");
}

print("</table>");
}
}
include("slutt.html");

?>