<?php
include ("start.html");
?>

<script src="funksjoner.js"></script>

<h2>Registrer romtype</h2>
<form method="post" action="" id="tekstfelt" name="registrerRomtype" onSubmit="return validateRegistrerRomType();">
	<input type="text" id="romtype" name="romtype" placeholder="Romtype" maxlength="45" /><i>Enkeltrom, suite o.l </i><br/>
	<input type="text" id="romtypeID" name="romtypeID" placeholder="RomtypeID" maxlength="2" /><i>2 Bokstaver</i><br/>
	<input type="NUM" id="prisPerDogn" name="prisPerDogn"  placeholder="Pris per døgn" /> <br/>
  	<input type="submit" value="Registrer" id="registrerRomtypeKnapp" name="registrerRomtypeKnapp"/><br/> 
</form>

<p id="melding"></p>

<?php

@$registrerRomtypeKnapp=$_POST ["registrerRomtypeKnapp"];

if ($registrerRomtypeKnapp)
{
	$romtype=$_POST ["romtype"];
	$romtypeID=$_POST ["romtypeID"];
	$prisPerDogn=$_POST ["prisPerDogn"];

	if(!$romtype || !$romtypeID || !$prisPerDogn)
	{
		print ("<p id='melding'>Alle feltene må fylles ut.</p>");
	}


	if($romtype && $romtypeID && $prisPerDogn)
	{	

	include("eksamentilkobling.php");            /* tilkobling til db */


	$sqlSetning="SELECT * FROM Romtyper WHERE romtypeID='$romtypeID';";
	$sqlResultat=mysqli_query ($db,$sqlSetning) or die ("<p id='melding'>Kunne ikke koble til db.</p>");
	$antallRader=mysqli_num_rows($sqlResultat);

	if ($antallRader !=0)
	{
	print ("<p id='melding'>RomtypeID er allerede registrert.</p>");

	}

else
{
	include("eksamentilkobling.php");
	$romtypeID = strtoupper($romtypeID);
	$sqlSetning="INSERT INTO Romtyper VALUES ('$romtypeID','$romtype','$prisPerDogn');";
	mysqli_query ($db,$sqlSetning) or die ("<p id='melding'>Kunne ikke koble til DB.</p>");

	print ("<p id='melding'>Følgende romtype er registrert: $romtype, $romtypeID, Kr $prisPerDogn,- </p>");
}
}
}
include ("slutt.html");
?>