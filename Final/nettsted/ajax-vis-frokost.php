<?php     
	
            $hotellID=$_GET["hotellID"];
            include("eksamentilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

            $sqlSetning="SELECT tilbyrFrokost, frokostPris FROM hotell WHERE hotellID='$hotellID';";
            $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente data fra databasen hotell");
            $antallRader=mysqli_num_rows($sqlResultat); 

            
   
            if($antallRader==1)

                {
                    session_start();
                    
                     /* starten på tabellen definert */
                    
                            $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
                            $tilbyrFrokost=$rad["tilbyrFrokost"];
                            $frokostPris=$rad["frokostPris"];
                            $_SESSION["frokostPris"]=$frokostPris;
                            
                           
                            if($tilbyrFrokost==0)
                            {
                                print("");
                          
                            }

                            if($tilbyrFrokost==1 && $frokostPris==0)
                            {
                                print("Dette hotellet tilbyr frokost inkludert i romprisen.");
                                                               
                                
                            }
                            
                            else if($tilbyrFrokost==1 && $frokostPris>0) //se linje 64 bestilling.php
                            {

                                print("Dette hotellet tilbyr frokost til KR $frokostPris per rom, per døgn. Huk av om du ønsker dette.<br />");
                                print("Ja, jeg ønsker frokost. <input type='checkbox' name='frokost' id='frokost'> <br />");
                                //print("Nei <input type='radio' name='frokostNei' id='frokostNei' value='false'>");
                             

                            }

                             
                    }




                       
?>