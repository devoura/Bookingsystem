<?php     
	
            $byID=$_GET["byID"];
            include("eksamentilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

            $sqlSetning="SELECT * FROM hotell WHERE byID='$byID';";
            $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente data fra databasen hotell");
            $antallRader=mysqli_num_rows($sqlResultat); 

            
            if ($antallRader==0) 
                {
                    print ("<em>Ingen registrerte hoteller i denne byen. </em> <br/>");  /* starten på tabellen definert */
                }
            else 
                {
                    print("Velg hotell: ");
                    print ("<select id='hotellID' name='hotellID' onchange='visFrokost(this.value)' onfocus='visFrokost(this.value)'>");  /* starten på tabellen definert */
                    print("<option name='tom' id='tom'> ... </option>");
                    for ($r=1;$r<=$antallRader;$r++)
                        {
                            $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
                            $hotellID=$rad["HotellID"];
                            $hotellNavn=$rad["HotellNavn"];
                            print ("<option name='$hotellID' value='$hotellID'>$hotellNavn</option>");  /* ny rad skrevet */


                        }
                    print ("</select>");  /* slutten på listen definert */

                }
?>