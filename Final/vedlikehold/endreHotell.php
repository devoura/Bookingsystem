<?php include("start.html"); ?>

<script src="funksjoner.js"></script>

<br> <br><form action="" method="post" name="postForm" id="postForm">
Velg Hotell <?php include("listeboksHotell.php");?>
<input type="submit" value="Fortsett" id="fortsett" name="fortsett">
</form>

<?php
@$fortsett=$_POST["fortsett"];

if($fortsett)
{
$hotellID=$_POST["HotellID"];
$sqlSetning="SELECT * FROM hotell WHERE HotellID='$hotellID';";
$sqlResultat=mysqli_query($db, $sqlSetning);
$rad=mysqli_fetch_array($sqlResultat);
$byID=$rad["ByID"];
$hotellNavn=$rad["HotellNavn"];
$frokost=$rad["TilbyrFrokost"];
$frokostPris=$rad["FrokostPris"];

$frokostBool = true;

if($frokost == 0 ){$frokostBool = false;}




print("<form method='post' action='' name='endreSkjema' id='endreSkjema' onSubmit='return bekreft();'/>");
print("<table><tr><td>Hotell ID</td><td><input type='text'value='$hotellID' name='hotellID' id='hotellID' readonly/></td></tr>");
print("<tr><td>By ID</td><td><input type='text' value='$byID' name='byID' id='byID' maxlength='3'/></td></tr>");
print("<tr><td>Hotellnavn</td><td><input type='text' value='$hotellNavn' name='hotellNavn' id='hotellNavn'/></td></tr>");
print("<tr><td>Tilbys frokost? </td><td> Ja 

<input type='radio' id='tilbyrFrokostJa' name='tilbyrFrokost' value='1'");

 if ($frokostBool){ print("checked"); }
 print("
 />
		Nei <input type='radio' id='tilbyrFrokostNei' name='tilbyrFrokost' value='0'");
		 if (!$frokostBool){ print("checked"); }
 print("
		/><br/>

</td></tr>");
print("<tr><td>Frokostpris</td><td><input type='text' value='$frokostPris' name='frokostPris' id='frokostPris'/></td></tr>");

print("<tr><td><input type='submit' value='Endre informasjonen' name='endreBrukerKnapp' id='endreBrukerKnapp'/></td></tr></table>");
print("</form>");
}

@$endreBrukerKnapp=$_POST["endreBrukerKnapp"];

if($endreBrukerKnapp)
{
	
$hotellID=$_POST["hotellID"];
$byID=$_POST["byID"];
$hotellNavn=$_POST["hotellNavn"];
$frokost=$_POST["tilbyrFrokost"];
$frokostPris=$_POST["frokostPris"];



if($frokost == 0 && $frokostPris){
	die("<p id='melding'> Du kan ikke skrive inn pris uten å tilby frokost!");
	
}
if(!$frokost == 0){
	$frokostPris = 0;
}

else if(!$frokostPris){
	$frokostPris = 0;
	
}






if(!$byID || !$hotellNavn ) {
	$lovligfelt=false;
		print("<p id ='melding'>'Vennligst fyll ut alle feltene.</p>");
  }
  



  else
		{
		include("eksamentilkobling.php");

			$sqlSetning="UPDATE hotell SET ByID='$byID', HotellNavn ='$hotellNavn', TilbyrFrokost='$frokost', FrokostPris='$frokostPris' WHERE HotellID='$hotellID';";
			mysqli_query($db, $sqlSetning) or die (mysqli_error($db));
			//Ikke mulig å endre informasjonen.");
			print("<p id='melding'>Informasjonen er endret.</p>");
			}
	}
	
	



include("slutt.html"); 

?>