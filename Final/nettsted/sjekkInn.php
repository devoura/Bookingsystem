<?php include("start.html"); ?>

<form action="" method="post" id="tekstfelt">
		
		Din kundeID <input type="number" id="kundeID" name="kundeID" required/><br/>

		<input type="submit" value="Søk etter bestillinger" id="fortsett" name="fortsett">
		<input type="reset" value="Tøm feltet" id="reset" name="reset">	
</form>
<br />
<?php

@$fortsett=$_POST["fortsett"];

if($fortsett)

{


$kundeID=$_POST["kundeID"];


if(!$kundeID)
    {
    print("KundeID må fylles ut.<br />");
    }

else
	{
		include("eksamentilkobling.php");
		$sqlSetning="SELECT * FROM bestilling WHERE kundeID='$kundeID' ;";
		$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen");
		$antallRader=mysqli_num_rows($sqlResultat);
	
			if($antallRader==0) /* eller ==1 for primærnøkler*/
			{
			print("Det finnes ingen bestillinger med slik kundeID.");
			} /* -||-*/

			else
		{
			for ($r=1;$r<=$antallRader;$r++)

			{
			$rad=mysqli_fetch_array($sqlResultat);  
            $bestillingID=$rad["BestillingID"];
            $hotellID=$rad["HotellID"];
            $pris=$rad["Pris"];
            $datoAnkomst=$rad["DatoAnkomst"];
            $datoAvreise=$rad["DatoAvreise"];
            $romtypeID=$rad["RomtypeID"];        
 
					print ("<p id='melding'><table id='tabell'>");
					print("<tr><td>bestillingsID</td><td> $bestillingID</td></tr>"); 
					print("<tr><td>romtypeID</td><td> $romtypeID</td></tr>"); 
				    print("<tr><td>hotellID</td><td> $hotellID</td></tr>");
					print("<tr><td>romtypeID </td><td>$romtypeID</td></tr>"); 
					print("<tr><td>datoAnkomst</td><td> $datoAnkomst</td></tr>");
					print("<tr><td>datoAvreise</td><td> $datoAvreise</td></tr>");
					print("<tr><td>pris</td><td> $pris</td></tr>");	
					print("</table></p>");
			}
		}
    
	}


?>
<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt" >
		<input type=hidden name=kundeID value=<?php print("$antallRader") ?> >
		<input type=hidden name=kundeID value=<?php print("$kundeID") ?> >
		<input type='submit' value='Sjekk Inn' id='fortsettSjekkInn' name='fortsettSjekkInn' />
		<a href='avbryt.php'><input type='submit' name='avbryt' id='avbryt' value='Avbryt' onSubmit='bekreft()' /></a>
</form>


<?php
}
@$fortsettSjekkInn=$_POST["fortsettSjekkInn"];

if($fortsettSjekkInn)

{
	$kundeID=$_POST["kundeID"];

	include("eksamentilkobling.php");
		

		$sqlSetning="SELECT HotellID, RomtypeID, COUNT(BestillingID) AS antallRom FROM bestilling WHERE kundeID='$kundeID' GROUP BY RomtypeID ;";
		$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen4");
		$antallRader=mysqli_num_rows($sqlResultat);

print("Hent romkort i resepsjonen for rom: <br/>");		
		for ($i=1;$i<=$antallRader;$i++)


				{
				$rad=mysqli_fetch_array($sqlResultat);  
            	$romtypeID=$rad["RomtypeID"];
            	$antallRom=$rad["antallRom"];
            	$hotellID=$rad["HotellID"];


            	for ($t=1;$t<=$antallRom;$t++)
            		{
            			$romSetning="SELECT * FROM rom
									 WHERE RomtypeID='$romtypeID' AND HotellID='$hotellID' AND Tilstand IS NULL LIMIT 1;";
						$romResult=mysqli_query($db, $romSetning) or die ("ikke mulig å hente fra the database1");
						$romRad=mysqli_fetch_array($romResult);  
            			$romID=$romRad["RomID"];
            			Print("$romID<br/>");
            	


						$setning="UPDATE rom
									SET Tilstand=1
								WHERE RomtypeID='$romtypeID' AND HotellID='$hotellID' AND Tilstand IS NULL LIMIT 1;";
						$result=mysqli_query($db, $setning) or die ("ikke mulig å hente fra the database2");
            		}

            	}


		
		




$sqlquery="UPDATE bestilling
SET Tilstand=1
WHERE KundeID='$kundeID';";
$sqlResult=mysqli_query($db, $sqlquery) or die ("ikke mulig å hente fra the database3");

print("Du er sjekket inn");


}

include("slutt.html");

?>