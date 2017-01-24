<?php session_start();

$hotellID=$_SESSION["hotellID"];
$hotellNavn=$_SESSION["hotellNavn"];
$innsjekkDato=$_SESSION["innsjekkDato"];
$utsjekkDato=$_SESSION["utsjekkDato"];
$dagerOpphold=$_SESSION["dagerOpphold"];
$frokost=$_SESSION["frokost"];
if ($frokost!='1')
{
	$frokost=0;
}
$frokostPris=$_SESSION["frokostPris"];
$totalPris=$_SESSION["totalPris"];
$tittel=$_SESSION["tittel"];
$fornavn=$_SESSION["fornavn"];
$etternavn=$_SESSION["etternavn"];
$land=$_SESSION["land"];
$by=$_SESSION["by"];
$postnr=$_SESSION["postnr"];
$adresse=$_SESSION["adresse"];
$adresse2=$_SESSION["adresse2"];
$tlfnr=$_SESSION["tlfnr"];
$email=$_SESSION["email"];
$kortholder=$_SESSION["kortholder"];
$kortnr=$_SESSION["kortnr"];
$CVV=$_SESSION["CVV"];
$metodeID=$_SESSION["metodeID"];
$utgangsdatoMnd=$_SESSION["utgangsdatoMnd"];
$utgangsdatoAar=$_SESSION["utgangsdatoAar"];
$totalTotalPris=$totalPris*$dagerOpphold;
$endretKortnr=substr($kortnr, 0, 4) . str_repeat("*", strlen($kortnr) - 8) . substr($kortnr, -4);


$antallRader=$_SESSION["antallRader"];


	include("eksamentilkobling.php");
    $sqlSetning="SELECT RomtypeID FROM Rom WHERE HotellID='$hotellID' GROUP BY romtypeID;"; //teller antall rom på angitt hotell
    $sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen");
    
    $antallRader=mysqli_num_rows($sqlResultat);


for($i=1;$i<=$antallRader;$i++)
       		 { 
       		 	$rad=mysqli_fetch_array($sqlResultat);  
            	$romtypeID=$rad["RomtypeID"];

            	    $sqlSetningRomtype="SELECT romtype FROM romtyper WHERE romtypeID='$romtypeID';";
       				$sqlResultatRomtype=mysqli_query($db,$sqlSetningRomtype) or die ("Ikke mulig å hente romtype fra databasen."); 

			

            $radRomtype=mysqli_fetch_array($sqlResultatRomtype);         
            $romtype=$radRomtype["romtype"];       

    			${'romtypeID' . $i}=$_SESSION["romtypeID"."$i"];
    			${'antallRom' . $i}=$_SESSION["${'romtypeID' . $i}"];

    				if(${'antallRom' . $i} <= 0) //er antallet rom av en type lik eller mindre null?
    				{
    					print("");
    				}

    				else //har du bestilt mer enn 0 av en romtype?
    				{
						print("Du har bestilt ${'antallRom' . $i} $romtype. <br />");
					}
			 }

			  
?>


<?php

print("

<h3>Oversikt over din bestilling, $tittel $fornavn $etternavn</h3>
<table border='1'>
<tr>
	<th>Hotellnavn</th>
	<th>Innsjekk</th>
	<th>Utsjekk</th>
	<th>Varighet opphold</th>
</tr>
<tr>

	<td>$hotellNavn</td>
	<td>$innsjekkDato</td>
	<td>$utsjekkDato</td>
	<td>$dagerOpphold dag(er)</td>
</tr>
</table>

");

	if($frokost)
	{

		print("Du har bestilt frokost til KR $frokostPris per døgn, per rom. <br />");

	}

print("Den totale prisen for ditt opphold blir KR $totalTotalPris <br />");

print("

<h3>Se over at informasjonen under stemmer</h3><br />

<table border='1'>
<tr>
	<th>Land</th>
	<th>By</th>
	<th>Postnr</th>
	<th>Adresse</th>
	<th>Adresse 2</th>
	<th>Telefonnr</th>
	<th>Email</th>
</tr>
<tr>
	<td>$land</td>
	<td>$by</td>
	<td>$postnr</td>
	<td>$adresse</td>
	<td>$adresse2</td>
	<td>$tlfnr</td>
	<td>$email</td>
</tr>
</table>

<br />

Betaler med $metodeID, $endretKortnr.


");

?>

<p id="melding">Stemmer informasjonen? Bekreft bestillingen her.</p>

<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt" >
		<input type='submit' value='Send bestilling' id='fortsettBestilling' name='fortsettBestilling' />
		<a href='avbryt.php'><input type='submit' name='avbryt' id='avbryt' value='Avbryt bestilling' onSubmit='bekreft()' /></a>
</form>


<?php
@$fortsettBestilling=$_POST["fortsettBestilling"];

if($fortsettBestilling)

{
include("eksamentilkobling.php");
$sqlquery="INSERT INTO kundeinfo VALUES (NULL, '$tittel', '$fornavn','$etternavn','$land','$by','$postnr','$adresse','$adresse2','$tlfnr','$email');";
$sqlResult=mysqli_query($db, $sqlquery) or die ("ikke mulig å hente fra the database");

$sqlspoering="INSERT INTO betalingsinfo (`BetalingsID`,`KundeID`,`MetodeID`,`Kortholder`,`Kortnummer`,`cvv`,`Utgangsdatomaaned`,`Utgangsdatoaar`,`TotalPris`) select NULL AS BetalingsID, KundeID, '$metodeID' AS metodeID, '$kortholder' AS Kortholder, '$kortnr' AS Kortnummer, '$CVV' AS cvv, '$utgangsdatoMnd' AS Utgangsdatomaaned, '$utgangsdatoAar' AS Utgangsdatoaar, '$totalTotalPris' AS TotalPris from kundeinfo ORDER BY KundeID DESC LIMIT 1;";
$sqlResultiss=mysqli_query($db, $sqlspoering) or die ("Life is a bitch then you die");

for ($r=1;$r<=$antallRader;$r++)

{
 
$ID=$_SESSION["romtypeID"."$r"];
$tall=$_SESSION[$_SESSION["romtypeID"."$r"]];


include("eksamentilkobling.php");

$endaEnSqlSetning="SELECT prisPerDogn FROM romtyper WHERE romtypeID='$ID';";

$endaEttSqlResultat=mysqli_query($db,$endaEnSqlSetning) or die ("Ikke mulig å hente fra databasen."); 

$prisRad=mysqli_fetch_array($endaEttSqlResultat); 

$romPris=$prisRad["prisPerDogn"];

for ($t=1;$t<=$tall;$t++)	

{
	
$sqlSetning="INSERT INTO bestilling (BestillingID, HotellID, KundeID, BetalingsID, RomtypeID, Pris, DatoAnkomst, DatoAvreise, Frokost, Tilstand) SELECT NULL AS BestillingID, '$hotellID' AS HotellID, kundeinfo.KundeID, betalingsinfo.BetalingsID, '$ID' AS RomtypeID, '$romPris' AS Pris, '$innsjekkDato' AS DatoAnkomst, '$utsjekkDato', '$frokost' AS Frokost, NULL AS Tilstand  
from kundeinfo inner join betalingsinfo ON kundeinfo.KundeID=betalingsinfo.KundeID ORDER BY kundeinfo.KundeID DESC LIMIT 1;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen");
}
}



print("Bestillingen er sendt.");




}



?>





