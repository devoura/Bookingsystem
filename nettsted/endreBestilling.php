<html>
<form action="" method="post" input="text" id="tekstfelt" name="tekstfelt">
		
		Din kundeID <input type="int" id="kundeID" name="kundeID" required/><br/>

		<input type="submit" value="Søk etter bestillinger" id="fortsett" name="fortsett">
		<input type="reset" value="Tøm feltet" id="reset" name="reset">	
</form>

<?php

@$fortsett=$_POST["fortsett"];
if($fortsett)

{

$kundeID=$_POST["kundeID"];



if(!$kundeID)
    {
    print("KundeID må fylles ut.<br />");
    }

else
	{
		include("eksamentilkobling.php");
		$sqlSetning="SELECT * FROM bestilling WHERE kundeID='$kundeID';";
		$sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen");
		$antallRader=mysqli_num_rows($sqlResultat);
	
			if($antallRader==0) /* eller ==1 for primærnøkler*/
			{
			print("Det finnes ingen bestillinger med slik kundeID.");
			} /* -||-*/

			else
		{
			for ($r=1;$r<=$antallRader;$r++)

			{
			$rad=mysqli_fetch_array($sqlResultat);  
            $bestillingID=$rad["BestillingID"];
            $hotellID=$rad["HotellID"];
            $pris=$rad["Pris"];
            $datoAnkomst=$rad["DatoAnkomst"];
            $datoAvreise=$rad["DatoAvreise"];
            $romtypeID=$rad["RomtypeID"];        
?>
<?php print("$bestillingID") ?>
<?php print("$romtypeID") ?>

				<form> 
				   <table>
				   <input type="text" name="HotellID" readonly value= <?php print("$hotellID") ?>  ></br>
				   <input type="text" name="RomtypeID" readonly value=<?php print("$romtypeID") ?> ></br>
				   <input type="date" name="DatoAnkomst" readonly value=<?php print("$datoAnkomst") ?> ></br>
				   <input type="date" name="DatoAvreise" readonly value=<?php print("$datoAvreise") ?> ></br>
				   <input type="number" name="Pris" value= <?php print("$pris") ?>  readonly></br>		

  							<input type="submit" value="Submit">
  							</br>



				</form>
<?php
			}
		}
    }
}
?>
 