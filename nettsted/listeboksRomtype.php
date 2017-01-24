<?php 

    include("eksamentilkobling.php");
      
    $sqlSetning="SELECT * FROM Romtyper ORDER BY RomtypeID;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente data fra databasen."); 
      
    $antallRader=mysqli_num_rows($sqlResultat); 

    print("<select name='romtypeID' id='romtypeID'>");
    for ($r=1;$r<=$antallRader;$r++)
        {
            $rad=mysqli_fetch_array($sqlResultat);  
            $romtypeID=$rad["RomtypeID"];        
            $romtype=$rad["Romtype"]; 
            $prisPerDogn=$rad["PrisPerDogn"]; 

            print("<option value='$romtypeID'>$romtype KR $prisPerDogn,- </option>"); 
        }
    print("</select>"); 
?>
  