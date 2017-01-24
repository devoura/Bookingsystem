<?php     
	
            $landID=$_GET["landID"];
            include("eksamentilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

            $sqlSetning="SELECT * FROM byer WHERE landID='$landID';";
            $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente data fra databasen byer $landID");
            $antallRader=mysqli_num_rows($sqlResultat); 

            
            if ($antallRader==0) 
                {
                    print ("<em>Ingen registrerte byer i dette landet. </em> <br/>");  /* starten på tabellen definert */
                }
            else 
                {
                    print("Velg by: ");
                    print ("<select id='byListe' name='byListe' onchange='visHotell(this.value)' onfocus='visHotell(this.value)'>");  /* starten på tabellen definert */
                    print("<option name='tom' id='tom'> ... </option>");
                    for ($r=1;$r<=$antallRader;$r++)
                        {
                            $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
                            $byID=$rad["ByID"];
                            $byNavn=$rad["ByNavn"];
                            print ("<option value='$byID'>$byID $byNavn</option>");  /* ny rad skrevet */
                        }
                    print ("</select>");  /* slutten på listen definert */
                }
?>