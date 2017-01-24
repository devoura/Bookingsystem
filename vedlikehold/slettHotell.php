<?php include("start.html"); ?>
<script src="funksjoner3.js"></script>


<form method="post" action="" name="tekstfelt" id="tekstfelt" onSubmit="return bekreft()">
Slett et hotell <br/> <?php include("listeboksHotellSlett.php"); ?> <br/>
<input type="submit" id="fortsett" name="fortsett" value="Slett" /> <br/>

</form>


<?php
@$fortsett=$_POST["fortsett"];
if($fortsett)
{
@$hotellID=$_POST["hotellID"];
@$hotellNavn=$_POST["hotellNavn"];




include("eksamentilkobling.php");
$sqlSetning="DELETE FROM hotell WHERE hotellID='$hotellID';";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("Ikke mulig å slette. Du må først slette rom i dette hotellet.");

print("Hotellet er slettet.");


}

?>


<?php include("slutt.html"); ?>