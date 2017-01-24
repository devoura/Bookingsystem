<?php include("start.html"); ?>

<script src="funksjoner.js"></script>

<br> <br><form action="" method="post" name="postForm" id="postForm">
Velg Betalingsmetode <?php include("listeboksBetalingsmetode.php");?>
<input type="submit" value="Fortsett" id="fortsett" name="fortsett">
</form>

<?php
@$fortsett=$_POST["fortsett"];

if($fortsett)
{
$metodeID=$_POST["metodeID"];
$sqlSetning="SELECT * FROM betalingsmetode WHERE metodeID='$metodeID';";
$sqlResultat=mysqli_query($db, $sqlSetning);
$rad=mysqli_fetch_array($sqlResultat);
$metodeNavn=$rad["MetodeNavn"];




print("<form method='post' action='' name='endreSkjema' id='endreSkjema' onSubmit='return bekreft();'/>");
print("<table><tr><td>Metode ID</td><td><input type='text' value='$metodeID' name='metodeID' id='metodeID' readonly/></td></tr>");
print("<tr><td>Metodenavn</td><td><input type='text' value='$metodeNavn' name='metodeNavn' id='metodeNavn'/></td></tr>");
print("<tr><td><input type='submit' value='Endre informasjonen' name='endreBrukerKnapp' id='endreBrukerKnapp'/></td></tr></table>");
print("</form>");
}

@$endreBrukerKnapp=$_POST["endreBrukerKnapp"];

if($endreBrukerKnapp)
{
	
$metodeID=$_POST["metodeID"];
$metodeNavn=$_POST["metodeNavn"];




if(!$metodeID || !$metodeNavn ) {
	$lovligfelt=false;
		print("<p id ='melding'>'Vennligst fyll ut alle feltene.</p>");
  }


  else
		{
		include("eksamentilkobling.php");

			$sqlSetning="UPDATE betalingsmetode SET MetodeNavn='$metodeNavn' WHERE metodeID='$metodeID';";
			mysqli_query($db, $sqlSetning) or die ("Ikke mulig å endre informasjonen.");
			print("<p id='melding'>Informasjonen er endret.</p>");
			}
	}
	
	



include("slutt.html"); 

?>