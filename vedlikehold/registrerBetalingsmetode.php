<?php
include("start.html");
?>

<script src="funksjoner.js"> </script>
 
<h2>Registrer betalingsmetode</h2>
<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt" onSubmit="return validateBetalingsmetode();" >
	<input type="text" id="metodeID" name="metodeID" placeholder="ID for betalingsmetoden" maxlength="4"  /><i>4 tegn</i><br/>
	<input type="text" id="metodeNavn" name="metodeNavn" placeholder="Navn på betalingsmetoden" maxlength="45" /> <br />
	<input type="submit" value="Fortsett" id="fortsett" name="fortsett">
</form>

<p id="melding"></p>

<?php
@$fortsett=$_POST["fortsett"];


if($fortsett)
{
$metodeID=$_POST["metodeID"];
$metodeNavn=$_POST["metodeNavn"];


$lovligMetodeID=true;


if(!$metodeID || !$metodeNavn)
    {
    $lovligmetodeID=false;
    die("<p id='melding'>Alle feltene må fylles ut.</p>");
    }
       

if (strlen($metodeID)!=4)
{
	$lovligmetodeID=false;
	die("<p id='melding'>ID må bestå av 4 tegn.</p>");
}


 
if($lovligMetodeID && $metodeNavn)
		{
		include("eksamentilkobling.php");
		$sqlSetning="SELECT * FROM betalingsmetode WHERE MetodeID='$metodeID';";
		$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>Ikke mulig å hente fra databasen</p>");
		$antallRader=mysqli_num_rows($sqlResultat);
	
			if($antallRader==1) /* eller ==1 for primærnøkler*/
			{
			print("<p id='melding'>MetodeID er allerede registrert, duplikater er ikke tillatt.</p>");
			} /* -||-*/

			else
			{
				$metodeID=strtoupper($metodeID);
				$sqlSetning="INSERT INTO betalingsmetode VALUES ('$metodeID', '$metodeNavn');";
				mysqli_query($db, $sqlSetning) or die ("<p id='melding'>Ikke mulig å registrere informasjonen.</p>"); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("<p id='melding'>Følgende betalingsmetode er nå registrert:<br/> $metodeID, $metodeNavn</p><br/>");
			}
		}

}

include ("slutt.html");

?>