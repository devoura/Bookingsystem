<?php 

    include("eksamentilkobling.php");
      
    $sqlSetning="SELECT HotellID, HotellNavn FROM Hotell ORDER BY HotellNavn;";
    $sqlResultat=mysqli_query($db, $sqlSetning) or die ("ikke mulig å hente fra databasen");
        
        $antallRader=mysqli_num_rows($sqlResultat);

    print("<select name='HotellID' id='HotellID'>");

    for ($r=1;$r<=$antallRader;$r++)
        {
            $rad=mysqli_fetch_array($sqlResultat);  
            $hotellID=$rad["HotellID"];        
            $hotellNavn=$rad["HotellNavn"];  

            print("<option value='$hotellID'>$hotellNavn</option>"); 
        }
    print("</select>"); 
?>