<?php include("start.html"); ?>
<script src="funksjoner3.js"></script>


<form method="post" action="" name="tekstfelt" id="tekstfelt" onSubmit="return bekreft()">
Slett en betalingsmetode <br/> <?php include("listeboksBestillingSlett.php"); ?> <br/>
<input type="submit" id="fortsett" name="fortsett" value="Slett" /> <br/>

</form>


<?php
@$fortsett=$_POST["fortsett"];
if($fortsett)
{
@$bestillingID=$_POST["bestillingID"];
@$hotellID=$_POST["hotellID"];
@$kundeID=$_POST["kundeID"];
@$betalingsID=$_POST["betalingsID"];


include("eksamentilkobling.php");
$sqlSetning="DELETE FROM bestilling WHERE bestillingID='$bestillingID';";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("Ikke mulig å slette.");

print("Bestillingen er slettet.");


}

?>


<?php include("slutt.html"); ?>