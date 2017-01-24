		<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt" onSubmit="return validateEndreBestilling();">
		
		Din kundeID <input type="number" id="kundeID" name="kundeID"/><br/>

		<input type="submit" value="Søk etter bestillinger" id="fortsett" name="fortsett">
		<input type="reset" value="Tøm feltet" id="reset" name="reset">	
</form>

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
			$sqlSetning=
"SELECT BestillingID, bestilling.RomtypeID, Romtype, Pris, DatoAnkomst, DatoAvreise 
FROM bestilling 
LEFT JOIN romtyper
ON romtyper.RomtypeID=bestilling.RomtypeID
WHERE KundeID='$kundeID';";
			$result=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen");
			$antallRader=mysqli_num_rows($result);

			
			if($antallRader==0)
			{
				print("Det er ingen bestillinger ført opp under denne kundeIDen");
			}

			else 
			{

				while ($row = $result->fetch_assoc()) 		{
        
        
			
			{
		?>		<Form method="post" action="">
				<input type="hidden" value="<?php echo $row['pris']; ?>" name="pris" id="pris">
				<input type="radio" name="btnOrder" value="<?php echo $row['BestillingID']; ?>" id="btnOrder<?php echo $row['BestillingID'];'<br/>' ?>" />
				<label for="btnOrder<?php echo $row['BestillingID']; ?>">Bestilling for <?php echo $row['Romtype']; ?> fra <?php echo $row['DatoAnkomst']; ?> til <?php echo $row['DatoAvreise']; ?></label><br /><?php
			}
		
														}  
print("Ny Romtype");	    include("listeboksRomtyper.php"); ?> <br/>
Ny innsjekkdato: <input type="text" name="innsjekkDato" id="innsjekkDato" required />

		<br />

 Ny utsjekkdato: 	<input type="text" name="utsjekkDato" id="utsjekkDato" required /> <br/>											
	<i>Frokost?</i> <input type='checkbox' id='frokost' name='frokost'  /> <br/>
					<input type="submit" value="Rediger valgt bestilling" name="continue" id="continue"/>
		
	
		</form>
		<?php
		}	

	}
}
			@$continue=$_POST["continue"];											
			if($continue)
			{
				
			@$frokost=$_POST["frokost"];
							if (isset($_POST['frokost']))  
                                {

                                    $frokost=1;
                                    
                                }

                               else
                               {
                               		$frokost=0;
                               }

			$romtypeID=$_POST["romtypeID"];

				include("eksamentilkobling.php");
				$sqlSetningRomtype="SELECT romtype, prisPerDogn FROM romtyper WHERE romtypeID='$romtypeID';";
   				$sqlResultatRomtype=mysqli_query($db,$sqlSetningRomtype) or die ("Ikke mulig å hente romtype fra databasen."); 
        		$radRomtype=mysqli_fetch_array($sqlResultatRomtype);         
       			$romtype=$radRomtype["romtype"];  
       			$prisPerDogn=$radRomtype["prisPerDogn"];

       		$bestillingID=$_POST['btnOrder'];
			$pris=$_POST["pris"];
			$innsjekkDato=$_POST["innsjekkDato"];
			$utsjekkDato=$_POST["utsjekkDato"];
			$innsjekkDager = strtotime("$innsjekkDato");
 			$utsjekkDager = strtotime("$utsjekkDato");
 			$antallDager = $utsjekkDager - $innsjekkDager;
 			$dagerOpphold = floor($antallDager/(60*60*24));
 			$EndrePris=($dagerOpphold*$prisPerDogn)-$pris;

				
				
 			$sqlSetning=$sqlSetning="UPDATE bestilling SET RomtypeID='$romtypeID', Pris=Pris+$EndrePris, DatoAnkomst='$innsjekkDato', DatoAvreise='$utsjekkDato',
				Frokost ='$frokost' WHERE BestillingID='$bestillingID';";
				mysqli_query($db, $sqlSetning) or die ("<p id='melding'>ikke mulig å registrere informasjonen.</p>"); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("<p id='melding'>Bestilling nr:$bestillingID er nå endret!</p>");

			}
		
	
include("slutt.html");
		?>
	
</html>