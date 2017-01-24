<?php     
	
            $hotellID=$_GET["hotellID"];
            include("eksamentilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

            $sqlSetning="SELECT tilbyrfrokost, frokostPris FROM hotell WHERE hotellID='$hotellID';";
            $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente data fra databasen hotell");
            $antallRader=mysqli_num_rows($sqlResultat); 

            
   
            if($antallRader==1)

                {
                    session_start();
                    
                     /* starten på tabellen definert */
                    
                            $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
                            $tilbyrfrokost=$rad["tilbyrfrokost"];
                            $frokostPris=$rad["frokostPris"];
                            $_SESSION["frokostPris"]=$frokostPris;
                           
                            if($tilbyrfrokost==0)
                            {
                                print("");
                                
                                $_SESSION["frokost"]=false;
                                $frokostPris=0;
                                $_SESSION["frokostPris"]=$frokostPris;
                                
                                

                            }

                            if($tilbyrfrokost==1 && $frokostPris==0)
                            {
                                print("Dette hotellet tilbyr frokost inkludert i romprisen.");
                                $_SESSION["frokost"]=true;
                                $frokostPris=0;
                                $_SESSION["frokostPris"]=$frokostPris;

                                
                                
                            }
                            
                            else if($tilbyrfrokost==1 && $frokostPris>0) //se linje 64 bestilling.php
                            {

                                print("Dette hotellet tilbyr frokost til KR $frokostPris per rom, per døgn. Huk av om du ønsker dette.<br />");
                                print("Ja, jeg ønsker frokost. <input type='checkbox' name='frokost' id='frokost'> <br />");
                                //print("Nei <input type='radio' name='frokostNei' id='frokostNei' value='false'>");
                             

                            }

                             
                    }




                       
?>