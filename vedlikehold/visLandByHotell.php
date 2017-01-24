
<?php 
include("start.html");
include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM land;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("<p id='melding'>Ikke mulig å hente fra databasen.</p>");
$antallRader=mysqli_num_rows($sqlResultat);

print ("<p id='melding'>");
print ("<h2>Land</h2>");
print("<table border=1 align='center'>");
print("<tr><th>Land-ID</th><th>Landnavn</th></tr>");
for($r=1; $r <= $antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$landID=$rad["LandID"];
$landNavn=$rad["LandNavn"];

print("<tr><td>$landID</td><td>$landNavn</td></tr>");
}

print("</table></p>");


?>

<?php 

include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM byer ORDER BY landID ASC;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen.");
$antallRader=mysqli_num_rows($sqlResultat);

print("<hr>");
print ("<p id='melding'>");
print ("<h2>Byer</h2>");
print("<table border=1 align='center'>");
print
("<tr><th>Land-ID</th><th>By-ID</th><th>Bynavn</th></tr>");
for($r=1; $r <= $antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$landID=$rad["LandID"];
$byID=$rad["ByID"];
$byNavn=$rad["ByNavn"];



print("<tr><td>$landID</td><td>$byID</td><td>$byNavn</td></tr>");
}

print("</table></p>");


?>


<?php 

include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM hotell ORDER BY byID ASC;";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen.");
$antallRader=mysqli_num_rows($sqlResultat);

print("<hr>");
print ("<p id='melding'>");
print ("<h2>Hoteller</h2>");
print("<table border=1 align='center'>");
print
("<tr><th>By-ID</th><th>Hotell-ID</th><th>Hotellnavn</th><th>Tilbyr frokost (1 ja, 0 nei)</th><th>Frokostpris</th></tr>");
for($r=1; $r <= $antallRader; $r++)
{
$rad=mysqli_fetch_array($sqlResultat);
$byID=$rad["ByID"];
$hotellID=$rad["HotellID"];
$hotellNavn=$rad["HotellNavn"];
$tilbyrFrokost=$rad["TilbyrFrokost"];
$frokostPris=$rad["FrokostPris"];


print("<tr><td>$byID</td><td>$hotellID</td><td>$hotellNavn</td><td>$tilbyrFrokost</td><td>$frokostPris</td></tr>");
}

print("</table></p>");

include("slutt.html");

?>

