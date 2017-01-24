<?php include("start.html"); ?>
<script src="funksjoner3.js"></script>


<form method="post" action="" name="tekstfelt" id="tekstfelt" onSubmit="return bekreft()">
Slett en bruker <br/> <?php include("listeboksBrukerSlett.php"); ?> <br/>
<input type="submit" id="fortsett" name="fortsett" value="Slett" /> <br/>

</form>


<?php
@$fortsett=$_POST["fortsett"];
if($fortsett)
{
@$brukernavn=$_POST["brukernavn"];


include("eksamentilkobling.php");
$sqlSetning="DELETE FROM admin WHERE brukernavn='$brukernavn';";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("Ikke mulig å slette brukeren.");

print("Brukeren er slettet.");


}

?>


<?php include("slutt.html"); ?>