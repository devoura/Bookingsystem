<?php session_start(); ?>
<?php include("start.html"); ?>

<script src="ajax-by.js"></script>
<script src="ajax-hotell.js"></script>
<script src="ajax-frokost.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
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

 
<br /> <br />

<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt" >
		

Innsjekkdato: <input type="text" name="innsjekkDato" id="innsjekkDato" readonly required />

<br />

	Utsjekkdato: <input type="text" name="utsjekkDato" id="utsjekkDato" readonly required /> 

<br />

    Velg land: <?php include("listeboksLand.php"); ?>  <br/> <!-- velg land -->
      <div id="melding"></div> <!-- Liste over byer i valgt land -->
      <div id="melding2"></div> <!-- Liste over hoteller i valgt by -->
      <div id="melding3"></div> <!-- checkbox for frokost -->
 

		<input type='submit' value='Velg' id='fortsett' name='fortsett' />
		<input type="reset" value="Tøm feltene" id="reset" name="reset" /> 

	
</form>





<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt" >
<a href='avbryt.php'><input type='submit' name='avbryt' id='avbryt' value='Avbryt bestilling' onSubmit='bekreft()' /></a>
</form>

<?php

@$fortsett=$_POST["fortsett"];



if($fortsett)
{

@$hotellID=$_POST["hotellID"]; //session, hentes fra melding2
$innsjekkDato=$_POST["innsjekkDato"]; //session
$utsjekkDato=$_POST["utsjekkDato"];  //session
@$frokost=$_POST["frokost"];

//@$frokostPris=$_POST["frokostPris"];
//@$skalHaFrokost=$_POST["skalHaFrokost"];
//@$frokostJa=$_POST["frokostJa"];
//@$frokostNei=$_POST["frokostNei"];

$tid=date("Y-m-d"); //dagens dato i lokalt format, input type date er også lokalt format

$_SESSION["hotellID"]=$hotellID;
$_SESSION["innsjekkDato"]=$innsjekkDato;
$_SESSION["utsjekkDato"]=$utsjekkDato;
//$_SESSION["frokost"]=$frokost;

//$_SESSION["skalHaFrokost"]=$skalHaFrokost;
//$_SESSION["frokostJa"]=$frokostJa;
//$_SESSION["frokostNei"]=$frokostNei;
$sqlSetning="SELECT tilbyrFrokost, frokostPris FROM hotell WHERE hotellID='$hotellID';";
            $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente data fra databasen hotell");
            $antallRader=mysqli_num_rows($sqlResultat); 
            $rad=mysqli_fetch_array($sqlResultat); 
            $tilbyrFrokost=$rad["tilbyrFrokost"];
            $frokostPris=$rad["frokostPris"];
								if (isset($_POST['frokost']))  
                                {

                                    $_SESSION["frokost"]=true;
                                    
                                }

      
                                else if ($tilbyrFrokost==0)
                                {
                                
                                $_SESSION["frokost"]=false;
                                $frokostPris=0;
                                
                                
                                

                            	}
                                

                            	else if($tilbyrFrokost==1 && $frokostPris==0)
                            	{
                                
                                $_SESSION["frokost"]=true;
                                $frokostPris=0;
                                
                            	}
                            	else

                                {   
                                  $_SESSION["frokost"]=false;
                                  $frokostPris=0;
                                  $_SESSION["frokostPris"]=$frokostPris;
                                }

$_SESSION["frokostPris"]=$frokostPris;
$lovliginnsjekkDato=true;
$lovligutsjekkDato=true;
$lovligHotellID=true;




 $innsjekkDager = strtotime("$innsjekkDato");
 $utsjekkDager = strtotime("$utsjekkDato");
 $antallDager = $utsjekkDager - $innsjekkDager;
 $dagerOpphold = floor($antallDager/(60*60*24));

 $_SESSION["dagerOpphold"]=$dagerOpphold;



if($innsjekkDato < $tid) //er innsjekkdato i dag eller senere?
{
	$lovliginnsjekkDato=false;
	print("Innsjekkingsdato kan ikke være i fortiden.<br />");
}

if($utsjekkDato < $innsjekkDato) //er innsjekkdato før utsjekkdato?
{
	$lovligutsjekkDato=false;
	print("Utsjekkingsdato kan ikke være før innsjekkingsdato.<br />");
}

	if(!$innsjekkDato || !$utsjekkDato || !$hotellID) //har inn-/utsjekk og hotellID verdier?
	{
		$lovligHotellID=false;
		$lovliginnsjekkDato=false;
		$lovligutsjekkDato=false;
		print("Vennligst velg et hotell og angi datoer for inn- og utsjekking.");

	}

if($hotellID=="...")
{	
	$lovligHotellID=false;
	print("Vennligst velg et hotell");
}

if($lovliginnsjekkDato && $lovligutsjekkDato && $lovligHotellID) //er alt i orden? trykk her for neste del
{
	
print("<a href='bestilling2.php'><input type='submit' name='nesteSide' id='nesteSide' value='Neste Side' onSubmit='bekreft()' /></a>"); //generer knapp til neste side
}


}


include("slutt.html");



?>