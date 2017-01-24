<?php 

    include("eksamentilkobling.php");
      
    $sqlSetning="SELECT * FROM Land ORDER BY LandID;";
    $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Ikke mulig å hente data fra databasen."); 
      
    $antallRader=mysqli_num_rows($sqlResultat); 

    print("<select name='landID' id='landID' onchange='visBy(this.value)' onfocus='visBy(this.value)'>");
    print("<option name='tom' id='tom'> ... </option>");
    for ($r=1;$r<=$antallRader;$r++)
        {
            $rad=mysqli_fetch_array($sqlResultat);  
            $landID=$rad["LandID"];        
            $landNavn=$rad["LandNavn"];  

            print("<option value='$landID'>$landID $landNavn </option>"); 
        }
    print("</select>"); 
?>
  