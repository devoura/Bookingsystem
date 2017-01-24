<?php
include ("start.html");
?>

<script src="funksjoner.js"> </script>

<h2>Registrer ett rom</h2>
<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt" onSubmit="return validateRom3();" >
		<?php include("listeboksHotell.php"); ?> <br/>
		<input type="int" id="romID" name="romID" maxlength="11" placeholder="Rom ID" /><i>Eks.204 er fjerde rom på andre etasje</i><br/>
		<input type="text" id="romtypeID" name="romtypeID" placeholder="Romtype ID" /><i>Eks. ER for enkeltrom</i><br/>
		<input type="submit" value="Fortsett" id="fortsett" name="fortsett">
		<input type="reset" value="Tøm feltene" id="reset" name="reset">	
</form>

<p id="melding"> </p>

<p>Hvis du vil registrere hele hotellet på en gang klikk <a href="https://home.hbv.no/web-is-gr02w/web1000/vedlikehold/rom.php">her</a> </p>
<p>Hvis du vil registrere en hel etasje klikk <a href="https://home.hbv.no/web-is-gr02w/web1000/vedlikehold/rom2.php">her</a> </br></p>



<?php
@$fortsett=$_POST["fortsett"];


if($fortsett)
{
$hotellID=$_POST["HotellID"];
$romID=$_POST["romID"];
$romtypeID=$_POST["romtypeID"];

if (!$romID || !is_numeric($romID))
	{
    print("<p id='melding'>RomID må fylles ut med et tall.</p><br />");
    }
if (!$hotellID)
	{
    print("<p id='melding'>HotellID må fylles ut.</p><br />");
    }
if (!$romtypeID)
	{
    print("<p id='melding'>RomtypeID må fylles ut.</p><br />");
    }
    else
		{
		include("eksamentilkobling.php");
		$sqlSetning="SELECT * FROM rom WHERE romID='$romID' AND hotellID='$hotellID';";
		$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>Ikke mulig å hente fra databasen</p>");
		$antallRader=mysqli_num_rows($sqlResultat);
	
			if($antallRader==1) /* eller ==1 for primærnøkler*/
			{
			print("<p id='melding'>Kombinasjonen av rom og hotell er allerede registrert, duplikater er ikke tillatt.</p>");
			} 

			else
			{
				$sqlSetning="INSERT INTO rom VALUES ('$romID', '$hotellID', '$romtypeID',NULL);";
				mysqli_query($db, $sqlSetning) or die ("<p id='melding'>Ikke mulig å registrere informasjonen.</p>"); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("<p id='melding'>Følgende rom er nå registrert:<br/> $romID $hotellNavn</p><br/>");
			}
		}
}



?>