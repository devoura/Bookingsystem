<?php include("start.html"); ?>

<script src="funksjoner.js"></script>
<script src="ajax-rom.js"></script>

<br /><br />
<form action="" method="post" name="tekstfelt" id="tekstfelt">
Velg hotell <?php include("listeboksHotellAJAX.php");?>
<div id="melding"></div>
<input type="submit" name="fortsett" id="fortsett" value="fortsett" />
</form>


<?php
@$fortsett=$_POST["fortsett"];

if($fortsett){
@$hotellID=$_POST["hotellID"];	

@$romID=$_POST["romID"];

include("eksamentilkobling.php");
$sqlSetning="SELECT * FROM rom WHERE romID='$romID' AND hotellID='$hotellID';";
$sqlResultat=mysqli_query ($db, $sqlSetning) or die (mysqli_error($db));
$rad=mysqli_fetch_array($sqlResultat);

$romID=$rad["RomID"];
$hotellID=$rad["HotellID"];
$romtypeID=$rad["RomtypeID"];
$tilstand=$rad["Tilstand"];

$lovliginput=true;

	if(!$romID && !$hotellID)
	{
		
		$lovliginput=false;
		print("Velg et hotell og et rom.");

	}


	if($hotellID=='...')
	{
		$lovliginput=false;
		print("Velg et hotell");
	}

	if($romID=='...')
	{
		$lovliginput=false;
		print("Velg et rom");
	}


	if($hotellID && $romID && $lovliginput){
print("<table>");
print("<form method='post' action='' name='endreSkjema' id='endreSkjema' onSubmit='return bekreft();'/>");
print("<tr><td>Rom-ID</td><td><input type='text' value='$romID' name='romID' id='romID' readonly /></td></tr><br />");
print("<tr><td>Hotell-ID</td><td><input type='text' value='$hotellID' name='hotellID' id='hotellID' readonly /></td> <br />");
print("<tr><td>Romtype-ID</td><td><input type='text' value='$romtypeID' name='romtypeID' id='romtypeID'></td><br />");

if($tilstand==1)
	{
	print("<tr><td>Tilstand (avhuket = opptatt)</td><td><input type='checkbox' name='tilstand' id='tilstand' checked /> </td></tr>");
	}

if(empty($tilstand))
	{
	print("<tr><td>Tilstand (avhuket = opptatt)</td><td><input type='checkbox' name='tilstand' id='tilstand'  /> </td></tr>");
	}

//print("<tr><td>Tilstand (1 opptatt, tom ledig)</td><td><input type='text' value='$tilstand' name='tilstand' id='tilstand' maxlength='1'></tr>");
print("<tr><td></td><td><input type='submit' value='Endre informasjonen' name='endreInfoKnapp' id='endreInfoKnapp'/></td>");
print("</form></table>");
											}

}


@$endreInfoKnapp=$_POST["endreInfoKnapp"];

if($endreInfoKnapp)
{
$romID=$_POST["romID"];
$hotellID=$_POST["hotellID"];
$romtypeID=$_POST["romtypeID"];
@$tilstand=$_POST["tilstand"];


$lovliginput=true;
$lovligTilstand=false;



if(!$romID || !$hotellID || !$romtypeID) {
	$lovliginput=false;
		print("Fyll ut rom-ID, hotell-ID og romtype-ID. <br />");
  } 

if(isset($tilstand))
{
	$tilstand='1';

	if($romtypeID && $hotellID && $romtypeID && $lovliginput && isset($tilstand))
	{
	include("eksamentilkobling.php");
	$sqlSetning="UPDATE rom SET romID='$romID', hotellID='$hotellID', romtypeID='$romtypeID', tilstand='$tilstand' WHERE romID='$romID' AND hotellID='$hotellID';";
	mysqli_query($db, $sqlSetning) or die ("Ikke mulig å endre informasjonen 1.");
	print("<p id='melding'>Informasjonen er endret.</p>");
	}

}

else
{
	include("eksamentilkobling.php");
	$sqlSetning="UPDATE rom SET romID='$romID', hotellID='$hotellID', romtypeID='$romtypeID', tilstand=NULL WHERE romID='$romID' AND hotellID='$hotellID';";
	mysqli_query($db, $sqlSetning) or die ("Ikke mulig å endre informasjonen 0.");
	print("<p id='melding'>Informasjonen er endret.</p>");
		
}
 




}

include("slutt.html");
?>