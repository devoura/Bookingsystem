<?php include("start.html"); ?>
<script src="funksjoner3.js"></script>


<form method="post" action="" name="tekstfelt" id="tekstfelt" onSubmit="return bekreft()">
Slett en betalingsmetode <br/> <?php include("listeboksBetalingsmetodeSlett.php"); ?> <br/>
<input type="submit" id="fortsett" name="fortsett" value="Slett" /> <br/>

</form>


<?php
@$fortsett=$_POST["fortsett"];
if($fortsett)
{
@$metodeID=$_POST["metodeID"];
@$metodeNavn=$_POST["metodeNavn"];





include("eksamentilkobling.php");
$sqlSetning="DELETE FROM betalingsmetode WHERE metodeID='$metodeID';";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("Ikke mulig å slette. Du må først <a href='slettBetalingsinfo.php'>slette betalingsinformasjoner</a> hvor denne metoden benyttes.");

print("Betalingsmetoden er slettet.");


}

?>


<?php include("slutt.html"); ?>