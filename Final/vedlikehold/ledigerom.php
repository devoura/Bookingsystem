<?php 

    include("eksamentilkobling.php");
      
    $sqlSetning="SELECT RomtypeID, COUNT(RomID) AS AntallRom FROM rom WHERE HotellID='$hotellID' GROUP BY RomtypeID;";
    $sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen");
        
        $antallRader=mysqli_num_rows($sqlResultat);

    
        


    for ($r=1;$r<=$antallRader;$r++)
        {
            $rad=mysqli_fetch_array($sqlResultat);  
            $romtypeID=$rad["RomtypeID"];        
            $antallRom=$rad["AntallRom"];
            
            $sqlquery="SELECT RomtypeID, COUNT(RomID) AS OpptatteRom FROM bestilling
                WHERE HotellID='$HotellID'
                AND RomtypeID='$romtypeID'
                AND DatoAnkomst >= '$DatoAnkomst'
                AND DatoAvreise <= '$DatoAvreise';";
            $sqlResult=mysqli_query($db, $sqlquery) or die ("ikke mulig å hente fra databasen");

            $row=mysqli_fetch_array($sqlResult);
            $optatteRom=$row["OpptatteRom"];
            $ledigeRom=$antallRom-$optatteRom; 

            print("$ledigeRom ledige $romtypeID"); 
        } 
?>