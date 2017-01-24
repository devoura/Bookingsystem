<?php include("start.html"); ?>

<script src="funksjoner.js"></script>

<br> <br><form action="" method="post" name="postForm" id="postForm">
Velg Land <?php include("listeboksLand.php");?>
<input type="submit" value="Fortsett" id="fortsett" name="fortsett">
</form>

<?php
@$fortsett=$_POST["fortsett"];

if($fortsett)
{
$landID=$_POST["landListe"];

$sqlSetning="SELECT * FROM land WHERE landID='$landID';";
$sqlResultat=mysqli_query($db, $sqlSetning);
$rad=mysqli_fetch_array($sqlResultat);
$landNavn=$rad["LandNavn"];


print("<form method='post' action='' name='endreSkjema' id='endreSkjema' onSubmit='return bekreft();'/>");
print("<table><tr><td>Land ID</td><td><input type='text'value='$landID' name='landID' id='landID' readonly/></td></tr>");
print("<tr><td>Landnavn</td><td><input type='text' value='$landNavn' name='landNavn' id='landNavn'/></td></tr>");
print("<tr><td><input type='submit' value='Endre informasjonen' name='endreBrukerKnapp' id='endreBrukerKnapp'/></td></tr></table>");
print("</form>");
}

@$endreBrukerKnapp=$_POST["endreBrukerKnapp"];

if($endreBrukerKnapp)
{
	
$landID=$_POST["landID"];
$landNavn=$_POST["landNavn"];



if(!$landNavn) {

		die("<p id ='melding'>'Vennligst fyll ut alle feltene.</p>");
  }
  

  else
		{
		include("eksamentilkobling.php");

			$sqlSetning="UPDATE land SET landNavn='$landNavn' WHERE LandID='$landID';";
			mysqli_query($db, $sqlSetning) or die (mysqli_error($db));
			//Ikke mulig å endre informasjonen.");
			print("<p id='melding'>Informasjonen er endret.</p>");
			}
	}
	
	



include("slutt.html"); 

?>