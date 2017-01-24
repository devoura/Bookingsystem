

<form action="" method="post" input="text" id="bestilling" name="bestilling">
		<?php include("listeboksLandBestilling.php");
		 include("listeboksByBestilling.php"); 
		 include("listeboksHotellBestilling.php"); ?>
		 <input type="date" id="innsjekkDato" name="innsjekkDato" value="Dato for innsjekk" />
		 <input type="date" id="utsjekkDato" name="utsjekkDato" value="Dato for utsjekk" />
		
		<input type="submit" value="Fortsett" id="fortsett" name="fortsett">
		<input type="reset" value="Tøm feltene" id="reset" name="reset">	
</form>


<?php
/*
@$fortsett=$_POST["fortsett"];

if($fortsett)
{
	$landNavn=$_SESSION["landNavn"];
	$byNavn=$_SESSION["byNavn"];
	$hotellNavn=$_SESSION["hotellNavn"];
	$innsjekkDato=$_SESSION["innsjekkDato"];
	$utsjekkDato=$_SESSION["utsjekkDato"];

}
*/

?>