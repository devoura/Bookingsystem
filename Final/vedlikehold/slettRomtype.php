<?php include("start.html"); ?>
<script src="funksjoner3.js"></script>


<form method="post" action="" name="tekstfelt" id="tekstfelt" onSubmit="return bekreft();">
Slett en romtype <br/> <?php include("listeboksRomtypeSlett.php"); ?> <br/>
<input type="submit" id="fortsett" name="fortsett" value="Slett" /> <br/>

</form>


<?php
@$fortsett=$_POST["fortsett"];
if($fortsett)
{
@$romtypeID=$_POST["romtypeID"];
@$romtype=$_POST["romtype"];



include("eksamentilkobling.php");
$sqlSetning="DELETE FROM romtyper WHERE romtypeID='$romtypeID';";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("Ikke mulig å slette. Du må først <a href='slettRom.php'>slette rom</a> av denne typen. <br /> Se <a href='visRom.php'>Romoversikten</a>");

print("Romtypen er slettet.");


}

?>


<?php include("slutt.html"); ?>