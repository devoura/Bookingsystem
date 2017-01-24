<?php
include ("start.html");
?>

<script src="funksjoner.js"> </script>

<h2>Registrer etasje</h2>
<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt" onSubmit="return validateRom2();">
		<table>
	<tr><td>	Hotell </td><td> <?php include("listeboksHotell.php"); ?> </td></tr>
	<tr><td>	Etasje </td><td> <input type="int" id="etasje" name="etasje"  /></td></tr>
	<tr><td>	Antall enkeltrom </td><td> <input type="number" id="rom1" name="rom1"  /></td></tr>
	<tr><td>	Antall dobbeltrom </td><td> <input type="number" id="rom2" name="rom2"  /></td></tr>
	<tr><td>	Antall suiter</td><td> <input type="number" id="rom3" name="rom3"  /></td></tr>

		<tr><td><input type="submit" value="Legg til etasje i databasen" id="fortsett" name="fortsett"></td>
		<td><input type="reset" value="Tøm feltene" id="reset" name="reset"></td></tr>	</table>
</form>

<p id="melding"> </p>

<p>Hvis du vil registrere kun ett rom klikk <a href="https://home.hbv.no/web-is-gr02w/web1000/vedlikehold/rom3.php">her</a> </p>
<p>Hvis du vil registrere hele hotellet på en gang klikk <a href="https://home.hbv.no/web-is-gr02w/web1000/vedlikehold/rom.php">her</a> </p>
<?php
@$fortsett=$_POST["fortsett"];
if($fortsett)
{
$hotellID=$_POST["HotellID"];
$etasje=$_POST["etasje"];
$protorom=$etasje*100+1;
$erom=$_POST["rom1"];
$drom=$_POST["rom2"];
$srom=$_POST["rom3"];



if(!$etasje || !is_numeric($etasje))
    {
    print("<p id='melding'> Etasje må fylles ut med et tall. </p><br />");
    }
    
    
else if(!$erom || !is_numeric($erom))
    {
    print("<p id='melding'> Enkeltrom må fylles ut med et tall. </p><br />");
    }
    
    
if(!$drom || !is_numeric($drom))
    {
    print("<p id='melding'> Dobbeltrom må fylles ut med et tall. </p><br />");
    }
    
    
if(!$srom || !is_numeric($srom))
    {
    print("<p id='melding'> Suiter må fylles ut med et tall. </p><br />");
    }

else
	{
		include("eksamentilkobling.php");
		$sqlSetning="SELECT * FROM rom WHERE romID='$protorom' AND hotellID='$hotellID';";
		$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>ikke mulig å hente fra databasen</p>");
		$antallRader=mysqli_num_rows($sqlResultat);
	
			if($antallRader==1) /* eller ==1 for primærnøkler*/
			{
			print("<p id='melding'>Kombinasjonen av etasje og hotell er allerede registrert, duplikater er ikke tillatt.</p>");
			} /* -||-*/

			else
		{
			{
				$sqlSetning="INSERT INTO rom VALUES ('$protorom', '$hotellID', 'ER',NULL);"; 
				mysqli_query($db, $sqlSetning) or die ("<p id='melding'>Ikke mulig å registrere informasjonen.</p>"); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("<p id='melding'>Følgende enkeltrom er nå registrert: $protorom </p><br/>");
			}
			for ($r=1;$r<$erom;$r++)
			{
				$protorom=$protorom+1;
				$sqlSetning="INSERT INTO rom VALUES ('$protorom', '$hotellID', 'ER',NULL);"; 
				mysqli_query($db, $sqlSetning) or die ("<p id='melding'>Ikke mulig å registrere informasjonen.</p>"); 
				print("<p id='melding'>Følgende enkeltrom er nå registrert: $protorom</p> <br/>");
			}
			{
				$protorom=$protorom+1;
				$sqlSetning="INSERT INTO rom VALUES ('$protorom', '$hotellID', 'DR',NULL);"; 
				mysqli_query($db, $sqlSetning) or die ("<p id='melding'>Ikke mulig å registrere informasjonen.</p>"); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("<p id='melding'>Følgende dobbeltrom er nå registrert: $protorom </p><br/>");
			}
			for ($r=1;$r<$drom;$r++)
			{
				$protorom=$protorom+1;
				$sqlSetning="INSERT INTO rom VALUES ('$protorom', '$hotellID', 'DR',NULL);"; 
				mysqli_query($db, $sqlSetning) or die ("<p id='melding'>Ikke mulig å registrere informasjonen.</p>"); 
				print("<p id='melding'>Følgende dobbeltrom er nå registrert: $protorom </p><br/>");
			}
			{
				$protorom=$protorom+1;
				$sqlSetning="INSERT INTO rom VALUES ('$protorom', '$hotellID', 'SS',NULL);"; 
				mysqli_query($db, $sqlSetning) or die ("<p id='melding'>Ikke mulig å registrere informasjonen.</p>"); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("<p id='melding'>Følgende suite er nå registrert: $protorom</p> <br/>");
			}
			for ($r=1;$r<$drom;$r++)
			{
				$protorom=$protorom+1;
				$sqlSetning="INSERT INTO rom VALUES ('$protorom', '$hotellID', 'SS',NULL);"; 
				mysqli_query($db, $sqlSetning) or die ("<p id='melding'>Ikke mulig å registrere informasjonen.</p>"); 
				print("<p id='melding'>Følgende suite er nå registrert: $protorom</p> <br/>");
			}
		}
	}
}

include("slutt.html");

?>