<?php
include("start.html");
?>
<script src="funksjoner.js"></script>

<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt" onSubmit="return validateBruker();">
<input type="text" id="brukernavn" name="brukernavn" placeholder="Brukernavn" maxlength="45" /><br/>
<input type="password" id="passord"  name="passord" placeholder="Passord" maxlength="45" /><br/>
<input type="submit" value="Fortsett" id="fortsett" name="fortsett">
</form>
<p id="melding"></p>

<?php
@$fortsett=$_POST["fortsett"];

if($fortsett)
{
$brukernavn=$_POST["brukernavn"];
$passord=$_POST["passord"];

$lovligbrukernavn=true;
$lovligfelt=true;

//sjekker om alle felter fylt ut
if(!$brukernavn || !$passord) {
	$lovligfelt=false;
		print("<p id='melding'>Vennligst fyll ut alle feltene.</p>");
  }
 else
		{
		include("eksamentilkobling.php");
		$sqlSetning="SELECT * FROM admin WHERE BrukerNavn='$brukernavn';";
		$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>ikke mulig å hente fra databasen.</p>");
		$antallRader=mysqli_num_rows($sqlResultat);
	
			if($antallRader !=0) /* eller ==1 for primærnøkler*/
			{
			$lovligbrukernavn=false;
			print("<p id='melding'>Brukernavnet er allerede registrert</p><br />");
			} 
			if($lovligbrukernavn && $lovligfelt)
				{
				$sqlSetning="INSERT INTO admin VALUES ('$passord', '$brukernavn');";
				mysqli_query($db, $sqlSetning) or die ("<p id='melding'>ikke mulig å registrere informasjonen.</p>"); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("<p id='melding'>$brukernavn er nå registrert!</p>");
				}
	}

}

?>

<?php
include("slutt.html");

?>