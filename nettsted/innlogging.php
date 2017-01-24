<?php 
include ("start.html");
?>

<h2>Innlogging</h2>

<form method="post" name="innloggingsskjema" id="innloggingsskjema" action="">
Email <br/ ><input type="text" name="brukernavn" id="brukernavn"><br />
<input type="submit" name="logginnknapp" value="Logg inn">
<input type="reset" name="nullstill" id="nullstill" value="Nullstill"><br />
</form><br />
<p>Ny bruker? <br />
<a href="registrerkunde.php">Registrer deg her</a></p><br /><br />


<?php
@$logginnknapp=$_POST["logginnknapp"];

if ($logginnknapp) {
	include ("sjekk.php");
	$brukernavn=$_POST["brukernavn"];

	if (!sjekkbrukernavnpassord($brukernavn)) {
        }
    else 		
        {
            $_SESSION['brukernavn'] = $brukernavn;  
           print("<META HTTP-EQUIV='Refresh' CONTENT='0;URL=konto.php'>"); 
        }


}
 
include ("slutt.html");
?>