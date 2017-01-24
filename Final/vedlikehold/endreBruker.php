<?php include("start.html"); ?>

<script src="funksjoner.js"></script>

<br> <br><form action="" method="post" name="postForm" id="postForm">
Velg Bruker <?php include("listeboksBrukerSlett.php");?>
<input type="submit" value="Fortsett" id="fortsett" name="fortsett">
</form>

<?php
@$fortsett=$_POST["fortsett"];

if($fortsett)
{
$brukernavn=$_POST["brukernavn"];
$sqlSetning="SELECT * FROM admin WHERE BrukerNavn='$brukernavn';";
$sqlResultat=mysqli_query($db, $sqlSetning);
$rad=mysqli_fetch_array($sqlResultat);
$brukernavn=$rad["BrukerNavn"];
$passord=$rad["Passord"];


print("<form method='post' action='' name='endreSkjema' id='endreSkjema' onSubmit='return bekreft();'/>");
print("<table><tr><td>brukernavn</td><td><input type='text' value='$brukernavn' name='brukernavn' id='brukernavn' readonly/></td></tr>");
print("<tr><td>passord</td><td><input type='password' value='$passord' name='passord' id='passord' /></td></tr>");
print("<tr><td><input type='submit' value='Endre informasjonen' name='endreBrukerKnapp' id='endreBrukerKnapp'/></td></tr></table>");
print("</form>");
}

@$endreBrukerKnapp=$_POST["endreBrukerKnapp"];

if($endreBrukerKnapp)
{
$brukernavn=$_POST["brukernavn"];
$passord=$_POST["passord"];


$lovligemail=true;
$lovligtlf=true;
$lovligfelt=true;



if(!$brukernavn || !$passord ) {
	$lovligfelt=false;
		print("Vennligst fyll ut alle feltene.");
  }

  else
		{
		include("eksamentilkobling.php");

			$sqlSetning="UPDATE admin SET BrukerNavn='$brukernavn', Passord='$passord' WHERE BrukerNavn='$brukernavn';";
			mysqli_query($db, $sqlSetning) or die ("Ikke mulig å endre informasjonen.");
			print("<p id='melding'>Informasjonen er endret.</p>");
			}
	}
	
	



include("slutt.html"); 

?>