<?php
include("start.html");
?>

<script src="funksjoner.js"></script>

<h2>Registrer betaling</h2>

<form method="post" acton="" id="tekstfelt" name="registrerBetaling" onSubmit="return validateRegistrerBetaling();">
	<?php include ("listeboksBetalingsmetode.php") ?> <br/>
	<?php include ("listeboksKunde.php") ?> <br/>
	<input type="text" id="kortHolder" name="kortHolder" placeholder="Kortholders navn" /><br/>
	<input type="NUM" id="kortNummer" name="kortNummer" size="16" maxlength="16" placeholder="Kortnummer"  /><br/>
	<input type="NUM" id="CVV" name="CVV" size="16" maxlength="3" placeholder="CVV"  /><br/>
	Utløpsdato:<br /><?php include ("listeboksMaaned.php")?> <?php include ("listeboksAar.php"); ?> <br/>
	<input type="NUM" id="totalPris" name="totalPris" placeholder="Total pris"  /><br/>
	<input type="submit" value="Registrer" id="registrerBetalingKnapp" name="registrerBetalingKnapp"/> <br/>
</form>
	
<p id="melding"></p>

<?php

@$registrerBetalingKnapp=$_POST ["registrerBetalingKnapp"];

if ($registrerBetalingKnapp)
{
	$metodeID=$_POST["metodeID"];
	$kortHolder=$_POST["kortHolder"];
	$kortNummer=$_POST["kortNummer"];
	$CVV=$_POST["CVV"];
	$UtgangsdatoMaaned=$_POST["utløpsMåned"];
	$UtgangsdatoAar=$_POST["utløpsÅr"];
	$totalPris=$_POST["totalPris"];
	$kundeID=$_POST["kundeID"];
	
	if(!$kortHolder || !$kortNummer || !$CVV || !$UtgangsdatoMaaned || !$UtgangsdatoAar || !$totalPris)
	{
		die ("<p id='melding'>Alle feltene må fylles ut.</p>");
	}
	else if (!is_numeric($kortNummer)){
	die ("<p id='melding'>Kortnummer må bare inneholde tall.</p>");
	}
	else if (!is_numeric($CVV)){
	die ("<p id='melding'>CVV må bare inneholde tall.</p>");
	}
	else if (!is_numeric($totalPris)){
	die ("<p id='melding'>Totalpris må bare inneholde tall.</p>");
	}
	else
	{
		include("eksamentilkobling.php");         /*tilkobling til db*/
		
		$sqlSetning="SELECT * FROM betalingsinfo WHERE kortNummer='$kortNummer';";
		$sqlResultat=mysqli_query($db,$sqlSetning) or die ("<p id='melding'>Kunne ikke koble til db.</p>");
		$antallRader=mysqli_num_rows($sqlResultat);

		if($antallRader !=0)
		{
			print ("<p id='melding'>Kortnummer er allerede registrert</p>");
		}

		else
		{
		$sqlSetning="INSERT INTO betalingsinfo 
		VALUES (NULL, '$kundeID','$metodeID','$kortHolder','$kortNummer','$CVV','$UtgangsdatoMaaned','$UtgangsdatoAar','$totalPris');";
		mysqli_query($db, $sqlSetning) or die (mysqli_error($db));

		print ("<p id='melding'>Betalingsinfo er registrert.</p>" );
		}

	}

}

include("slutt.html");

?>
