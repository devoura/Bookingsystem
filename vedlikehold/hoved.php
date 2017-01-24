<?php  

session_start();
@$innloggetbruker=$_SESSION["brukernavn"]; 
  
if (!$innloggetbruker) 
    {
        print('Denne siden krever innlogging <br /><a href="innlogging.php">Logg inn</a>');
    }
    else
    {
        include("index.php");
    }			
?>