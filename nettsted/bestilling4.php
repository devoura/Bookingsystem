<?php session_start(); ?>	

	<form method="post" acton="" id="registrerBetaling" name="registrerBetaling">
		Betalingsmetode <?php include ("listeboksBetalingsmetode.php") ?> * <br/>
		Kortholder <input type="text" id="kortholder" name="kortholder" required /> * <br/>
		Kortnummer <input type="text" id="kortnr" name="kortnr" size="16" maxlength="16" required /> * <br/>
		Utgangsdato <input type="text" id="utgangsdatoMnd" name="utgangsdatoMnd" size="2" maxlength="2" required /> / <input type="text" id="utgangsdatoAar" name="utgangsdatoAar" size="2" maxlength="2" required /> * <br />
		CVV 	   <input type="text" id="CVV" name="CVV" size="3" maxlength="3" required /> * <br/>
		<input type="submit" value="Fortsett" id="fortsett" name="fortsett"/> <br/>
		<input type="reset" value="Tøm feltene" id="nullstill" name="nullstill" /> <br/>
	</form>

	<a href='avbryt.php'><input type='submit' name='avbryt' id='avbryt' value='Avbryt bestilling' onSubmit='bekreft()' /></a> <!-- avbryt bestilling -->

		<!-- registrer betaling form -->

<?php

@$fortsett=$_POST["fortsett"];

if($fortsett)
{
	$kortholder=$_POST["kortholder"];
	$kortnr=$_POST["kortnr"];
	$CVV=$_POST["CVV"];
	$utgangsdatoMnd=$_POST["utgangsdatoMnd"];
	$utgangsdatoAar=$_POST["utgangsdatoAar"];
	$metodeID=$_POST["metodeID"];

	$lovligKortnr=true;
	$lovligCVV=true;
	$lovligDato=true;

	
	if(!$kortholder || !$kortnr || !$CVV || !$utgangsdatoMnd || !$utgangsdatoAar)
	{
		Print ("Alle feltene må fylles ut.");
	}

	if(is_nan($kortnr))
	{
		$lovligKortnr=false;
		print("Kortnummer må bestå av tall, 16 sifre.");
	}

	if(is_nan($utgangsdatoMnd))
	{
		$lovligDato=false;
		print("Utgangsdato kan kun bestå av tall. To sifre for måned, to sifre for år.");
	}

	if($utgangsdatoMnd>12)
	{
		$lovligDato=false;
		print("Utgangsmåned kan ikke være høyere enn 12.");
	}

	if(is_nan($utgangsdatoAar))
	{
		$lovligDato=false;
		print("Utgangsdato kan kun bestå av tall. To sifre for måned, to sifre for år.");
	}


	if(is_nan($CVV))
	{
		$lovligCVV=false;
		print("CVV må bestå av tall, 3 sifre.");
	}



	if($kortholder && $lovligKortnr && $lovligCVV && $metodeID && $lovligDato)
	{
		
		$_SESSION["kortholder"]=$kortholder;
		$_SESSION["kortnr"]=$kortnr;
		$_SESSION["CVV"]=$CVV;
		$_SESSION["metodeID"]=$metodeID;
		$_SESSION["utgangsdatoMnd"]=$utgangsdatoMnd;
		$_SESSION["utgangsdatoAar"]=$utgangsdatoAar;

		print("<a href='bestilling5.php'><input type='submit' name='nesteSide' id='nesteSide' value='Neste side' /></a>");

	
	}

	

} //fortsett
