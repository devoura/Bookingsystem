<?php 
include ("start.html");
include("eksamentilkobling.php");


$sqlSetning="SELECT * FROM kundeinfo WHERE Email = '$login';";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen.");
$antallRader=mysqli_num_rows($sqlResultat);

$rad=mysqli_fetch_array($sqlResultat);
$kundeID=$rad["KundeID"];
$tittel=$rad["Tittel"];
$fornavn=$rad["Fornavn"];
$etternavn=$rad["Etternavn"];
$land=$rad["Land"];
$hjemby=$rad["Hjemby"];
$postnr=$rad["postnr"];
$adresse=$rad["Adresse"];
$adresse2=$rad["Adresse2"];
$tlfnr=$rad["TlfNr"];


$login=$rad["Email"];
	
$sqlSetning="SELECT * FROM kundeinfo WHERE Email = $login;";

print ("<h2>Hei $login</h2>");

print("<table border='1' align='center'><tr><th>Kunde-ID</th><th>Tittel</th><th>Fornavn</th><th>Etternavn</th><th>Land</th><th>Hjemby</th><th>Postnummer</th><th>Adresse</th><th>Adresse 2</th><th>Tlf</th><th>Brukernavn</th></tr>");

print("<tr><td>$kundeID</td><td>$tittel</td><td>$fornavn</td><td>$etternavn</td><td>$land</td><td>$hjemby</td><td>$postnr</td><td>$adresse</td><td>$adresse2</td><td>$tlfnr</td><td>$login</td></tr></table>");

include ("slutt.html");

?>
