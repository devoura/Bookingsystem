
<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt">
		<?php include("listeboksBy.php"); ?>
		<input type="text" id="hotellID" name="hotellID" placeholder="Hotellets ID" required/><br/>
		<input type="text" id="hotellNavn" name="hotellNavn" placeholder="Hotellets navn" required/><br/>
		<p>Er frokost inkludert?</p><br />
		<input type="radio" id="tilbyrFrokostJa" name="tilbyrFrokostJa" value="Ja" checked/><br/>
		<input type="radio" id="tilbyrFrokostNei" name="tilbyrFrokostNei" value="Nei"/><br/>
		<input type="submit" value="Fortsett" id="fortsett" name="fortsett">
		<input type="reset" value="Tøm feltene" id="reset" name="reset">	
</form>



<?php
@$fortsettBy=$_POST["fortsett"];


if($fortsett)
{
$byID=$_POST["byID"];
$byNavn=$_POST["byNavn"];
$hotellID=$_POST["hotellID"];
$hotellNavn=$_POST["hotellNavn"];
$tilbyrFrokostJa=$_POST["tilbyrFrokostJa"];
$tilbyrFrokostNei=$_POST["tilbyrFrokostNei"];

$lovlighotellNavn=true;
$lovlighotellID=true;
$lovligtilbyrFrokost=true;

if(!$hotellID)
    {
    $lovligbyID=false;
    print("land-id må fylles ut.<br />");
    }
       

if ( preg_match("/[A-ZÆØÅ] {3,} [1-99]/" , $hotellID) )  /*sjekker om hotellID er tre store bokstaver etterfulgt av et tall mellom 1 og 100 */
    {
     
    }

else{
    $lovlighotellID=false;
    print ("Ugyldig hotell-ID<br />");
    }


if (!$hotellNavn)
    {
    $lovlighotellNavn=false;
    print ("Hotellnavnet må fylles ut.<br />");
    } 

if(!$tilbyrFrokostJa || !$tilbyrFrokostNei)  /*sjekker om en radioknapp er huket av. ja er huket som default. om den aeeag ikke er det, stoppes prosessen her*/
{
	$lovligtilbyrFrokost=false;
	print("Huk av om hotellet tilbyr frokost eller ikke.");
}
 
if($lovlighotellNavn && $lovlighotellID && $tilbyrFrokostJa)
		{
		include("eksamentilkobling.php");
		$sqlSetning="SELECT * FROM hotell WHERE byID='$byID' AND hotellID='$hotellID';";
		$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen");
		$antallRader=mysqli_num_rows($sqlResultat);
	
			if($antallRader==1) /* eller ==1 for primærnøkler*/
			{
			print("Kombinasjonen av by og hotell er allerede registrert, duplikater er ikke tillatt.");
			} /* -||-*/

			else
			{
				$sqlSetning="INSERT INTO hotell VALUES ('$byID', '$hotellID', '$hotellNavn', TRUE);";
				mysqli_query($db, $sqlSetning) or die ("Ikke mulig å registrere informasjonen."); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("Følgende hotell er nå registrert:<br/> $hotellID $hotellNavn<br/>");
			}
		}


else if($lovlighotellNavn && $lovlighotellID && $tilbyrFrokostNei)
		{
		include("eksamentilkobling.php");
		$sqlSetning="SELECT * FROM hotell WHERE byID='$byID' AND hotellID='$hotellID';";
		$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen");
		$antallRader=mysqli_num_rows($sqlResultat);
	
			if($antallRader==1) /* eller ==1 for primærnøkler*/
			{
			print("Kombinasjonen av by og hotell er allerede registrert, duplikater er ikke tillatt.");
			} /* -||-*/

			else
			{
				$sqlSetning="INSERT INTO hotell VALUES ('$byID', '$hotellID', '$hotellNavn', FALSE);";
				mysqli_query($db, $sqlSetning) or die ("Ikke mulig å registrere informasjonen."); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("Følgende hotell er nå registrert:<br/> $hotellID $hotellNavn<br/>");
			}
		}
}



?>