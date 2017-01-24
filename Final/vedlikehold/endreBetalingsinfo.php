<?php include("start.html"); ?>

<script src="funksjoner.js"></script>

<br> <br><form action="" method="post" name="postForm" id="postForm">
Velg Betalingsinfo <?php include("listeboksBetalingsinfoSlett.php");?>
<input type="submit" value="Fortsett" id="fortsett" name="fortsett">
</form>

<?php
@$fortsett=$_POST["fortsett"];

if($fortsett)
{
$betalingsID=$_POST["betalingsID"];
$sqlSetning="SELECT * FROM betalingsinfo WHERE betalingsID='$betalingsID';";
$sqlResultat=mysqli_query($db, $sqlSetning);
$rad=mysqli_fetch_array($sqlResultat);
$kundeID=$rad["KundeID"];
$metodeID=$rad["MetodeID"];
$kortholder=$rad["Kortholder"];
$kortnummer=$rad["Kortnummer"];
$CVV=$rad["CVV"];
$utgangsMaaned=$rad["UtgangsdatoMaaned"];
$utgangsAar=$rad["UtgangsdatoAar"];
$totalPris=$rad["TotalPris"];


print("<form method='post' action='' name='endreSkjema' id='endreSkjema' onSubmit='return bekreft();'/>");
print("<table><tr><td>BetalingsID</td><td><input type='text' value='$betalingsID' name='betalingsID' id='betalingsID' readonly/></td></tr>");
print("<tr><td>kundeID</td><td><input type='number' value='$kundeID' name='kundeID' id='kundeID'/></td></tr>");
print("<tr><td>MetodeID</td><td><input type='text' value='$metodeID' name='metodeID' id='metodeID' /></td></tr>");
print("<tr><td>Kortholder</td><td><input type='text' value='$kortholder' name='kortholder' id='kortholder' /></td></tr>");
print("<tr><td>Kortnummer</td><td><input type='number' maxlength='16' value='$kortnummer' name='kortnummer' id='kortnummer' /></td></tr>");
print("<tr><td>CVV</td><td><input type='number' maxlength ='3' value='$CVV' name='CVV' id='CVV' /></td></tr>");
print("<tr><td>Utløpsdato: </td><td>");  include ("listeboksMaaned.php"); include ("listeboksAar.php"); print(" (var $utgangsMaaned / $utgangsAar)</td> </tr>");
//print("<tr><td>Utgangsmåned </td><td><input type='number' maxlength='2'  value='$utgangsMaaned' name='utgangsMaaned' id='utgangsMaaned' /></td></tr>");
//print("<tr><td>Utgangsår </td><td><input type='number' maxlength='2'  value='$utgangsAar' name='utgangsAar' id='utgangsAar' /></td></tr>");
print("<tr><td>Total pris </td><td><input type='number' value='$totalPris' name='totalPris' id='totalPris' /></td></tr>");
print("<tr><td><input type='submit' value='Endre informasjonen' name='endreBrukerKnapp' id='endreBrukerKnapp'/></td></tr></table>");
print("</form>");
}

@$endreBrukerKnapp=$_POST["endreBrukerKnapp"];

if($endreBrukerKnapp)
{
	
$betalingsID=$_POST["betalingsID"];
$kundeID=$rad["kundeID"];
$metodeID=$rad["metodeID"];
$kortholder=$rad["kortholder"];
$kortnummer=$rad["kortnummer"];
$CVV=$rad["CVV"];
$utgangsMaaned=$rad["utgangsMaaned"];
$utgangsAar=$rad["utgangsAar"];
$totalPris=$rad["totalPris"];

$lovligemail=true;
$lovligtlf=true;
$lovligfelt=true;



if(!$betalingsID || !$kundeID || !$metodeID || !$kortholder || !$kortnummer || !$CVV || !$utgangsMaaned || !$utgangsAar || !$totalPris) {
	$lovligfelt=false;
		print("<p id ='melding'>'Vennligst fyll ut alle feltene.</p>");
  }
  
  else if (!is_numeric($kortnummer)){
	die ("<p id='melding'>Kortnummer må bare inneholde tall.</p>");
	}
	else if (!is_numeric($CVV)){
	die ("<p id='melding'>CVV må bare inneholde tall.</p>");
	}
	else if (!is_numeric($totalPris)){
	die ("<p id='melding'>Totalpris må bare inneholde tall.</p>");
	}

  else
		{
		include("eksamentilkobling.php");

			$sqlSetning="UPDATE betalingsinfo SET kundeID='$kundeID', MetodeID='$metodeID', Kortholder='$kortholder', Kortnummer='$kortnummer', CVV='$CVV', UtgangsdatoMaaned='$utgangsMaaned',
				UtgangsdatoAar ='$utgangsAar', TotalPris='$totalPris' WHERE betalingsID='$betalingsID';";
			mysqli_query($db, $sqlSetning) or die ("Ikke mulig å endre informasjonen.");
			print("<p id='melding'>Informasjonen er endret.</p>");
			}
	}
	
	



include("slutt.html"); 

?>