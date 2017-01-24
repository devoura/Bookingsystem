<?php 
include("start.html"); 
?>
<h2>IKKE FERDIG </h2>
<br />
<form action='' method='post' input='text' id='tekstfelt' name='tekstfelt' >
<?php include("listeboksHotell.php"); ?>
<input type='submit' id='fortsett' name='fortsett' value='Se rom på dette hotellet' />
</form>	
<p id="melding"></p>

<?php

@$fortsett=$_POST["fortsett"];

if($fortsett) {
$hotellID=$_POST["HotellID"];


	include("eksamentilkobling.php");
	/*
	$sqlSetning="select count(Tilstand) from bestilling where Tilstand is null;";
	*/
	
	$sqlSetning="SELECT * FROM rom WHERE HotellID='$hotellID';";
	$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>ikke mulig å hente fra databasen.</p>");
	$antallRader=mysqli_num_rows($sqlResultat);

	$sqlQuery="SELECT * FROM hotell WHERE HotellID='$hotellID';";
	$sqlResult=mysqli_query($db, $sqlQuery) or die ("<p id='melding'>ikke mulig å hente fra databasen2.</p>");
	$row=mysqli_fetch_array($sqlResult);
	$hotellNavn=$row["HotellNavn"];

	print("<h2>$hotellNavn</h2>");
	print("<table border=1 align='center' ");
	print("<tr><th><p id='melding'>Hotell-ID</p></th><th><p id='melding'>Romtype-ID</p></th><th><p id='melding'>Rom-ID</p></th><th><p id='melding'>1: ikke ledig, tom: ledig</p></th></tr>");
	/* <th><p id='melding'>Ankomst</p></th><th><p id='melding'>Avreise</p></th> */
	for($r=1; $r <= $antallRader; $r++){
		$rad=mysqli_fetch_array($sqlResultat);
		$romtypeID=$rad["RomtypeID"];
		$hotellID=$rad["HotellID"];
		$romID=$rad["RomID"];
		/*
		$datoAnkomst=$rad["DatoAnkomst"];
		$datoAvreise=$rad["DatoAvreise"];
		*/
		$tilstand=$rad["Tilstand"];

		print("<tr><td><p id='melding'>$hotellID</p></td><td><p id='melding'>$romtypeID</p></td><td><p id='melding'>$romID</p></td><td><p id='melding'>$tilstand</p></td></tr>");
		}
		
		/* <td><p id='melding'>$datoAnkomst</p></td><td><p id='melding'>$datoAvreise</p></td> */

	print("</table>");
	

}
include("slutt.html");
?>