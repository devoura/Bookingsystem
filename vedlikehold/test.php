<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt" onsubmit="return validerRegistrerStudent()">
		Tilbyr hotellet frokost? <input type="checkbox" id="frokost" name="frokost">
		<input type="submit" value="Fortsett" id="fortsett" name="fortsett">
	
</form>
<?php
@$fortsett=$_POST["fortsett"];


if($fortsett)
{
// Checkbox er fylt ut
if (isset($_POST['frokost'])) 
	{
		include("eksamentilkobling.php");
$sqlSetning="INSERT INTO test VALUES (NULL, TRUE)";
mysqli_query($db, $sqlSetning) or die ("ikke mulig å registrere informasjonen.");
print("Frokosten er registrert.");
 
	}


// Checkboxen er tom     
else 
	{
		include("eksamentilkobling.php");
$sqlSetning="INSERT INTO test VALUES (NULL, FALSE)";
mysqli_query($db, $sqlSetning) or die ("ikke mulig å registrere informasjonen.");
print("mangelen på frokost er registrert.");
  
	}
}
?>