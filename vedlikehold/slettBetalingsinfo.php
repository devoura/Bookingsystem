<?php include("start.html"); ?>
<script src="funksjoner3.js"></script>


<form method="post" action="" name="tekstfelt" id="tekstfelt" onSubmit="return bekreft()">
Slett betalingsinformasjon <br/> <?php include("listeboksBetalingsinfoSlett.php"); ?> <br/>
<input type="submit" id="fortsett" name="fortsett" value="Slett" /> <br/>

</form>


<?php
@$fortsett=$_POST["fortsett"];
if($fortsett)
{
@$betalingsID=$_POST["betalingsID"];


include("eksamentilkobling.php");
$sqlSetning="DELETE FROM betalingsinfo WHERE betalingsID='$betalingsID';";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("Ikke mulig å slette. Du må først <a href='slettBestilling.php'>slette bestillinger</a> hvor betalings-IDen benyttes.");

print("Betalingsinformasjonen er slettet.");


}

?>


<?php include("slutt.html"); ?>