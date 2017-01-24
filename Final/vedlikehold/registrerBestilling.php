<?php
include ("start.html");
?>

<script src="funksjoner.js"> </script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>

  jQuery(function(A){A.datepicker.regional["no"]={clearText:"Tøm",clearStatus:"",closeText:"Lukk",closeStatus:"",prevText:"&laquo;Forrige",prevStatus:"",prevBigText:"&#x3c;&#x3c;",prevBigStatus:"",nextText:"Neste&raquo;",nextStatus:"",nextBigText:"&#x3e;&#x3e;",nextBigStatus:"",currentText:"I dag",currentStatus:"",monthNames:["Januar","Februar","Mars","April","Mai","Juni","Juli","August","September","Oktober","November","Desember"],monthNamesShort:["Jan","Feb","Mar","Apr","Mai","Jun","Jul","Aug","Sep","Okt","Nov","Des"],monthStatus:"",yearStatus:"",weekHeader:"Uke",weekStatus:"",dayNamesShort:["Søn","Man","Tir","Ons","Tor","Fre","Lør"],dayNames:["Søndag","Mandag","Tirsdag","Onsdag","Torsdag","Fredag","Lørdag"],dayNamesMin:["Sø","Ma","Ti","On","To","Fr","Lø"],dayStatus:"DD",dateStatus:"D, M d",dateFormat:"yy-mm-dd",firstDay:0,initStatus:"",isRTL:false};A.datepicker.setDefaults(A.datepicker.regional["no"])});

   $(function(){
        $("#datoAnkomst").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#datoAvreise").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
            var minValue = $(this).val();
            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
            minValue.setDate(minValue.getDate()+1);
            $("#datoAvreise").datepicker( "option", "minDate", minValue );
        })
    });

  </script>

<h2>Registrer bestilling</h2>
<form method="post" action="" id="tekstfelt" name="registrerBestilling" onSubmit="return validateBestilling();">
	<input type="text" id="bestillingID" name="bestillingID" /> <i>ID for bestillingen </i></br>
	<?php include("listeboksHotell.php"); ?> <br/>
	<?php include("listeboksKunde.php"); ?> <br/>
	<?php include("listeboksBetalingsinfoSlett.php"); ?> <br/>
	<?php include("listeboksRomtyper.php"); ?> <br/>
	<input type="number" id="pris" name="pris" /> <i>pris for bestillingen</i></br>
	<input type="text" id="datoAnkomst" name="datoAnkomst" readonly /> <i>Dato for ankomst</i></br>
	<input type="text" id="datoAvreise" name="datoAvreise" readonly /> <i>Dato for avreise</i><br />
	<input type="checkbox" id="frokost" name="frokost" /> <i>Frokost?</i></br>

	
  	<input type="submit" value="Registrer" id="registrerBestillingKnapp" name="registrerBestillingKnapp"/><br/> 
</form>

<p id="melding"></p>

<?php

@$registrerBestillingKnapp=$_POST["registrerBestillingKnapp"];

if($registrerBestillingKnapp)
{
$bestillingID=$_POST["bestillingID"];
$hotellID=$_POST["HotellID"];
$kundeID=$_POST["kundeID"];
$betalingsID=$_POST["betalingsID"];
$romtype=$_POST["romtypeID"];
$pris=$_POST["pris"];
$datoAnkomst=$_POST["datoAnkomst"];
$datoAvreise=$_POST["datoAvreise"];
@$frokost=$_POST["frokost"];

if (isset($_POST['frokost']))  
                                {

                                    $frokost=1;
                                    
                                }

                               else
                               {
                               		$frokost=0;
                               }

		
		include("eksamentilkobling.php");
		$sqlSetning="SELECT * FROM bestilling WHERE BestillingID='$bestillingID';";
		$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>ikke mulig å hente fra databasen.</p>");
		$antallRader=mysqli_num_rows($sqlResultat);
				
				$Setning="SELECT * FROM rom WHERE RomtypeID='$romtype';";
				$Resultat=mysqli_query($db, $Setning) or die ("<p id='melding'>ikke mulig å hente fra databasen.</p>");
				$Rader=mysqli_num_rows($Resultat);

						$saus="SELECT * FROM hotell WHERE HotellID='$hotellID';";
						$ravioli=mysqli_query($db, $saus) or die ("<p id='melding'>ikke mulig å hente fra databasen.</p>");
						$kjøttRad=mysqli_fetch_array($ravioli);

						$hotellNavn=$kjøttRad["HotellNavn"];


			if($antallRader !=0) /* eller ==1 for primærnøkler*/
			{
			print("<p id='melding'>Bestillingen er allerede registrert</p><br />");
			} 
			else if ($Rader ==0)
			{
			print("<p id='melding'>Det finnes ingen slik romtype på $hotellNavn");
			}
			else
				{
					
				$sqlQuery="INSERT INTO bestilling VALUES ('$bestillingID', '$hotellID', '$kundeID', '$betalingsID', '$romtype', '$pris', '$datoAnkomst', '$datoAvreise', '$frokost', NULL);";
				mysqli_query($db, $sqlQuery) or die ("<p id='melding'>ikke mulig å registrere informasjonen.</p>"); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("<p id='melding'>Bestilling $bestillingID er nå registrert!</p>");
				}
	





}

include ("slutt.html");

?>