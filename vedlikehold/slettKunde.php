<?php include("start.html"); ?>
<script src="funksjoner3.js"></script>


<form method="post" action="" name="tekstfelt" id="tekstfelt" onSubmit="return bekreft()">
Slett en kunde <br/> <?php include("listeboksKunde.php"); ?> <br/>
<input type="submit" id="fortsett" name="fortsett" value="Slett" /> <br/>

</form>


<?php
@$fortsett=$_POST["fortsett"];
if($fortsett)
{

@$kundeID=$_POST["kundeID"];


$sqlSetning="DELETE FROM kundeinfo WHERE kundeID='$kundeID';";
$sqlResultat=mysqli_query($db, $sqlSetning) or die ("Ikke mulig å slette. Kunden har aktive bestillinger. Disse må slettes først.");

	print("<p id='melding'>Kunden er slettet.</p>");


}

?>


<?php include("slutt.html"); ?>