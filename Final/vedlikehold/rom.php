<?php
include ("start.html");
?>

<script src="funksjoner.js"></script>

<h2>Registrer rom for hele hotellet</h2>
<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt" onSubmit="return validateRegistrerRom();">
		
		<table><tr><td> Hotell</td>                              <td>  <?php include("listeboksHotell.php"); ?></td> </tr>
		<tr><td>Antall etasjer</td>                     <td>  <input type="number" id="etasjer" name="etasjer"  /></td></tr>
		<tr><td>Antall enkeltrom per etasje </td>         <td>    <input type="number" id="rom1" name="rom1"  /> </td></tr>
		<tr><td>Antall dobbeltrom per etasje     </td>     <td>   <input type="number" id="rom2" name="rom2"  /> </td></tr>
		<tr><td>Antall suiter per etasje  </td>          <td>     <input type="number" id="rom3" name="rom3"  /> </td></tr>

	<td>	<input type="submit" value="Legg til rom i databasen" id="fortsett" name="fortsett">  </td>
	<td>	<input type="reset" value="Tøm feltene" id="reset" name="reset"> </td></tr> </table>	
</form>
<p>Hvis du vil registrere kun ett rom klikk <a href="https://home.hbv.no/web-is-gr02w/web1000/vedlikehold/rom3.php">her</a> </br></p>
<p>Hvis du vil registrere kun en etasje klikk <a href="https://home.hbv.no/web-is-gr02w/web1000/vedlikehold/rom2.php">her</a> </br></p>
<?php
@$fortsett=$_POST["fortsett"];
if($fortsett)
{
$hotellID=$_POST["HotellID"];
$etasjer=$_POST["etasjer"];
$erom=$_POST["rom1"];
$drom=$_POST["rom2"];
$srom=$_POST["rom3"];
$protorom=$erom+$drom+$srom;


if(!$etasjer || !is_numeric($etasjer))
    {
    print("<p id ='melding'>Antall etasjer må fylles ut med tall.</p><br />");
    }
    
    
    else if (!$erom || !is_numeric($erom)){
    		  print("<p id ='melding'>Antall enkeltrom må fylles ut med tall.</p><br />");    
    }
    
       else if (!$drom || !is_numeric($drom)){
    		  print("<p id ='melding'>Antall dobbeltrom må fylles ut med tall.</p><br />");    
    }
    
       else if (!$srom || !is_numeric($srom)){
    		  print("<p id ='melding'>Antall suiter må fylles ut med tall.</p><br />");    
    }
else
	{
		include("eksamentilkobling.php");
		$sqlSetning="SELECT * FROM rom WHERE hotellID='$hotellID';";
		$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id ='melding'>ikke mulig å hente fra databasen</p>");
		$antallRader=mysqli_num_rows($sqlResultat);
	
			if($antallRader==1) /* eller ==1 for primærnøkler*/
			{
			print("<p id ='melding'>Hotellet har allerede rom registrert.</p>");
			} /* -||-*/

			else 
		{
			for ($rt=1;$rt<=$etasjer;$rt++)
			{
			
				{
				$protorom=$protorom+101-$erom-$drom-$srom;
				$sqlSetning="INSERT INTO rom VALUES ('$protorom', '$hotellID', 'ER',NULL);"; 
				mysqli_query($db, $sqlSetning) or die ("<p id ='melding'>Ikke mulig å registrere informasjonen 1.</p>"); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("<p id ='melding'>Følgende enkeltrom er nå registrert: $protorom </p><br/>");
				}
			for ($r=1;$r<$erom;$r++)
				{
				$protorom=$protorom+1;
				$sqlSetning="INSERT INTO rom VALUES ('$protorom', '$hotellID', 'ER',NULL);"; 
				mysqli_query($db, $sqlSetning) or die ("<p id ='melding'>Ikke mulig å registrere informasjonen. 2</p>"); 
				print("<p id ='melding'>Følgende enkeltrom er nå registrert: $protorom </p><br/>");
				}
				{
				$protorom=$protorom+1;
				$sqlSetning="INSERT INTO rom VALUES ('$protorom', '$hotellID', 'DR',NULL);"; 
				mysqli_query($db, $sqlSetning) or die ("<p id ='melding'>Ikke mulig å registrere informasjonen3.</p>"); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("<p id ='melding'>Følgende dobbeltrom er nå registrert: $protorom </p><br/>");
				}
			for ($r=1;$r<$drom;$r++)
				{
				$protorom=$protorom+1;
				$sqlSetning="INSERT INTO rom VALUES ('$protorom', '$hotellID', 'DR',NULL);"; 
				mysqli_query($db, $sqlSetning) or die ("<p id ='melding'>Ikke mulig å registrere informasjonen4.</p>"); 
				print("<p id ='melding'>Følgende dobbeltrom er nå registrert: $protorom </p><br/>");
				}
				{
				$protorom=$protorom+1;
				$sqlSetning="INSERT INTO rom VALUES ('$protorom', '$hotellID', 'SS',NULL);"; 
				mysqli_query($db, $sqlSetning) or die ("<p id ='melding'>Ikke mulig å registrere informasjonen5.</p>"); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("<p id ='melding'>Følgende suite er nå registrert: $protorom </p><br/>");
				}
			for ($r=1;$r<$srom;$r++)
				{
				$protorom=$protorom+1;
				$sqlSetning="INSERT INTO rom VALUES ('$protorom', '$hotellID', 'SS',NULL);"; 
				mysqli_query($db, $sqlSetning) or die ("<p id ='melding'>Ikke mulig å registrere informasjonen6.</p>"); 
				print("<p id ='melding'>Følgende suite er nå registrert: $protorom </p><br/>");
				}
			}
		}
	}
}


include ("slutt.html");
?>
