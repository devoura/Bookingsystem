<?php
include ("start.html");
?>
<h2>Registrer rom for hele hotellet</h2>
<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt">
		
		Hotell                                <?php include("listeboksHotell.php"); ?> <br/>
		Antall etasjer                        <input type="int" id="etasjer" name="etasjer"  required/><br/>
		Antall enkeltrom per etasje           <input type="int" id="rom1" name="rom1" required/><br/>
		Antall dobbeltrom per etasje          <input type="int" id="rom2" name="rom2" required/><br/>
		Antall suiter per etasje              <input type="int" id="rom3" name="rom3" required/><br/>

		<input type="submit" value="Legg til rom i databasen" id="fortsett" name="fortsett">
		<input type="reset" value="Tøm feltene" id="reset" name="reset">	
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


if(!$etasjer)
    {
    print("Antall etasjer må fylles ut.<br />");
    }

else
	{
		include("eksamentilkobling.php");
		$sqlSetning="SELECT * FROM rom WHERE hotellID='$hotellID';";
		$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen");
		$antallRader=mysqli_num_rows($sqlResultat);
	
			if($antallRader==1) /* eller ==1 for primærnøkler*/
			{
			print("Hotellet har allerede rom registrert.");
			} /* -||-*/

			else 
		{
			for ($rt=1;$rt<=$etasjer;$rt++)
			{
			
				{
				$protorom=$protorom+101-$erom-$drom-$srom;
				$sqlSetning="INSERT INTO rom VALUES ('$protorom', '$hotellID', 'ER',NULL);"; 
				mysqli_query($db, $sqlSetning) or die ("Ikke mulig å registrere informasjonen 1."); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("Følgende enkeltrom er nå registrert: $protorom <br/>");
				}
			for ($r=1;$r<$erom;$r++)
				{
				$protorom=$protorom+1;
				$sqlSetning="INSERT INTO rom VALUES ('$protorom', '$hotellID', 'ER',NULL);"; 
				mysqli_query($db, $sqlSetning) or die ("Ikke mulig å registrere informasjonen. 2"); 
				print("Følgende enkeltrom er nå registrert: $protorom <br/>");
				}
				{
				$protorom=$protorom+1;
				$sqlSetning="INSERT INTO rom VALUES ('$protorom', '$hotellID', 'DR',NULL);"; 
				mysqli_query($db, $sqlSetning) or die ("Ikke mulig å registrere informasjonen3."); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("Følgende dobbeltrom er nå registrert: $protorom <br/>");
				}
			for ($r=1;$r<$drom;$r++)
				{
				$protorom=$protorom+1;
				$sqlSetning="INSERT INTO rom VALUES ('$protorom', '$hotellID', 'DR',NULL);"; 
				mysqli_query($db, $sqlSetning) or die ("Ikke mulig å registrere informasjonen4."); 
				print("Følgende dobbeltrom er nå registrert: $protorom <br/>");
				}
				{
				$protorom=$protorom+1;
				$sqlSetning="INSERT INTO rom VALUES ('$protorom', '$hotellID', 'SS',NULL);"; 
				mysqli_query($db, $sqlSetning) or die ("Ikke mulig å registrere informasjonen5."); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("Følgende suite er nå registrert: $protorom <br/>");
				}
			for ($r=1;$r<$srom;$r++)
				{
				$protorom=$protorom+1;
				$sqlSetning="INSERT INTO rom VALUES ('$protorom', '$hotellID', 'SS',NULL);"; 
				mysqli_query($db, $sqlSetning) or die ("Ikke mulig å registrere informasjonen6."); 
				print("Følgende suite er nå registrert: $protorom <br/>");
				}
			}
		}
	}
}



?>
