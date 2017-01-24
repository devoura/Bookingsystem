<!doctype>
<html>
<?php 
include("start.html"); 
?>

<script src="funsksjoner.js"> </script>

		<h2>Velg bestilling</h2>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>

  jQuery(function(A){A.datepicker.regional["no"]={clearText:"Tøm",clearStatus:"",closeText:"Lukk",closeStatus:"",prevText:"&laquo;Forrige",prevStatus:"",prevBigText:"&#x3c;&#x3c;",prevBigStatus:"",nextText:"Neste&raquo;",nextStatus:"",nextBigText:"&#x3e;&#x3e;",nextBigStatus:"",currentText:"I dag",currentStatus:"",monthNames:["Januar","Februar","Mars","April","Mai","Juni","Juli","August","September","Oktober","November","Desember"],monthNamesShort:["Jan","Feb","Mar","Apr","Mai","Jun","Jul","Aug","Sep","Okt","Nov","Des"],monthStatus:"",yearStatus:"",weekHeader:"Uke",weekStatus:"",dayNamesShort:["Søn","Man","Tir","Ons","Tor","Fre","Lør"],dayNames:["Søndag","Mandag","Tirsdag","Onsdag","Torsdag","Fredag","Lørdag"],dayNamesMin:["Sø","Ma","Ti","On","To","Fr","Lø"],dayStatus:"DD",dateStatus:"D, M d",dateFormat:"yy-mm-dd",firstDay:0,initStatus:"",isRTL:false};A.datepicker.setDefaults(A.datepicker.regional["no"])});

   $(function(){
        $("#innsjekkDato").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#utsjekkDato").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
            minValue.setDate(minValue.getDate()+1);
            $("#to").datepicker( "option", "minDate", minValue );
        })
    });

  </script>
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