<?php
function sjekkbrukernavnpassord ($brukernavn)
{
include("eksamentilkobling.php");

  $lovligbruker=false;
  
	if (empty($brukernavn) ) {
		print ("<p id='melding'>Feltet må fylles ut.</p>");
		return $lovligbruker;
		}
  
  $sqlsetning="SELECT * FROM kundeinfo WHERE Email='$brukernavn';";
  $sqlresultat=mysqli_query($db,$sqlsetning); 

  if ($sqlresultat == false) 
    {
     
    }
  else
   {
      $rad=mysqli_fetch_array($sqlresultat);  
      $lagretbrukernavn=$rad["Email"]; 
	  

      if($brukernavn!=$lagretbrukernavn)
        {
         print("<p id='melding'>Feil brukernavn.</p><br />");
        }
		
		else{
		$lovligbruker = true;
		}
    }
  return $lovligbruker;
}

?>