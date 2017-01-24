<?php include("start.html"); ?>
<script src="funksjoner3.js"></script>


<form method="post" action="" name="tekstfelt" id="tekstfelt" onSubmit="return bekreft()">
Slett et land <br/> <?php include("listeboksLandSlett.php"); ?> <br/>
<input type="submit" id="fortsett" name="fortsett" value="Slett" /> <br/>

</form>

<?php
@$fortsett=$_POST["fortsett"];
if($fortsett)
{
@$landID=$_POST["LandID"];
@$landNavn=$_POST["LandNavn"];


include("eksamentilkobling.php");
$sqlSetning="DELETE FROM Land WHERE landID='$landID';";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("Ikke mulig å slette. Du må først slette byer i dette landet.");

print("Landet er slettet.");


}

?>


<?php include("slutt.html"); ?>