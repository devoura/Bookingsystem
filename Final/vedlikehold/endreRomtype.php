<?php include("start.html"); ?>
<script src="funksjoner.js"></script>

<form action="" method="post" name="tekstfelt" id="tekstfelt">
Velg romtype <?php include("listeboksRomtyper.php");?>
<input type="submit" value="Fortsett" id="fortsett" name="fortsett">
</form>

<?php
@$fortsett=$_POST["fortsett"];

if($fortsett){
$romtypeID=$_POST ["romtypeID"];
$sqlSetning="SELECT * FROM romtyper WHERE RomtypeID='$romtypeID';";
$sqlResultat=mysqli_query ($db, $sqlSetning) or die (mysqli_error($db));
$rad=mysqli_fetch_array($sqlResultat);

$romtypeID=$rad["RomtypeID"];
$romtype=$rad["Romtype"];
$prisPerDogn=$rad["PrisPerDogn"];

print ("<table>");
print("<form method='post' action='' name='endreSkjema' id='endreSkjema' onSubmit='return bekreft();'/>");
print("<tr><td>Romtype ID</td><td><input type='text' value='$romtypeID' name='romtypeID' id='romtypeID' readonly /></td></tr><br />");
print("<tr><td>Romtype</td><td><input type='text' value='$romtype' name='romtype' id='romtype' /> <br />");
print("<tr><td>Pris per døgn</td><td><input type='text' value='$prisPerDogn' name='prisPerDogn' id='prisPerDogn'><br />");
print("<tr><td></td><td><input type='submit' value='Endre informasjonen' name='endreInfoKnapp' id='endreInfoKnapp'/></td>");
print("</form></table>");
}

@$endreInfoKnapp=$_POST["endreInfoKnapp"];

if($endreInfoKnapp)
{
$romtypeID=$_POST["romtypeID"];
$romtype=$_POST["romtype"];
$prisPerDogn=$_POST["prisPerDogn"];

$lovligromtypeID=true;
$lovligromtype=true;
$lovligprisPerDogn=true;
$lovligfelt=true;



if(!$romtypeID || !$romtype || !$prisPerDogn) {
	$lovligfelt=false;
		print("Vennligst fyll ut alle feltene.");
  }

  else
		{
		include("eksamentilkobling.php");
		//$sqlSetning="SELECT * FROM romtyper WHERE RomtypeID='$romtypeID';";
		//$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen");
		//$antallRader=mysqli_num_rows($sqlResultat);
	
			//if($antallRader !=0) /* eller ==1 for primærnøkler*/
			//{
			//$lovligromtypeID=false;
			//print("<p id='melding'>ID er allerede registrert</p><br />");
			//} 
			
			/* vet ikke hva constraints er i databasen? paa romtypeID og navn*/
			
			if ($romtype){
				
			}

			if (!is_numeric($prisPerDogn)) {
			$lovligprisPerDogn=false;
			print ("<p id='melding'>Pris kan bare inneholde tall</p><br />");
			}

			if($lovligromtypeID && $lovligromtype && $lovligprisPerDogn)
			{
			$sqlSetning="UPDATE romtyper SET RomtypeID='$romtypeID', Romtype='$romtype', PrisPerDogn='$prisPerDogn' WHERE romtypeID='$romtypeID';";
			mysqli_query($db, $sqlSetning) or die ("Ikke mulig å endre informasjonen.");
			print("<p id='melding'>Informasjonen er endret.</p>");
			}
	}
	


}

include("slutt.html"); 

?>
