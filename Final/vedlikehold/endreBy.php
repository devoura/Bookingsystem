<?php include("start.html"); ?>

<form action="" method="post" name="postForm" id="postForm">
Velg by <?php include("listeboksBySlett.php");?>
<input type="submit" value="Fortsett" id="fortsett" name="fortsett">
</form>

<script src="funksjoner.js"></script>

<?php
@$fortsett=$_POST["fortsett"];

if($fortsett)
{
$byID=$_POST["byID"];
$sqlSetning="SELECT * FROM byer WHERE byID='$byID';";
$sqlResultat=mysqli_query($db, $sqlSetning);
$rad=mysqli_fetch_array($sqlResultat);
$byID=$rad["ByID"];
$byNavn=$rad["ByNavn"];
$landID=$rad["LandID"];

print("<form method='post' action='' name='endreSkjema' id='endreSkjema' onSubmit='return bekreft()'/>");
print("Land-ID:<input type='text' value='$landID' name='landID' id='landID' maxlength='2' size='2' readonly /> <br /> ");
print("By-ID: <input type='text' value='$byID' name='byID' id='byID' maxlength='3' size='3' readonly /> <br />");
print("Bynavn<input type='text' value='$byNavn' name='byNavn' id='byNavn' maxlength='45' /> <br />");
print("<input type='submit' value='Endre informasjonen' name='endreBrukerKnapp' id='endreBrukerKnapp'/>");
print("</form>");
}

@$endreBrukerKnapp=$_POST["endreBrukerKnapp"];

if($endreBrukerKnapp)
{
$byID=$_POST["byID"];
$landID=$_POST["landID"];
$byNavn=$_POST["byNavn"];

$lovligfelt=true;



if(!$landID || !$byID || !$byNavn) {
	$lovligfelt=false;
	print("Vennligst fyll ut alle feltene.");
  }

  else
		{

			if($landID && $byID && $byNavn)
			{
			include("eksamentilkobling.php");
			$sqlSetning="UPDATE byer SET byID='$byID', byNavn='$byNavn', landID='$landID' WHERE byID='$byID';";
			mysqli_query($db, $sqlSetning) or die ("Ikke mulig å endre informasjonen. Det finnes <a href='visLandByHotell.php'>registrerte hoteller</a> i denne byen.");
			print("<p id='melding'>Informasjonen er endret.</p>");
			}
	}
	


}

include("slutt.html"); 

?>