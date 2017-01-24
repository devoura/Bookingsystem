<?php include("start.html"); ?>

<form action="" method="post" name="postForm" id="postForm">
Velg kunde <?php include("listeboksKunde.php");?>
<input type="submit" value="Fortsett" id="fortsett" name="fortsett">
</form>

<script src="funksjoner.js"></script>

<?php
@$fortsett=$_POST["fortsett"];

if($fortsett)
{
$kundeID=$_POST["kundeID"];
$sqlSetning="SELECT * FROM kundeinfo WHERE kundeID='$kundeID';";
$sqlResultat=mysqli_query($db, $sqlSetning);
$rad=mysqli_fetch_array($sqlResultat);
$kundeID=$rad["KundeID"];
$tittel=$rad["Tittel"];
$fornavn=$rad["Fornavn"];
$etternavn=$rad["Etternavn"];
$land=$rad["Land"];
$hjemby=$rad["Hjemby"];
$postnr=$rad["postnr"];
$adresse=$rad["Adresse"];
$adresse2=$rad["Adresse2"];
$tlfnr=$rad["TlfNr"];
$email=$rad["Email"];


print("<form method='post' action='' name='endreSkjema' id='endreSkjema' onSubmit='return bekreft();'/>");
print("KundeID<input type='text' value='$kundeID' name='kundeID' id='kundeID' readonly/></br>");
print("Tittel<input type='text' value='$tittel' name='tittel' id='tittel' /> <br />");
print("Fornavn<input type='text' value='$fornavn' name='fornavn' id='fornavn'></br>");
print("Etternavn<input type='text' value='$etternavn' name='etternavn' id='etternavn' required/></br>");
include("listeboksAlleland.php");
print ("Hjemby <input type='text' value='$hjemby' name='hjemby' id='hjemby' /> <br />");
print ("Postnr <input type='text' value='$postnr' name='postnr' id='by' /> <br />");
print ("Adresse <input type='text' value='$adresse' name='adresse' id='adresse' /> <br />");
print ("Alt. adresse <input type='text' value='$adresse2' name='adresse2' id='adresse2' /> <br />");
print ("Tlfnr <input type='text' value='$tlfnr' name='tlfnr' id='tlfnr' /> <br />");
print ("Email <input type='text' value='$email' name='email' id='email' /> <br />");
print("<input type='submit' value='Endre informasjonen' name='endreBrukerKnapp' id='endreBrukerKnapp'/>");
print("</form>");
}

@$endreBrukerKnapp=$_POST["endreBrukerKnapp"];

if($endreBrukerKnapp)
{
$tittel=$_POST["tittel"];
$fornavn=$_POST["fornavn"];
$etternavn=$_POST["etternavn"];
$land=$_POST["land"];
$hjemby=$_POST["hjemby"];
$postnr=$_POST["postnr"];
$adresse=$_POST["adresse"];
$adresse2=$_POST["adresse2"];
$tlfnr=$_POST["tlfnr"];
$email=$_POST["email"];

$lovligemail=true;
$lovligtlf=true;
$lovligfelt=true;



if(!$tittel || !$fornavn || !$etternavn || !$hjemby || !$postnr || !$adresse || !$tlfnr || !$email) {
	$lovligfelt=false;
		print("Vennligst fyll ut alle feltene.");
  }

  else
		{
		include("eksamentilkobling.php");
		$sqlSetning="SELECT * FROM kundeinfo WHERE email='$email';";
		$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen");
		$antallRader=mysqli_num_rows($sqlResultat);
	
			//if($antallRader !=0) /* eller ==1 for primærnøkler*/
			/*{
			$lovligemail=false;
			print("<p id='melding'>Emailen er allerede registrert</p><br />");
			} */
			if (preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]*$/", $email)){
			}
			else {
			$lovligemail=false;
			print ("<p id='melding'>Ikke gyldig email</p><br />");
			}

			if (is_nan($tlfnr)) {
			$lovligtlf=false;
			print ("<p id='melding'>Telefonnummer kan bare inneholde tall</p><br />");
			}

			if($lovligemail && $lovligtlf && $lovligfelt)
			{
			$sqlSetning="UPDATE kundeinfo SET kundeID='$kundeID', tittel='$tittel', fornavn='$fornavn', etternavn='$etternavn', land='$land', hjemby='$hjemby', postnr='$postnr', adresse='$adresse', adresse2='$adresse2', tlfnr='$tlfnr', email='$email' WHERE kundeID='$kundeID';";
			mysqli_query($db, $sqlSetning) or die ("Ikke mulig å endre informasjonen.");
			print("<p id='melding'>Informasjonen er endret.</p>");
			}
	}
	


}

include("slutt.html"); 

?>