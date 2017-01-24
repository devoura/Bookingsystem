<?php
function sjekkbrukernavnpassord ($brukernavn, $passord)
{
include("eksamentilkobling.php");

  $lovligbruker=false;

  if (empty($brukernavn) || empty($passord) ) {
	print ("<p id='melding'>Begge felt må fylles ut.</p>");
	return $lovligbruker;
	}
  
  $sqlsetning="SELECT * FROM admin WHERE brukerNavn='$brukernavn' AND passord ='$passord';";
  $sqlresultat=mysqli_query($db,$sqlsetning); 

  if ($sqlresultat == false) 
    {
     
    }
  else
   {
      $rad=mysqli_fetch_array($sqlresultat);  
      $lagretbrukernavn=$rad["BrukerNavn"]; 
	  $lagretpassord=$rad["Passord"];
	  

      if($brukernavn!=$lagretbrukernavn && $lagretpassord!=$passord)
        {
        print("<p id='melding'>Feil brukernavn eller passord.</p><br />");
        }
		
		else{
		$lovligbruker = true;
		}
    }
  return $lovligbruker;
}

?>