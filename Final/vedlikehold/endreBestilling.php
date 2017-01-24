<?php include("start.html"); ?>

<script src="funksjoner.js"></script>

<br> <br><form action="" method="post" name="postForm" id="postForm">
Velg Bestilling <?php include("listeboksBestillingSlett.php");?>
<input type="submit" value="Fortsett" id="fortsett" name="fortsett">
</form>

<?php
@$fortsett=$_POST["fortsett"];

if($fortsett)
{
$bestillingID=$_POST["bestillingID"];

$sqlSetning="SELECT * FROM bestilling WHERE BestillingID='$bestillingID';";
$sqlResultat=mysqli_query($db, $sqlSetning);
$rad=mysqli_fetch_array($sqlResultat);
$hotellID=$rad["HotellID"];
$kundeID=$rad["KundeID"];
$betalingsID=$rad["BetalingsID"];
$pris=$rad["Pris"];
$romtypeID=$rad["RomtypeID"];
$datoAnkomst=$rad["DatoAnkomst"];
$datoAvreise=$rad["DatoAvreise"];
$frokost=$rad["Frokost"];
$tilstand=$rad["Tilstand"];






	


print("<form method='post' action='' name='endreSkjema' id='endreSkjema' onSubmit='return bekreft();'/>");

print("<table><tr><td>Bestillings ID</td><td> <td><input type='number 'value='$bestillingID' name='bestillingID' id='bestillingID' readonly/></td></tr>");
print("<tr><td>");
include("listeboksHotell.php");print(" (var $hotellID) </td></tr>"); print("<tr><td>"); 
	include("listeboksKunde.php"); print(" (var $kundeID)</td></tr>"); print("<tr><td>");  
include("listeboksBetalingsinfoSlett.php");  print(" (var $betalingsID)</td></tr>"); print("<tr><td>");
	include("listeboksRomtyper.php");  print("( var $romtypeID)</td></tr>");
	
	print("<tr><td> <input type='number' id='pris' name='pris' /> <i>pris for bestillingen</i> (var $pris)</</td></tr>
	<tr><td><input type='date' id='datoAnkomst' name='datoAnkomst' /> <i>Dato for ankomst</i> (var $datoAnkomst)</td></tr> <tr> <td>
");

			if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') == false) //sjekker om nettleseren ikke er chrome....
			{
  			 print('<em>YYYY-MM-DD</em> <br />');
			}
			
	print("   </br>
</td></tr><tr><td>
	<input type='date' id='datoAvreise' name='datoAvreise' /> <i>Dato for avreise</i> (var $datoAvreise) <tr> <td

	");
			if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') == false) //sjekker om nettleseren ikke er chrome....
			{
  			 print('<em>YYYY-MM-DD</em> <br />');
			}
	print("
	</td></tr>
	<tr> <td> <input type='checkbox' id='frokost' name='frokost' /> <i>Frokost?</i> </td> </tr>
	");

print("<tr><td><input type='submit' value='Endre informasjonen' name='endreBrukerKnapp' id='endreBrukerKnapp'/></td></tr></table>");
print("</form>");
}

@$endreBrukerKnapp=$_POST["endreBrukerKnapp"];

if($endreBrukerKnapp)
{
	
$bestillingID=$_POST["bestillingID"];
$hotellID=$_POST["HotellID"];
$kundeID=$_POST["kundeID"];
$betalingsID=$_POST["betalingsID"];
$romtype=$_POST["romtypeID"];
$pris=$_POST["pris"];
$datoAnkomst=$_POST["datoAnkomst"];
$datoAvreise=$_POST["datoAvreise"];
@$frokost=$_POST["frokost"];

if (isset($_POST['frokost']))  
                                {

                                    $frokost=1;
                                    
                                }

                               else
                               {
                               		$frokost=0;
                               }
							   
							   
							   
  if(!$pris || !$datoAvreise || !$datoAnkomst ){
	 print("<p id='melding'> Alle felt må fylles ut </p>");
 }


  else
		{
		include("eksamentilkobling.php");

			$sqlSetning="UPDATE bestilling SET HotellID='$hotellID', KundeID='$kundeID', BetalingsID='$betalingsID', RomtypeID='$romtype', Pris='$pris', DatoAnkomst='$datoAnkomst', DatoAvreise='$datoAvreise',
				Frokost ='$frokost' WHERE BestillingID='$bestillingID';";			
			mysqli_query($db, $sqlSetning) or die (mysqli_error($db));
			//Ikke mulig å endre informasjonen.");
			print("<p id='melding'>Informasjonen er endret.</p>");
			}
	}
	
	



include("slutt.html"); 

?>