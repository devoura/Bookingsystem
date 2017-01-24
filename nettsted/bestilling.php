<?php session_start(); ?>


<script src="ajax-by.js"></script>
<script src="ajax-hotell.js"></script>
<script src="ajax-frokost.js"></script>

<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt" >
		


	Innsjekkdato: <input type="date" name="innsjekkDato" id="innsjekkDato" required />	<br/>
	Utsjekkdato: <input type="date" name="utsjekkDato" id="utsjekkDato" required />	<br/>


    Velg land: <?php include("listeboksLand.php"); ?>  <br/> <!-- velg land -->
      <div id="melding"></div> <!-- Liste over byer i valgt land -->
      <div id="melding2"></div> <!-- Liste over hoteller i valgt by -->
      <div id="melding3"></div> <!-- checkbox for frokost -->
 

		<input type='submit' value='Velg' id='fortsett' name='fortsett' />
		<input type="reset" value="Tøm feltene" id="reset" name="reset" /> 

	
</form>






<a href='avbryt.php'><input type='submit' name='avbryt' id='avbryt' value='Avbryt bestilling' onSubmit='bekreft()' /></a>

<?php

@$fortsett=$_POST["fortsett"];



if($fortsett)
{

@$hotellID=$_POST["hotellID"]; //session, hentes fra melding2
$innsjekkDato=$_POST["innsjekkDato"]; //session
$utsjekkDato=$_POST["utsjekkDato"];  //session
//@$frokost=$_POST["frokost"];
//@$frokostPris=$_POST["frokostPris"];
//@$skalHaFrokost=$_POST["skalHaFrokost"];
@$frokostJa=$_POST["frokostJa"];
@$frokostNei=$_POST["frokostNei"];

$tid=date("Y-m-d"); //dagens dato i lokalt format, input type date er også lokalt format

$_SESSION["hotellID"]=$hotellID;
$_SESSION["innsjekkDato"]=$innsjekkDato;
$_SESSION["utsjekkDato"]=$utsjekkDato;
//$_SESSION["frokost"]=$frokost;
//$_SESSION["frokostPris"]=$frokostPris;
//$_SESSION["skalHaFrokost"]=$skalHaFrokost;
//$_SESSION["frokostJa"]=$frokostJa;
//$_SESSION["frokostNei"]=$frokostNei;

								if (isset($_POST['frokostJa']))  
                                {
                                    
                                    $_SESSION["frokost"]=true;
                                    
                                }


                                    // Checkboxen er tom     
                                else 
                                {
                                    
                                  $_SESSION["frokost"]=false;

                                }


$lovliginnsjekkDato=true;
$lovligutsjekkDato=true;
$lovligHotellID=true;




 $innsjekkDager = strtotime("$innsjekkDato");
 $utsjekkDager = strtotime("$utsjekkDato");
 $antallDager = $utsjekkDager - $innsjekkDager;
 $dagerOpphold = floor($antallDager/(60*60*24));

 $_SESSION["dagerOpphold"]=$dagerOpphold;



if($innsjekkDato < $tid) //er innsjekkdato i dag eller senere?
{
	$lovliginnsjekkDato=false;
	print("Innsjekkingsdato kan ikke være i fortiden.<br />");
}

if($utsjekkDato < $innsjekkDato) //er innsjekkdato før utsjekkdato?
{
	$lovligutsjekkDato=false;
	print("Utsjekkingsdato kan ikke være før innsjekkingsdato.<br />");
}

	if(!$innsjekkDato || !$utsjekkDato || !$hotellID) //har inn-/utsjekk og hotellID verdier?
	{
		$lovligHotellID=false;
		$lovliginnsjekkDato=false;
		$lovligutsjekkDato=false;
		print("Vennligst velg et hotell og angi datoer for inn- og utsjekking.");

	}

if($hotellID=="...")
{	
	$lovligHotellID=false;
	print("Vennligst velg et hotell");
}

if($lovliginnsjekkDato && $lovligutsjekkDato && $lovligHotellID) //er alt i orden? trykk her for neste del
{
	var_dump($_SESSION);
print("<a href='bestilling2.php'><input type='submit' name='nesteSide' id='nesteSide' value='Neste Side' onSubmit='bekreft()' /></a>"); //generer knapp til neste side
}


}






?>