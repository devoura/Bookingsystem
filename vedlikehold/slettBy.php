<?php include("start.html"); ?>
<script src="funksjoner3.js"></script>


<form method="post" action="" name="tekstfelt" id="tekstfelt" onSubmit="return bekreft()">
Slett en by <br/> <?php include("listeboksBySlett.php"); ?> <br/>
<input type="submit" id="fortsett" name="fortsett" value="Slett" /> <br/>

</form>


<?php
@$fortsett=$_POST["fortsett"];
if($fortsett)
{
@$byID=$_POST["byID"];
@$byNavn=$_POST["byNavn"];


include("eksamentilkobling.php");
$sqlSetning="DELETE FROM byer WHERE byID='$byID';";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("Ikke mulig å slette. Du må først slette hotell i denne byen.");

print("Byen er slettet.");


}

?>


<?php include("slutt.html"); ?>