
<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt">
		AJAX land by hotell
		<?php include("listeboksRomtype.php"); ?>
		<?php include("listeboksHotell.php"); ?>
		<input type="number" id="antallNyeRom" name="antallNyeRom" placeholder="" required />
		<input type="submit" value="Fortsett" id="fortsett" name="fortsett">
		<input type="reset" value="Tøm feltene" id="reset" name="reset">	
</form>



<?php
@$fortsett=$_POST["fortsett"];


if($fortsett)
{
$romtypeID=$_POST["romtypeID"];
$romtypeNavn=$_POST["romtypeNavn"];
$prisPerDogn=$_POST["prisPerDogn"];

$lovligromtypeID=true;
$lovligprisPerDogn=true;


if(!$romtypeID || !$romtypeNavn || !$prisPerDogn)
    {
    $lovligromtypeID=false;
    print("Alle feltene må fylles ut.");
    }
       

if (strlen($romtypeID)!=2)
{
	$lovligromtypeID=false;
	print("romtypeID kan kun bestå av to tegn.");
}

if(is_nan($prisPerDogn))
{
$lovligprisPerDogn=false;
print("Prisen må bestå av tall.");
}


 
if($lovligromtypeID && $romtypeNavn && $prisPerDogn)
		{
		include("eksamentilkobling.php");
		$sqlSetning="SELECT * FROM romtyper WHERE romtypeID='$romtypeID';)";
		$sqlResultat=mysqli_query($db, $sqlSetning) or die ("Ikke mulig å hente fra databasen");
		$antallRader=mysqli_num_rows($sqlResultat);
	
			if($antallRader==1) /* eller ==1 for primærnøkler*/
			{
			print("RomtypeID er allerede registrert, duplikater er ikke tillatt.");
			} /* -||-*/

			else
			{
				$romtypeID=strtoupper($romtypeID);
				$sqlSetning="INSERT INTO romtyper VALUES ('$romtypeID', '$romtypeNavn', '$prisPerDogn');";
				mysqli_query($db, $sqlSetning) or die ("Ikke mulig å registrere informasjonen."); /*trenger ikke $sqlResultat= fordi man ikke skal ha noe ut*/
				print("Følgende romtype er nå registrert:<br/> $romtypeID, $romtypeNavn, KR $prisPerDogn,- per døgn.<br/>");
			}
		}

}



?>