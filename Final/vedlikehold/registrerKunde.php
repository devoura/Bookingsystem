<?php
include("start.html");
?>

<script src="funksjoner.js"></script>

<p><span class="error">* obligatorisk felt.</span></p>

<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt" onSubmit="return validateRegistrerKunde();">
		<input type="text" id="tittel" name="tittel" placeholder="Tittel" maxlength="5"  /><span class="error">* </span><br/>
		<input type="text" id="fornavn" name="fornavn" placeholder="Fornavn" maxlength="45" /><span class="error">* </span><br/>
		<input type="text" id="etternavn"  name="etternavn" placeholder="Etternavn" maxlength="45" /><span class="error">* </span><br/>
		<?php include ("listeboksAlleland.php") ?><br />
		<input type="text" id="by" name="by" placeholder="By" maxlength="45" /><span class="error">* </span><br/>
		<input type="text" id="postnr" name="postnr" placeholder="Postnummer"  maxlength="45" /><span class="error">* </span><br/>
		<input type="text" id="adresse" name="adresse" placeholder="Adresse" maxlength="90" /><span class="error">* </span><br/>
		<input type="text" id="adresse2" name="adresse2" placeholder="Alternativ adresse" maxlength="90" /><br/>
		<input type="text" id="tlfnr" name="tlfnr" placeholder="Telefonnummer" maxlength="90" /><span class="error">* </span><br/>
		<input type="text" id="email" name="email" placeholder="Email" maxlength="45" onSubmit="  "  /><span class="error">* </span><br/>
		<br/>
		<input type="submit" value="Fortsett" id="fortsett" name="fortsett">
		<input type="reset" value="Tøm feltene" id="reset" name="reset">
	
</form>
<p id="melding"></p>


<?php
@$fortsett=$_POST["fortsett"];

if($fortsett)
{
$tittel=$_POST["tittel"];
$fornavn=$_POST["fornavn"];
$etternavn=$_POST["etternavn"];
$land=$_POST["land"];
$by=$_POST["by"];
$postnr=$_POST["postnr"];
$adresse=$_POST["adresse"];
$adresse2=$_POST["adresse2"];
$tlfnr=$_POST["tlfnr"];
$email=$_POST["email"];

$lovligemail=true;
$lovligtlf=true;
$lovligfelt=true;


//sjekker om alle felter fylt ut
if(!$tittel || !$fornavn || !$etternavn || !$by || !$postnr || !$adresse || !$tlfnr || !$email) {
	$lovligfelt=false;
		print("<p id='melding'>Vennligst fyll ut alle feltene.</p>");
  }

  else
		{
		include("eksamentilkobling.php");
		$sqlSetning="SELECT * FROM kundeinfo WHERE email='$email';";
		$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>ikke mulig å hente fra databasen.</p>");
		$antallRader=mysqli_num_rows($sqlResultat);
	
			if($antallRader !=0) /* eller ==1 for primærnøkler*/
			{
			$lovligemail=false;
			print("<p id='melding'>Emailen er allerede registrert</p><br />");
			} 
			if (preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]*$/", $email)){
			}
			else {
			$lovligemail=false;
			print ("<p id='melding'>Ikke gyldig email</p><br />");
			}
			if (preg_match("/^[0-9 ]*$/",$tlfnr)) {
			}
			else {
			$lovligtlf=false;
			print ("<p id='melding'>Telefonnummer kan bare inneholde tall</p><br />");
			}
			if($lovligemail && $lovligtlf && $lovligfelt)
				{
				$sqlSetning="INSERT INTO kundeinfo VALUES ('0','$tittel', '$fornavn', '$etternavn', '$land', '$by', '$postnr', '$adresse', '$adresse2', '$tlfnr', '$email' );";
				mysqli_query($db, $sqlSetning) or die ("<p id='melding'>ikke mulig å registrere informasjonen.</p>"); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("<p id='melding'>$fornavn er nå registrert.</p>");
				}
	}

}

?>

<?php
include("slutt.html");

?>