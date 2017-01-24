<?php
include("start.html"); /*inkluder meny*/
?>

<script src="funksjoner.js"></script>

<h2>Registrer:</h2>
<p>Her kan du registrere et nytt hotell.<br /> Du må først angi hotellets beliggenhet.</p><br />
<h3>Land</h3>
<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt" onSubmit="return validateLand();">
		<input type="text" id="landID" name="landID" placeholder="Land-ID" maxlength="2"  /><br/>
		<input type="text" id="landNavn" name="landNavn" placeholder="Navn på landet" /><br/>
		<input type="submit" value="Fortsett" id="fortsett" name="fortsett">

	
</form>

<p id="melding"></p>



<?php
@$fortsett=$_POST["fortsett"];


if($fortsett) 
{
$landID=$_POST["landID"];
$landNavn=$_POST["landNavn"];

$lovliglandID=true;
$lovliglandNavn=true;


if(!$landID)
    {
    $lovliglandID=false;
    print("<p id='melding'>Land-id må fylles ut.</p><br />");
    }
       

if ( preg_match("/[A-ZÆØÅa-zæøå]{2}/" , $landID) )  /*sjekker om landID er to store bokstaver, om javascript er slått av (toUpperCase) */
    {
	
    }

else{ 
    $lovliglandID=false;
    print ("<p id='melding'>Ugyldig land-ID.</p><br />");
    }/*landID er ikke to store bokstaver*/
     
if (!$landNavn)
    {
    $lovliglandNavn=false;
    print ("<p id='melding'>Navn på land må fylles ut.</p><br />");
    }   
 
if($lovliglandID && $lovliglandNavn)
		{
		include("eksamentilkobling.php");
		$sqlSetning="SELECT * FROM land WHERE landID='$landID';";
		$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>ikke mulig å hente fra databasen.</p>");
		$antallRader=mysqli_num_rows($sqlResultat);
	
			if($antallRader==1) /* eller ==1 for primærnøkler*/
			{
			print("<p id='melding'>Land-ID er allerede registrert, duplikater er ikke tillatt.</p>");
			} /* -||-*/
			
				else
				{
				$landID=strtoupper($landID);
				$sqlSetning="INSERT INTO land VALUES ('$landID', '$landNavn');";
				mysqli_query($db, $sqlSetning) or die ("<p id='melding'>Ikke mulig å registrere informasjonen.</p>"); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("<p id='melding'>Følgende land er nå registrert:<br/> $landID $landNavn</p><br/>");
				}
		}
		
	}


?>

<hr>

<script src="funksjoner.js"> </script>

<h3>By</h3>
<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt" onSubmit="return validateBy();">
		<?php include("listeboksLand.php"); ?>
		<input type="text" id="byID" name="byID" placeholder="By-ID, 3 tegn" maxlength="3"/><br/>
		<input type="text" id="byNavn" name="byNavn" placeholder="Navn på byen" /><br/>
		<input type="submit" value="Fortsett" id="fortsettBy" name="fortsettBy">
</form>

<p id="melding"> </p>

<?php
@$fortsettBy=$_POST["fortsettBy"];


if($fortsettBy)
{
$byID=$_POST["byID"];
$byNavn=$_POST["byNavn"];

$lovligbyID=true;
$lovligbyNavn=true;


if(!$byID)
    {
    $lovligbyID=false;
    print("<p id='melding'>By-ID må fylles ut.</p><br />");
    }
       

if ( preg_match("/[A-ZÆØÅa-zæøå]{3}/" , $byID) )  /*sjekker om byID er tre store bokstaver, om javascript er slått av (toUpperCase) */
    {
     
    }

else{
    $lovligbyID=false;
    print ("<p id='melding'>Ugyldig By-ID</p><br />");
    }
     
if (!$byNavn)
    {
    $lovligbyNavn=false;
    print ("<p id='melding'>By navnet må fylles ut.</p><br />");
    }   
 
if($lovligbyID && $lovligbyNavn)
		{
		include("eksamentilkobling.php");
		$sqlSetning="SELECT * FROM byer WHERE byID='$byID';";
		$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>ikke mulig å hente fra databasen</p>");
		$antallRader=mysqli_num_rows($sqlResultat);
	
			if($antallRader==1) /* eller ==1 for primærnøkler*/
			{
			print("<p id='melding'>by-ID er allerede registrert, duplikater er ikke tillatt.</p>");
			} /* -||-*/
			
				else
				{
				$byID=strtoupper($byID);
				$sqlSetning="INSERT INTO byer VALUES ('$byID', '$byNavn', '$landID');";
				mysqli_query($db, $sqlSetning) or die ("<p id='melding'>ikke mulig å registrere informasjonen.</p>"); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("<p id='melding'>Følgende by er nå registrert:<br/> $byID $byNavn</p><br/>");
				}
		}
		
	}




?>

<hr>
<h3>Hotell</h3>
<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt" onSubmit="return validateBestilling();">
		<?php include("listeboksBy.php"); ?>
		<input type="text" id="hotellID" name="hotellID" placeholder="Hotellets ID"  /><i>3 bokstaver etterfulgt av 1 siffer.</i><br/>
		<input type="text" id="hotellNavn" name="hotellNavn" placeholder="Hotellets navn" /><br/>
		Er frokost inkludert?
		<input type='hidden' value='0' name='tilbyrFrokost'>
		<input type="checkbox" id="tilbyrFrokost" name="tilbyrFrokost" value="1" checked /><br/>
		<input type="submit" value="Fortsett" id="fortsettHotell" name="fortsettHotell">
</form>


<?php
@$fortsettHotell=$_POST["fortsettHotell"];

if($fortsettHotell)
{

$byID=$_POST["byListe"];
$hotellID=$_POST["hotellID"];
$hotellNavn=$_POST["hotellNavn"];
$tilbyrFrokost=$_POST["tilbyrFrokost"];

$lovlighotellNavn=true;
$lovlighotellID=true;
$lovligtilbyrFrokost=true;

if(!$hotellID)
    {
    $lovlighotellID=false;
    print("<p id='melding'>Hotell-ID må fylles ut.</p><br />");
    }
       

if ( preg_match("/[A-ZÆØÅa-zæøå]{3,}[1-99]/" , $hotellID) )  /*sjekker om hotellID er tre store bokstaver etterfulgt av et tall mellom 1 og 100 */
    {
     
    }

else{
    $lovlighotellID=false;
    print ("<p id='melding'>Ugyldig hotell-ID.</p><br />");
    }


if (!$hotellNavn)
    {
    $lovlighotellNavn=false;
    print ("<p id='melding'>Hotellnavnet må fylles ut</p>.<br />");
    } 

 
if($lovlighotellNavn && $lovlighotellID && $tilbyrFrokost)
		{
		include("eksamentilkobling.php");
		$sqlSetning="SELECT * FROM hotell WHERE hotellID='$hotellID';";
		$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>ikke mulig å hente fra databasen.</p>");
		$antallRader=mysqli_num_rows($sqlResultat);
	
			if($antallRader==1) /* eller ==1 for primærnøkler*/
			{
			print("<p id='melding'>Kombinasjonen av by og hotell er allerede registrert, duplikater er ikke tillatt.</p>");
			} /* -||-*/

			else
			{
				$hotellID=strtoupper($hotellID);
				$sqlSetning="INSERT INTO hotell VALUES ('$hotellID', '$byID', '$hotellNavn', '$tilbyrFrokost');";

				mysqli_query($db, $sqlSetning) or die ("<p id='melding'>Ikke mulig å registrere informasjonen.</p>"); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("<p id='melding'>Følgende hotell er nå registrert:<br/> $hotellID $hotellNavn</p><br/>");
			}
		}



}
include ("slutt.html");
?>



