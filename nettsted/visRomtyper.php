<?php 
include("start.html"); 
?>

<form action="" method="post" name="tekstfelt" id="tekstfelt">
<?php include("listeboksRomtyper.php");?>
<input type="submit" value="Se romtyper" id="fortsettromtyper" name="fortsettromtyper">
</form>

<?php
@$fortsettromtyper=$_POST["fortsettromtyper"];

if($fortsettromtyper){
$romtypeID=$_POST ["romtypeID"];
$sqlSetning="SELECT * FROM romtyper WHERE RomtypeID='$romtypeID';";
$sqlResultat=mysqli_query ($db, $sqlSetning) or die (mysqli_error($db));
$rad=mysqli_fetch_array($sqlResultat);

$romtypeID=$rad["RomtypeID"];
$romtype=$rad["Romtype"];
$prisPerDogn=$rad["PrisPerDogn"];

print ("<table>"); 
print("<form method='post' action='' name='tekstfelt' id='tekstfelt'/>");
print("<tr><td>Romtype ID</td><td>$romtypeID</td></tr>");
print("<tr><td>Romtype</td><td>$romtype</td></tr>");
print("<tr><td>Pris per døgn</td><td>$prisPerDogn</td></tr>");
print("</form></table>");
}
include("slutt.html");
?>