<?php 

    include("eksamentilkobling.php");
      
    $sqlSetning="SELECT * FROM hotell ORDER BY hotellID;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente data fra databasen."); 
      
    $antallRader=mysqli_num_rows($sqlResultat); 

    print("<select name='hotellID' id='hotellID' onchange='visRom(this.value)' onfocus='visRom(this.value)'>");
    print("<option name='tom' id='tom'>...</option>");
    for ($r=1;$r<=$antallRader;$r++)
        {
            $rad=mysqli_fetch_array($sqlResultat);  
            $hotellID=$rad["HotellID"];        
            $hotellNavn=$rad["HotellNavn"];  

            print("<option value='$hotellID'>$hotellID $hotellNavn</option>"); 
        }
    print("</select>"); 
?>
  