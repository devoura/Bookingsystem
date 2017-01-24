<?php     
	
            $hotellID=$_GET["hotellID"];
            include("eksamentilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

            $sqlSetning="SELECT * FROM rom WHERE hotellID='$hotellID';";
            $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente data fra databasen hotell");
            $antallRader=mysqli_num_rows($sqlResultat); 

            
            if ($antallRader==0) 
                {
                    print ("<em>Ingen registrerte rom på dette hotellet. </em> <br/>");  
                }

            else 
                {
                    print("Velg rom å endre: ");
                    print ("<select id='romID' name='romID'>");
                    print("<option name='tom'>...</option>");  /* starten på tabellen definert */
                    for ($r=1;$r<=$antallRader;$r++)
                        {
                            $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
                            $romID=$rad["RomID"];
                            $hotellID=$rad["HotellID"];
                            $romtypeID=$rad["RomtypeID"];
                            $tilstand=$rad["Tilstand"];
                            print ("<option value='$romID'>$romID $hotellID $romtypeID</option>");  /* ny rad skrevet */
                        }
                    print ("</select>");  /* slutten på listen definert */
                }
?>