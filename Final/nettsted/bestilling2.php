<?php include("start.html"); ?>

<?php session_start();   //henter variabler fra forrige side
@$hotellID=$_SESSION["hotellID"];
@$innsjekkDato=$_SESSION["innsjekkDato"];
@$utsjekkDato=$_SESSION["utsjekkDato"];
@$frokostPris=$_SESSION["frokostPris"];


include("eksamentilkobling.php");
$sqlSetning="SELECT HotellNavn FROM Hotell WHERE hotellID='$hotellID';"; //henter hotellnavnet med sql fordi kyrre er lat
$sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente hotellnavn fra databasen."); 
$antallRader=mysqli_num_rows($sqlResultat); 

for ($r=1;$r<=$antallRader;$r++)
        {
            $rad=mysqli_fetch_array($sqlResultat);         
            $hotellNavn=$rad["HotellNavn"];  
            $_SESSION["hotellNavn"]=$hotellNavn;
        }

print("Du bestiller rom ved $hotellNavn. <br />");

if($frokostPris>0)
{
    print("Du har valgt å bestille frokost til KR $frokostPris per rom, per døgn. Dette blir lagt til i totalprisen. <br /> <br />");
}

?>

<?php
@$hotellID=$_SESSION["hotellID"];
@$innsjekkDato=$_SESSION["innsjekkDato"];
@$utsjekkDato=$_SESSION["utsjekkDato"];
@$frokostPris=$_SESSION["frokostPris"];
@$frokost=$_SESSION["frokost"];


	include("eksamentilkobling.php");
    $sqlSetning="SELECT RomtypeID, COUNT(RomID) AS AntallRom FROM rom WHERE HotellID='$hotellID' GROUP BY RomtypeID;"; //teller antall rom på angitt hotell
    $sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen");
    
        $antallRader=mysqli_num_rows($sqlResultat);

   $fullt=0;

    for ($r=1;$r<=$antallRader;$r++)
        {
            $rad=mysqli_fetch_array($sqlResultat);  
            $romtypeID=$rad["RomtypeID"];        
            $antallRom=$rad["AntallRom"];
            
            $sqlquery="SELECT RomtypeID, COUNT(BestillingID) AS OpptatteRom FROM bestilling WHERE hotellID='$hotellID' AND romtypeID='$romtypeID'
                        AND NOT (DatoAnkomst < CAST('$innsjekkDato' AS DATE) and DatoAvreise < CAST('$innsjekkDato' AS DATE)) 
                        AND NOT 
                        (DatoAvreise > CAST('$utsjekkDato' AS DATE) and DatoAnkomst > CAST('$utsjekkDato' AS DATE))";
            $sqlResult=mysqli_query($db, $sqlquery) or die ("ikke mulig å hente fra databasen geir"); //henter hvor mange rom som er opptatt

            $row=mysqli_fetch_array($sqlResult);
            $optatteRom=$row["OpptatteRom"];
            $ledigeRom=$antallRom-$optatteRom; //trekker opptatte rom fra antallet = antall ledige

            //hent romtypenavn

       		$sqlSetningRomtype="SELECT romtype, prisPerDogn FROM romtyper WHERE romtypeID='$romtypeID';";
       		$sqlResultatRomtype=mysqli_query($db,$sqlSetningRomtype) or die ("Ikke mulig å hente romtype fra databasen."); 

			

            $radRomtype=mysqli_fetch_array($sqlResultatRomtype);         
            $romtype=$radRomtype["romtype"];  
            $prisPerDogn=$radRomtype["prisPerDogn"];

          
            if($ledigeRom!=0)
            {
                $fullt=$fullt+1;
            }
            print("

            	Dette hotellet har $ledigeRom ledige $romtype, til KR $prisPerDogn per døgn. Hvor mange rom av denne typen vil du bestille?
            	<form action='' method='post' type='text' name='bestillRom' id='bestillRom'>
             	<input type='number' name='$romtypeID' id='$romtypeID' min='0' max='99'/>
             	<br />
             	

             "); 

            
            	${'typerom' . $r} = $romtypeID;
            	
    			$_SESSION["romtypeID"."$r"]=$romtypeID;



        }  // /for


 if ($fullt==0)
 {
    print("Hotellet har ingen ledige rom
            <a href='avbryt.php'><input type='submit' name='avbryt' id='avbryt' value='Avbryt bestilling' onSubmit='bekreft()' /></a>

        ");
 }     
 else  
{
        print("<input type='submit' name='fortsett' id='fortsett' value='Fortsett' />
        	<input type='reset' name='reset' id='reset' value='Tøm feltene' />
        	</form>
        	<a href='avbryt.php'><input type='submit' name='avbryt' id='avbryt' value='Avbryt bestilling' onSubmit='bekreft()' /></a>


        	");

}
  @$fortsett=$_POST["fortsett"];

  if($fortsett)
  {

        	
        	for($i=1;$i<=$antallRader;$i++)
       		 { 
    			${'bestilteRom' . $i}=$_POST["${'typerom' . $i}"];
    			$_SESSION["${'typerom' . $i}"]=${'bestilteRom' . $i};
			 }


			$_SESSION["antallRader"]=$antallRader;

	
		
			
			 
			print("<a href='bestilling3.php'><input type='submit' name='nesteSide' id='nesteSide' value='Neste side' /></a><br />");
			 

$totalPrisPerDag=0;
$dagerOpphold=$_SESSION["dagerOpphold"];
for($t=1;$t<=$antallRader;$t++)
{
$ID=$_SESSION["romtypeID"."$t"];  

$tall=$_SESSION[$_SESSION["romtypeID"."$t"]];

include("eksamentilkobling.php");

$endaEnSqlSetning="SELECT prisPerDogn FROM romtyper WHERE romtypeID='$ID';";

$endaEttSqlResultat=mysqli_query($db,$endaEnSqlSetning) or die ("Ikke mulig å hente fra databasen."); 

$prisRad=mysqli_fetch_array($endaEttSqlResultat); 

$romPris=$prisRad["prisPerDogn"];

$totalRomPris=$romPris*$dagerOpphold;

$frokostPris=$_SESSION['frokostPris'];
$prisPerRom=($romPris+$frokostPris) * $tall;
$totalPrisPerDag=$totalPrisPerDag+$prisPerRom;
$totalPris=$totalPrisPerDag*$dagerOpphold;


//print("Pris per $romty, per døgn er $prisPerRom <br />");

}
print("Prisen for denne bestillingen per døgn blir KR $totalPrisPerDag<br/>");
print("Prisen for $dagerOpphold dager blir KR $totalPris<br/>");

$_SESSION["totalPris"]=$totalPris;
} // /fortsett



?>

<?php include("slutt.html"); ?>









